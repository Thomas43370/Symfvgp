<?php

namespace App\Controller;
use App\Entity\LesvgpVgp;
use App\Entity\LesvgpRegle;
use App\Entity\LesvgpUsers;
use App\Entity\LesvgpMarque;
use App\Entity\LesvgpMatcli;
use App\Entity\LesvgpModele;
use App\Entity\LesvgpClients;
use App\Entity\LesvgpEnergie;
use App\Form\AjoutModeleType;
use App\Entity\LesvgpCategorie;
use App\Entity\LesvgpFormulaire;
use App\Form\DonneesMembresType;
use App\Entity\LesvgpDonneesMembres;
use App\Form\EspaceCliAjouterClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EspaceClientController extends AbstractController
{
    /**
     * @Route("/Espace-Client", name="Espace-Client")
     */
    public function index(SessionInterface $session)
    {
        //dd($this->getUser());
        $reglage=$this->getDoctrine()->getRepository(LesvgpDonneesMembres::class)->findOneBy(['User'=>$this->getUser()]);
        //dd($reglage);
        if(!$reglage){
            return $this->redirectToRoute('Espace-CLient_DonneesMembres');
        }

        return $this->render('espace_client/index.html.twig', [
            'NomSociete' => $reglage->getSociete(),

        ]);
    }

    /**
     * @Route("/Espace-Client/DonneesMembres", name="Espace-CLient_DonneesMembres")
     */
    public function MembresDonnees(SessionInterface $session, EntityManagerInterface $manager, Request $request)
    {

        $donnees=$this->getDoctrine()->getRepository(LesvgpDonneesMembres::class)->findOneBy(['id'=>$this->getUser()->getId()]);
        if(!$donnees){
            $donnees=new LesvgpDonneesMembres();    
        }
        $form=$this->createForm(DonneesMembresType::class, $donnees);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //dd($form);
            $donnees->setUser($this->getUser());
            $manager->persist($donnees);
            $manager->flush();
            $this->redirectToRoute('Espace-Client');
        }

        return $this->render('espace_client/index.html.twig', [
            'Titre'=>'Les données du controleur',
            'form' => $form->createView(),
        ]);
    }
//-----------Preparation---------------------Preparation---------------------Preparation---------------------Preparation---------------------Preparation---------------------Preparation----------

    /**
     * @Route("/Espace-Client/Prepa", name="Espace-Client_Prepa")
     */
    public function Prepa(Request $request, SessionInterface $session){
        $prepa=$session->get('prepa', []);
        $nvelregle=new LesvgpRegle();
        $regle2=$this->getDoctrine()->getRepository(LesvgpRegle::class)->findAll();
        
        $reg['Faites votre choix']=null;
        foreach($regle2 as $key=>$val){
            $reg[$val->getRegle().' - '.$val->getCommentaireRegle()]=$val->getId();
        }
        $form = $this->createFormBuilder($nvelregle)
            ->add('Regle', ChoiceType::class, [
                'choices'=> $reg,
                'required' => 'true',
            ])
            ->add('valide', SubmitType::class)
            ->getForm();  
        //$form = $this->createForm(EspacechoixRegleType::class, $nvelregle);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prepa['regle']=$nvelregle->getRegle();   
            $session->set('prepa', $prepa);
            return $this->redirectToRoute('Espace-Client_PrepaCategorie');
        }

        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir la regle',
            'form' => $form->createView(),
            'retour'=> 'Espace-Client'
        ]);
    }
    /**
     * @Route("/Espace-Client/PrepaCategorie", name="Espace-Client_PrepaCategorie")
     */
    public function PrepaCat(Request $request, SessionInterface $session){
        $prepa=$session->get('prepa', []);
        $nvelCat=new LesvgpCategorie();
        $regle=$this->getDoctrine()->getRepository(LesvgpRegle::class)->findOneBy(['id'=>$prepa['regle']]);
        $categorie=$this->getDoctrine()->getRepository(LesvgpCategorie::class)->findBy(['Regle'=>$regle]);
        $reg['Faites votre choix']=null;
        foreach($categorie as $key=>$val){
            $reg[$val->getCategorie().' - '.$val->getCommentaireCategorie()]=$val->getId();
        }
        $form = $this->createFormBuilder($nvelCat)
            ->add('categorie', ChoiceType::class, [
                'choices'=> $reg,
                'required' => 'true'
            ])
            ->add('valide', SubmitType::class)
            ->getForm();  
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prepa['categorie']=$nvelCat->getCategorie();   
            $session->set('prepa', $prepa);
            return $this->redirectToRoute('Espace-Client_PrepaClients');
        }

        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir le CLient',
            'form' => $form->createView(),
            'retour'=> 'Espace-Client_Prepa'
        ]);
    }

    /**
     * @Route("/Espace-Client/PrepaClients", name="Espace-Client_PrepaClients")
     */
    public function PrepaClients(Request $request, SessionInterface $session){
        $prepa=$session->get('prepa', []);
        $nvelregle=new LesvgpClients();
        $regle=$this->getDoctrine()->getRepository(LesvgpClients::class)->findBy(['User'=>$this->getUser()]);
        $reg['Faites votre choix']=null;
        foreach($regle as $key=>$val){
            $reg[$val->getSociete()]=$val->getId();
        }
        $form = $this->createFormBuilder($nvelregle)
            ->add('societe', ChoiceType::class, [
                'choices'=> $reg,
                'required' => 'true'
            ])
            ->add('valide', SubmitType::class)
            ->getForm();  
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prepa['clients']=$nvelregle->getSociete();   
            $session->set('prepa', $prepa);
            return  $this->redirectToRoute('Espace-Client_PrepaModele');
        }
        $ajout=array('Titre'=>'Ajouter un client', 'Ajouteradresse' => 'Espace-Client_PrepaAjoutClient');
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir la Categorie',
            'form' => $form->createView(),
            'Ajouter' => $ajout,
            'retour'=> 'Espace-Client_PrepaCategorie'
        ]);
    }

    
   

    /**
     * @Route("/Espace-Client/Prepa/Modele", name="Espace-Client_PrepaModele")
     */

     #recupere les donnees de matcli et de modele et fais le trie
     public function Modele(Request $request, SessionInterface $session){
         //les liens d'ajout a l'affichage
        $ajout=array('Titre'=>'Ajouter un modele', 'Ajouteradresse' => 'Espace-Client_PrepaAjoutModele');

        $prepa=$session->get('prepa', []);
        $modele=new LesvgpModele();

        $clients= $this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id' => $prepa['clients']]);
        $categorie= $this->getDoctrine()->getRepository(LesvgpCategorie::class)->findOneBy(['id' => $prepa['categorie']]);
        $matclient=$this->getDoctrine()->getRepository(LesvgpMatcli::class)->findBy(['Clients'=>$clients, 'LesvgpCategorie'=>$categorie]);
        
        if($matclient!=null){
            foreach($matclient as $key=>$val){
                $model[]=$this->getDoctrine()->getRepository(LesvgpModele::class)->findOneBy(['id'=>$val->getLesvgpModele()]);
            }
            //dd($model);
            $reg['Faites votre choix']=null;
            foreach($model as $ky=>$va){
                $marque=$this->getDoctrine()->getRepository(LesvgpMarque::class)->findOneBy(['id'=>$va->getMarque()]);  
                //dd('id=>'.$va->getEnergie()->getId());
                $nrj=$this->getDoctrine()->getRepository(LesvgpEnergie::class)->findOneBy(['id'=>$va->getEnergie()->getId()]);         
                $reg[$marque->getMarque().' - '.$va->getModele().' - '.$va->getCommentaireModele().' - '.$nrj->getEnergie()]=$va->getId();
            }
        }
        if(isset($reg)){
            $form = $this->createFormBuilder($modele)
                ->add('modele', ChoiceType::class, [
                    'choices'=> $reg,
                    'required' => 'true'
                ])
                ->add('valide', SubmitType::class)
                ->getForm();  
            $Commentaire=null;
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $prepa['modele']=$modele->getModele();   
                $session->set('prepa', $prepa);
                return  $this->redirectToRoute('Espace-Client_PrepaReference');
            }
            return $this->render('espace_client/prepa.html.twig', [
                'titre' => 'Choisir la Categorie',
                'form' => $form->createView(),
                'Ajouter' => $ajout
            ]);
        }else{
            $Commentaire='Pas de Modèle enregistré pour ce Client dans Cette réglementation';
            return $this->render('espace_client/prepa.html.twig', [
                'titre' => 'Choisir la Categorie',
                'commentaire'=>$Commentaire,
                'Ajouter' => $ajout,
                'retour'=> 'Espace-Client_PrepaClients'
            ]);
        }
     }

    /**
     * @Route("/Espace-Client/PrepaReference", name="Espace-Client_PrepaReference")
     */
    public function PrepaRef(Request $request, SessionInterface $session){
        $prepa=$session->get('prepa', []);
        //dd($prepa);
        $nvovgp=new LesvgpVgp();
        $vgp=$this->getDoctrine()->getRepository(LesvgpVGP::class)->findBy(['User'=>$this->getUser()]);
        if($vgp){
            $reg['Choisir le rapport de référence']=null;
            foreach($vgp as $num=>$val){
                $reg[$val->getRapport().' - '.$val->getProcont().' - '.$val->getNumserie() ] = $val->getId();
            }
            $form = $this->createFormBuilder($nvovgp)
            ->add('rapport',ChoiceType::class, [
                'choices' => $reg,
            ])
            ->add('Valide', SubmitType::class)
            ->getForm();  
            $commentaire=null;
        }else{
            $form = $this->createFormBuilder($nvovgp)
            ->add('rapport',HiddenType::class, [
                'data' => 'Aucun'
            ])
            ->add('Valide', SubmitType::class)
            ->getForm();  
            $commentaire='Pas de Rapport précédent enregistré.';
        }

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($nvovgp-> getRapport()!='Aucun'){
                $vgp23=$this->getDoctrine()->getRepository(LesvgpVGP::class)->findOneBy(['id'=>$nvovgp->getRapport()]);
                $prepa['formulaire']= $vgp23->getFormulaire()->getId();
                $prepa['ref']=$nvovgp->getRapport();
                //dd($prepa);
                $session->set('prepa', $prepa);
                return  $this->redirectToRoute('Espace-Client_Rapport');
            }else{
                $prepa['ref']=$nvovgp->getRapport();
                $session->set('prepa', $prepa);
                return  $this->redirectToRoute('Espace-Client_PrepaFormulaire');
            }
            

        }

        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir le rapport de référence',
            'commentaire'=>$commentaire,
            'form' => $form->createView(),
            'retour'=> 'Espace-Client_PrepaModele'
        ]);
    }

    /**
     * @Route("/Espace-Client/PrepaFormulaire", name="Espace-Client_PrepaFormulaire")
     */
    public function PrepaForm(Request $request, SessionInterface $session){
        $prepa=$session->get('prepa', []);
        //dd($prepa);
        $nvoform=new LesvgpFormulaire();
        
        $Formu=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findBy(['Regle'=>$prepa['regle']]);
            $reg['Choisir le formulaire']=null;
            foreach($Formu as $num=>$val){
                $reg[$val->getNom().' - '] = $val->getId();
            }
            $form = $this->createFormBuilder($nvoform)
            ->add('nom',ChoiceType::class, [
                'choices' => $reg,
            ])
            ->add('Valide', SubmitType::class)
            ->getForm(); 

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prepa['formulaire']=$nvoform->getNom();
            $session->set('prepa', $prepa);
            return  $this->redirectToRoute('Espace-Client_Rapport');
        }

        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir la Categorie',
            'form' => $form->createView(),
            'retour'=> 'Espace-Client_PrepaReference'

        ]);
    }

/**-----------LES AJOUTS----------------------LES AJOUTS----------------------LES AJOUTS----------------------LES AJOUTS----------------------LES AJOUTS----------------------LES AJOUTS----------- */


      /**
     * @Route("/Espace-Client/PrepaAjoutClients", name="Espace-Client_PrepaAjoutClient")
     */
    public function PrepaAjoutClients(Request $request, SessionInterface $session, EntityManagerInterface $manager){
        $prepa=$session->get('prepa', []);
        $nvocli=new LesvgpClients();
        
        $form = $this->createForm(EspaceCliAjouterClientType::class ,$nvocli);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $nvocli->setUser($this->getUser());
            $manager->persist($nvocli);
            $manager->flush();
            return  $this->redirectToRoute('Espace-Client_PrepaClients');
        }

        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir la Categorie',
            'form' => $form->createView(),

        ]);
    }


    /**
     * @Route("/Espace-Client/Prepa/AjoutModele", name="Espace-Client_PrepaAjoutModele")
     */
    public function PrepaAjoutModele(Request $request, SessionInterface $session, EntityManagerInterface $manager){
        $prepa=$session->get('prepa', []);
        
        $ajout[0]=array('Titre'=>'Ajouter une marque', 'Ajouteradresse' => 'Espace-Client_PrepaAjoutMarque');
        $ajout[1]=array('Titre'=>'Ajouter une énergie', 'Ajouteradresse' => 'Espace-Client_PrepaAjoutEnergie');
        $nvomodele=new LesvgpModele();
        $matcli=new LesvgpMatcli();
        
        $form=$this->createForm(AjoutModeleType::class, $nvomodele);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($nvomodele);
            $manager->flush();
            $clients= $this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id' => $prepa['clients']]);
            $categorie= $this->getDoctrine()->getRepository(LesvgpCategorie::class)->findOneBy(['id' => $prepa['categorie']]);
            $mod=$this->getDoctrine()->getRepository(LesvgpModele::class)->findOneBy([], ['id' => 'desc']);
            $matcli->setLesvgpModele($mod);
            $matcli->setlesvgpCategorie($categorie);
            $matcli->setClients($clients);
            $manager->persist($matcli);
            //dd($matcli);
            $manager->flush();
            return $this->redirectToRoute('Espace-Client_PrepaModele');

        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Choisir ajouter un modèle',
            'Ajouter' =>$ajout,
            'form' => $form->createView(),
            'retour' => 'Espace-Client_PrepaModele'
        ]);
    }
 
    /**
     * @Route("/Espace-Client/Prepa/AjoutMarque", name="Espace-Client_PrepaAjoutMarque")
     */
    public function PrepaAjoutMarque(Request $request, SessionInterface $session, EntityManagerInterface $manager){
        $prepa=$session->get('prepa', []);
        
        $nvomodele=new LesvgpMarque();
        
        $form = $this->createForm(EspaceAjoutMarqueType::class, $nvomodele);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($nvomodele);
            $manager->flush();
            return $this->redirectToRoute('Espace-Client_PrepaAjoutModele');
        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Enregistrer une nouvelle Marque',
            'form' => $form->createView(),
            'retour' => 'Espace-Client_PrepaAjoutModele'
        ]);
    }


    /**
     * @Route("/Espace-Client/Prepa/AjoutEnergie", name="Espace-Client_Prepa_AjoutEnergie")
     */
    public function PrepaAjoutEnergie(Request $request, SessionInterface $session, EntityManagerInterface $manager){
        $prepa=$session->get('prepa', []);
        
        $nvomodele=new LesvgpEnergie();
        
        $form = $this->createForm(EspaceAjoutEnergieType::class, $nvomodele);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($nvomodele);
            $manager->flush();
            return $this->redirectToRoute('Espace-Client_PrepaAjoutModele');
        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Enregistrer une nouvelle énergie',
            'form' => $form->createView(),
            'retour' => 'Espace-Client_PrepaAjoutModele'
        ]);
    }

//--------------CLIENTS--------------------------------CLIENTS--------------------------------CLIENTS--------------------------------CLIENTS--------------------------------CLIENTS------------------ */

    /**
     * @Route("Espace-Client/Clients/Ajouter", name="Espace-Client_Clients_Ajouter")
     * 
     */
    public function AjoutClients( SessionInterface $session, Request $request, EntityManagerInterface $manager){
        $prepa=$session->get('prepa', []);
        $clients=new LesvgpClients();
        
        $form=$this->createForm(EspaceClientAjoutClientType::class, $clients );
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $clients->setUser($this->getUser());
            $manager->persist($clients);
            $manager->flush();
            return $this->redirectToRoute('Espace-Client');

        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Ajouter un Client',
            'form' => $form->createView(),
            'retour' => 'Espace-Client'
        ]);
    }

     /**
     * @Route("Espace-Client/Clients/Choisir/{action}", name="Espace-Client_Clients_Choisir")
     * 
     */
    public function ChoixClients( SessionInterface $session, Request $request, $action){
        //dd($action);
        $cli=$session->get('Clients', []);
        $client=new LesvgpClients();
        $clients=$this->getDoctrine()->getRepository(Clients::class)->findBy(['id_User'=>$this->getUser()->getId()]);
        foreach($clients as $key=>$val){
            $reg[$val->getSociete()]=$val->getId();
        }        
        $form=$this->createFormBuilder($client)
            ->add('Societe', ChoiceType::class,[
                'choices'=>$reg,
                'label'=>'Choisir votre client'
            ])
            ->add('valide', SubmitType::class)
            ->getForm();
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $cli['clients']=$client->getSociete();
            $session->set('Clients', $cli);

            return $this->redirectToRoute('Espace-Client_Clients_'.$action);

        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Ajouter un Client',
            'form' => $form->createView(),
            'retour' => 'Espace-Client'
        ]);
    }

    /**
     * @Route("Espace-Client/Clients/Modifier", name="Espace-Client_Clients_Modifier")
     * 
     */
    public function ModifClients( SessionInterface $session, Request $request, EntityManagerInterface $manager){
        $cli=$session->get('Clients', []);
        //dd($cli);
        $client=$this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id'=>$cli['clients']]);
        $form=$this->createForm(ChoixClientsType::class, $client);
           
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('Espace-Client');

        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Ajouter un Client',
            'form' => $form->createView(),
            'retour' => 'Espace-Client'
        ]);
    }

    
    /**
     * @Route("Espace-Client/Clients/Supprimer", name="Espace-Client_Clients_Supprimer")
     * 
     */
    public function SupprClients( SessionInterface $session, Request $request, EntityManagerInterface $manager){
        $cli=$session->get('Clients', []);
        $client=$this->getDoctrine()->getRepository(LesvgpClients::class)->findOneBy(['id'=>$cli['clients']]);
        $form=$this->createFormBuilder( $client)
            ->add('gfjhg')
            ->getForm();
           
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
     
            return $this->redirectToRoute('Espace-Client');

        }
        return $this->render('espace_client/prepa.html.twig', [
            'titre' => 'Ajouter un Client',
            //'form' => $form->createView(),
            'retour' => 'Espace-Client'
        ]);
    }
}
