<?php

namespace App\Controller;

use App\Entity\LesvgpVgp;
use App\Entity\LesvgpTitre;
use App\Entity\LesvgpUsers;
use App\Entity\LesvgpMarque;
use App\Entity\LesvgpMatcli;
use App\Entity\LesvgpModele;
use App\Form\AjoutPhotoType;
use App\Entity\LesvgpClients;
use App\Entity\LesvgpEnergie;
use App\Entity\LesvgpQuestion;
use App\Entity\LesvgpFormulaire;
use App\Entity\LesvgpImagePhoto;
use App\Entity\LesvgpProposition;
use App\Entity\LesvgpQuestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RapportController extends AbstractController
{
    /**
     * @Route("/Espace-Client/Rapport", name="Espace-Client_Rapport")
     */
    public function index(SessionInterface $session): Response
    {   

        $prepa=$session->get('prepa', []);
        //dd($prepa);
        $modcli['CLients']=$this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id'=>$prepa['clients']]);
        $modcli['modele']=$this->getDoctrine()->getRepository(LesvgpModele::class)->findOneBy(['id'=>$prepa['modele']]);
        $pprops=array();
        $form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy(['id'=>$prepa['formulaire']]);
        $donnees=json_decode($form->getDonnees(),true);
        //dd($donnees);
        if(isset($donnees['Commun']) && $donnees['Commun']!=null){
            foreach($donnees['Commun'] as $id=>$val){
                $props['Commun'][]=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findOneBy(['id'=>$id]);
            }
        }
        if(isset($donnees['Levage']) && $donnees['Levage']!=null){
            foreach($donnees['Levage'] as $id=>$val){
                $props['Levage'][]=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findOneBy(['id'=>$id]);
            }
        }
        if(isset($donnees['Equipement']) && $donnees['Equipement']!=null){
            foreach($donnees['Equipement'] as $id=>$val){
                $tt=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findOneBy(['id'=>$id]);
                $eq=array();
                //dd($tt);
                $eq['proposition']=$tt->getProposition();
                $eq['id']=$tt->getId();
                $eq['Equipement']=json_decode($tt->getEquipements(), true);
                //dd($eq);
                $props['Equipement'][]=$eq;
            }
        }
        //dd($props);
        return $this->render('rapport/Rapport.html.twig', [
            'fromulaire'=>$form,
            'donnees'=>$props,
            'info'=>$modcli
        ]);
    }

    /**
     * @Route("/rapport/GestionRapport", name="Espace-Client_GestionRapport")
     */
    #La synthese, l'avis , l'etat de conservation, Resultat des essais de fonctinnement, et du limiteur de surcharge
    public function Gestion(SessionInterface $session, EntityManagerInterface $manager)
    { $data=new LesvgpVgp();
        $prepa=$session->get('prepa', []);
        //dd($_POST);
        $donnees=array();
        $categ='commun';
        
        $users=$this->getDoctrine()->getRepository(LesvgpUsers::class)->findOneBy(['id'=>$this->getUser()->getId()]);
        $form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy(['id'=>$prepa['formulaire']]);
        $matcli=$this->getDoctrine()->getRepository(LesvgpMatcli::class)->findOneBy(['Clients'=>$prepa['clients'], 'LesvgpModele'=>$prepa['modele'], 'LesvgpCategorie'=>$prepa['categorie']]);
        //dd($matcli);
        //dd($_POST);
        foreach($_POST as $key=>$val){
            if($key!='duree' && $key!='questionnaire' && $key!='numserie' && $key!='dateverif'){
                if($key=='levage' || $key=='equi'){
                    $categ=$key;    
                }else{
                    if(isset($categ) && $categ!='equi'){
                        $donnees[$categ][$key]=htmlentities($val);
                    }elseif($categ=='equi'){
                        if(is_int($key)){
                            $items=array();
                            for($i=1; $i<=8; $i++){
                                if(isset($_POST[$key.'-item-'.$i]) && $_POST[$key.'-item-'.$i]!=null){    
                                    $items['item'.$i]=htmlentities($_POST[$key.'-item-'.$i]);
                                    //var_dump($items);
                                }
                            }
                            $donnees[$categ][$key]=json_encode($items);        
                        }
                    }
                }   
            }
        }
        
        $data->setNumserie($_POST['numserie']);
        $data->setDateverif($_POST['dateverif']);
        $daterelpro=$this->RelanceProcont($_POST['dateverif'], $_POST['duree']);
        $data->setDonnees(json_encode($donnees));
        $data->setFormulaire($form);
        $data->setUser($users);
        $data->setMatcli($matcli);
        $data->setProcont($daterelpro['procont']);
        $data->setRelance($daterelpro['relance']);
        $data->setDateproconc($daterelpro['proconc']);
        if(isset($daterelpro['rapport'])){
            $data->setRapport($daterelpro['rapport']);
        }
        $manager->persist($data);
        $manager->flush();
        $prepa['idvgp']=$data->getId();
        $session->set('prepa', $prepa);
        if($form->getQuestionnaire()==true){
            return $this->redirectToRoute('Espace-Client_RapportQuestionnaire');
        }else{
            return $this->redirectToRoute('Espace-Client_RapportRecapitulatif');
        }   
    }

    private function RelanceProcont($dateverif, $duree){
        $pan=explode('/', $dateverif);
        $annee=$pan[2];
        $mois=$pan[1];
        $jour=$pan[0];
    
        if($duree==12){
            $nvomois=$mois;
            $moisrel=$mois-1;
            $nvoannee=$annee+1;
            $anneerel=$nvoannee;
        }else{
            $nvomois=$mois+$duree;
            $moisrel=$mois+$duree-1;
            $nvoannee=$annee;
            $anneerel=$nvoannee;
        }
        if($nvomois>12){
            $nvomois=$nvomois-12;
            $nvoannee=$annee+1;
        }
        if($moisrel>12){
            $moisrel=$moisrel-12;
            $anneerel=$anneerel+1;
        }
        if($moisrel<1){
            $moisrel=12;
            $anneerel=$annee-1;
        }
        if(strlen($moisrel)<2){
            $moisrel='0'.$moisrel;
        }
        if(strlen($nvomois)<2){
            $moisrel='0'.$moisrel;
        }
        $retour['relance']=$anneerel.$moisrel.$jour;
        $retour['proconc']=$nvoannee.$nvomois.$jour;
        $retour['procont']=$jour.'/'.$nvomois.'/'.$nvoannee;
        if(!isset($prepa['idvgp']) && !isset($prepa['reprise']));
        $retour['rapport']=$nvoannee.$nvomois.$jour.$this->getUser()->getId().'-'.date('hms');
        //var_dump($dateverif);
        //var_dump($duree);
        return $retour;
    }

     /**
     * @Route("/Espace-Client/RapportQuestionnaire", name="Espace-Client_RapportQuestionnaire")
     */
    public function RapportQuestionaire(SessionInterface $session, EntityManagerInterface $manager)
    {
        $prepa=$session->get('prepa', []);
        $form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy(['id'=>$prepa['formulaire']]);
        $questionnaire=$this->getDoctrine()->getRepository(LesvgpQuestionnaire::class)->findOneBy(['Formulaire'=>$form]);
        $donnees=json_decode($questionnaire->getDonnees(), true);
        //dd($donnees);
        foreach($donnees as $lettre=>$value){
            foreach($value as $nom=>$val){
                //dd($value);
                if($nom=='titre-'.$lettre){
                    $data[$lettre]['titre']=$this->getDoctrine()->getRepository(LesvgpTitre::class)->findOneBy(['id'=>$val]);
                }else{
                    $data[$lettre]['question'][]=$this->getDoctrine()->getRepository(LesvgpQuestion::class)->findOneBy(['id'=>$val]);
                }  
            }
        }
        //dd($data);
        return $this->render('rapport/questionnaire.html.twig', [
            'question' => $data,
        ]);
        
    }

     /**
     * @Route("/Espace-Client/GestionFormQuestionnaire", name="Espace-Client_GestionQuestionnaire")
     */
    public function GestionRapportQuestionnaire(SessionInterface $session, EntityManagerInterface $manager)
    {
        $prepa=$session->get('prepa', []);   
        $tablo=$this->getDoctrine()->getRepository(LesvgpVgp::class)->findOneBy(['id'=>$prepa['idvgp']]);
        foreach($_POST as $nom=>$val){
            if($val!='be' && $val!=null){
                $def[$nom]=$val;
            }
        }
        $tablo->setTableau(json_encode($def));
        //dd($tablo);
        $manager->persist($tablo);
        $manager->flush();
        return $this->redirectToRoute('Espace-Client_RapportRecapitulatif');

    }

     /**
     * @Route("/Espace-Client/RapportRecapitulatif", name="Espace-Client_RapportRecapitulatif")
     */
    public function RapportRecapitulatif(SessionInterface $session, EntityManagerInterface $manager)
    {
        $data=new LesvgpVgp();
        $prepa=$session->get('prepa', []);
        $info=null;
        $menu=false;
        $vgp=$this->getDoctrine()->getRepository(LesvgpVgp::class)->findOneBy(['id'=>$prepa['idvgp']]);
        $img=$this->getDoctrine()->getRepository(LesvgpImagePhoto::class)->findOneBy(['Vgp'=>$vgp]);
        $modele=$this->getDoctrine()->getRepository(LesvgpModele::class)->findOneBy(['id'=>$prepa['modele']]);
        $marque=$this->getDoctrine()->getRepository(LesvgpMarque::class)->findOneBy(['id'=>$modele->getMarque()->getId()]);
        $nrj=$this->getDoctrine()->getRepository(LesvgpEnergie::class)->findOneBy(['id'=>$modele->getEnergie()->getId()]);
        $clients=$this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id'=>$prepa['clients']]);
        
        if($img){
            $info['image']=$img->getNom();
        }else{
            $info['image']=false;
        }
        if($vgp->getTexteimg()!=null){
            $info['Texte']=$vgp->getTexteimg();
        }else{
            $info['Texte']=false;
        }
        if($vgp->getSynthese()!=null){
            $info['synthese']=$this->Synthese($vgp->getSynthese());
        }
        if($vgp->getAvis()!=null){
            $info['avis']=$this->Avis($vgp->getSynthese());
        }

        if($vgp->getAvis()!=null && $vgp->getSynthese()!=null && $vgp->getResultatEssais()!=null && $vgp->getResultatLim()!=null && $vgp->getResultatEssais()!=null){
            $menu='ok';
        }
        return $this->render('rapport/recapitulatif.html.twig', [
            'modele'=>$modele,
            'vgp'=>$vgp,
            'marque'=>$marque,
            'nrj'=>$nrj,
            'client'=>$clients,
            'info'=>$info,
            'menu'=>$menu
        ]);
    }

    private function Synthese($synthese){
        switch ($synthese) {
            case 1:
                $string="Les vérifications et essais de fonctionnement à vide et/ou en charge effectués dans le cadre de la presente mission n'ont pas revelé d'anomalies ou de défectuosités.";
                break;
            case 2:
                $string="Les vérifications et essais de fonctionnement à vide et/ou en charge effectués dans le cadre de la présente mission n'ont pas révélé d'anomalies ou de défectuosités majeures mais une intervention est nécessaire.Se référer aux observations figurant sur la synthèse.";
                break;
            case 3:
                $string="Les vérifications et essais de fonctionnement à vide et/ou en charge effectués dans le cadre de la présente mission ont révélé des anomalies ou défectuosités majeures pouvant compromettre l'utilisation en sécurité de cette machine.Il conviendra de procéder à la levée de ces observations au plus vite.";
                break;
            case 4:
                $string="Les vérifications et essais de fonctionnement de cet équipement, à vide et/ou en charge effectués dans le cadre de la presente mission n'ont pas revelé d'anomalies ou de défectuosités.";
                break;
            case 5:
                $string="Les vérifications et essais de fonctionnement de cet équipement, à vide et/ou en charge effectués dans le cadre de la présente mission n'ont pas révélé d'anomalies ou de défectuosités majeures mais une intervention est nécessaire.Se référer aux observations figurant sur la synthèse.";
                break;
            case 6:
                $string="Les vérifications et essais de fonctionnement de cet équipement, à vide et/ou en charge effectués dans le cadre de la présente mission ont révélé des anomalies ou défectuosités majeures pouvant compromettre l'utilisation en sécurité de cette machine.Il conviendra de procéder à la levée de ces observations au plus vite.";
                break;
        }
        return $string;    
    }

    private function Avis($avis){
        switch ($avis) {
            case 1:
                $string="Cette machine peut être maintenue en activité.";
                break;
            case 2:
                $string="Cette machine DOIT être arrêtée.";
                break;
            case 3:
                $string="Cet équipement peut être maintenu en activité.";
                break;
            case 4:
                $string="Cet équipement doit être réformé.";
                break;
        }
        return $string;    
    }

    /**
     * @Route("/Espace-Client/RapportAjRecapitulatif", name="Espace-Client_RapportAjRecapitulatif")
    */
    public function RapportAjRecapitulatif(SessionInterface $session, EntityManagerInterface $manager)
    {
        //dd($_POST);
        $prepa=$session->get('prepa', []);
        $vgp=$this->getDoctrine()->getRepository(LesvgpVgp::class)->findOneBy(['id'=>$prepa['idvgp']]);
        
        if(isset($_POST['avis']) && $_POST['avis']!=null){
            $vgp->setAvis(htmlentities($_POST['avis']));
        }
        if(isset($_POST['synthese']) && $_POST['synthese']!=null) {
            $vgp->setSynthese(htmlentities($_POST['synthese']));
        }
        if (isset($_POST['resultat_essai']) && $_POST['resultat_essai']!=null) {
            $vgp->setResultatEssais(htmlentities($_POST['resultat_essai']));
        }
        if (isset($_POST['resultat_etat']) && $_POST['resultat_etat']!=null) {
            $vgp->setResultatEssais(htmlentities($_POST['resultat_etat']));
        }
        if (isset($_POST['resultat_Lim']) && $_POST['resultat_Lim']!=null) {
            $vgp->setResultatEssais(htmlentities($_POST['resultat_Lim']));
        }
        $manager->persist($vgp);
        $manager->flush();
        return $this->redirectToRoute('Espace-Client_RapportRecapitulatif2');
    }

     /**
     * @Route("/Espace-Client/RapportRecapitulatifphoto", name="Espace-Client_RapportRecapitulatif2")
     */
    public function RapportRecapitulatifphoto(SessionInterface $session, EntityManagerInterface $manager, Request $request)
    {
        $prepa=$session->get('prepa', []);
        $vgp=$this->getDoctrine()->getRepository(LesvgpVgp::class)->findOneBy(['id'=>$prepa['idvgp']]);
        
        //dd($prepa);
        $form=$this->createForm(AjoutPhotoType::class, $vgp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            //dd($vgp);
            if($vgp->getTexteimg()!=null){
                $manager->persist($vgp);    
            }elseif($form->get('ImagePhoto')->getData()!=null){
                $image = $form->get('ImagePhoto')->getData();
                //dd($image);
                if($image!=null){
                    $fichier='photo'.$prepa['idvgp'].'.'.$image->guessExtension();
                    $image->move(
                        $this->getParameter('photo_directory'),
                        $fichier
                    );
                    $img=new LesvgpImagePhoto();
                    $img->setNom($fichier);
                    $vgp->addImagePhoto($img);
                }
            }
            $manager->persist($vgp);
            $manager->flush();
            $this->redirectToRoute('Espace-Client_RapportRecapitulatif');
        }
        return $this->render('rapport/recapitulatifphoto.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}
