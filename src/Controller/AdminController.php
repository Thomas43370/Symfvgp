<?php

namespace App\Controller;

use App\Entity\LesvgpRegle;
use App\Entity\LesvgpTitre;
use App\Form\AjoutRegleType;
use App\Form\AjoutTitreType;
use App\Entity\LesvgpQuestion;
use App\Entity\LesvgpCategorie;
use App\Entity\LesvgpFormulaire;
use App\Form\AjoutCategorieType;
use App\Entity\LesvgpProposition;
use App\Form\AdminAjQuestionType;
use App\Entity\LesvgpQuestionnaire;
use App\Form\AdminAjPropositionType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/Menu.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/AjRegle", name="adminAjRegle")
     */
    public function AjoutRegle(Request $request, EntityManagerInterface $manager): Response
    {
        $regle=new LesvgpRegle();
        $form=$this->createForm(AjoutRegleType::class, $regle);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($regle);
            $manager->flush();
            $this->redirectToRoute('adminAjCategorie');
        }
        
        return $this->render('admin/index.html.twig', [
            'titre'=>'Ajouter une Regle',
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/admin/AjCategorie", name="adminAjCategorie")
     */
    public function AjoutCategorie(Request $request, EntityManagerInterface $manager): Response
    {
        $regle=new LesvgpCategorie();
        $form=$this->createForm(AjoutCategorieType::class, $regle);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($regle);
            $manager->flush();
            $this->redirectToRoute('admin');
        }
        
        return $this->render('admin/index.html.twig', [
            'titre'=>'Ajouter une Categorie',
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/AjTitre", name="adminAjTitre")
     */
    public function AjoutTitre(Request $request, EntityManagerInterface $manager): Response
    {
        $titre=new LesvgpTitre();
        $form=$this->createForm(AjoutTitreType::class, $titre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($titre);
            $manager->flush();
            $this->redirectToRoute('admin');
        }
        
        return $this->render('admin/index.html.twig', [
            'titre'=>'Ajouter un titre',
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/AjQuestion", name="adminAjQuestion")
     */
    public function AjoutQuestion(Request $request, EntityManagerInterface $manager): Response
    {
        $regle=new LesvgpQuestion();
        $form=$this->createForm(AdminAjQuestionType::class, $regle);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($regle);
            $manager->flush();
            $this->redirectToRoute('admin');
        }
        
        return $this->render('admin/index.html.twig', [
            'titre'=>'Ajouter une Question',
            'form'=>$form->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/AjProposition", name="adminAjProposition")
     */
    public function AjoutProposiion(SessionInterface $session, Request $request, EntityManagerInterface $manager): Response
    {
        $admin=$session->get('admin', []);
        $regle=new LesvgpProposition();
        $form=$this->createForm(AdminAjPropositionType::class, $regle);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($regle);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        
        return $this->render('admin/index.html.twig', [
            'titre'=>'Ajouter une Proposition',
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/admin/ChoixRegle", name="adminChoixRegle")
     */
    public function ChoixRegle(SessionInterface $session, Request $request)
    {
        $admin=$session->get('admin', []);
        $choix=new LesvgpRegle();
        $regle=$this->getDoctrine()->getRepository(LesvgpRegle::class)->findAll();
        foreach($regle as $num=>$val){
            $reg[$val->getRegle().' - '.$val->getCommentaireRegle()]=$val->getId();
        }
        $form=$this->createFormBuilder($choix)
            ->add('Regle', ChoiceType::class, [
                'choices'=>$reg,
                'required'=>true
            ])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin['regle']=$choix->getregle();   
            $session->set('admin', $admin);
            if($admin['regle']!=NULL){
                return $this->redirectToRoute('adminChoixCategorie');
            }
        }

        return $this->render('admin/index.html.twig', [
                'titre'=>'Choisir la regle',
                'form'=>$form->createView(),
            ]);
    }
    
    /**
     * @Route("/admin/ChoixCategorie", name="adminChoixCategorie")
     */
    public function ChoixCategorie(SessionInterface $session, Request $request)
    {
        $admin=$session->get('admin', []);
        //dd($admin);
        $choix=new LesvgpCategorie();
        $regle=$this->getDoctrine()->getRepository(LesvgpCategorie::class)->findAll();
        foreach($regle as $num=>$val){
            $reg[$val->getCategorie().' - '.$val->getCommentaireCategorie()]=$val->getId();
        }
        $form=$this->createFormBuilder($choix)
            ->add('Categorie', ChoiceType::class, [
                'choices'=>$reg,
                'required'=>true
            ])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin['categorie']=$choix->getCategorie();
            $session->set('admin', $admin);
            return $this->redirectToRoute('admin_Menu_Formulaire');
        }

        return $this->render('admin/index.html.twig', [
                'titre'=>'Choisir la Categorie',
                'form'=>$form->createView(),
            ]);
    }

    /**
     * @Route("/admin/PropositionsEquipement", name="adminPropositions_Equipement")
     */
    public function AjoutPropositionsEquipement(Request $request, EntityManagerInterface $manager, SessionInterface $session)
    {
        $admin=$session->get('admin', []);
        //dd($admin);
        if(!isset($admin['regle']) || $admin['regle']==null){
            return $this->redirectToRoute('adminChoixRegle');
         }
        
        return $this->render('admin/PropQuestEqui.html.twig', [
            'session'=>$admin,
        ]);
    }

    /**
     * @Route("/admin/EnregistrePropositionsEquipement", name="adminEnregistrePropositions_Equipement")
     */
    public function EnregistrePropositionsEquipement(Request $request, EntityManagerInterface $manager, SessionInterface $session)
    {
        $admin=$session->get('admin', []);
        $proposition=new LesvgpProposition();
        $Cat=$this->getDoctrine()->getRepository(LesvgpCategorie::class)->findOneBy(['id'=>$admin['regle']]);
        if(isset($_POST)){
            foreach($_POST as $nom=>$val){
                if($val!=null){
                    if($nom!='Nomequipement'){    
                        $donnees[$nom]=$val;
                    }
                }
            }
            //dd($_POST);
            $proposition->setProposition($_POST['Nomequipement']);
            $proposition->setType('text');
            $proposition->setCategorie($Cat);
            $proposition->setCateg('equipement');
            $proposition->setEquipements(json_encode($donnees));
            $manager->persist($proposition);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }      
        
        
    }

/**---Formulaire--------Formulaire--------Formulaire--------Formulaire--------Formulaire----- */   
    
    /**
     * @Route("/admin/Menu/Formulaires", name="adminAjFormulaire")
     */
    public function AjoutForm(SessionInterface $session)
    {
        
        #il manque le levage et la duree, pense a creer un ajout d'equipement!!!!!
        $admin=$session->get('admin', []);
        $Cat=$this->getDoctrine()->getRepository(LesvgpCategorie::class)->findOneBy(['id'=>$admin['regle']]);
        $Propositioncommune=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findBy(['Categorie'=>$Cat, 'categ'=>'commun']);
        if(!$Propositioncommune){
            $Propositioncommune=null;
        }
        //dd($admin);
        $Propositionlevage=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findBy(['Categorie'=>$Cat, 'categ'=>'levage']);
        if(!$Propositionlevage){
            $Propositionlevage=null;
        }
        $Propositionequipement=$this->getDoctrine()->getRepository(LesvgpProposition::class)->findBy(['Categorie'=>$Cat, 'categ'=>'equipement']);
        if(!$Propositionequipement){
            $Propositionequipement=null;
        }
        //dd($Proposition);
        return $this->render('admin/formulaire.html.twig', [
               'propositionco'=>$Propositioncommune,
               'propositionle'=>$Propositionlevage,
               'propositioneq'=>$Propositionequipement,
        ]);
    }

    /**
     * @Route("/admin/Menu/CofirmFormulaires", name="adminConfirmAjFormulaire")
     */
    public function AjoutFormulaire(SessionInterface $session, EntityManagerInterface $manager)
    {
        $admin=$session->get('admin', []);
        $regle=$this->getDoctrine()->getRepository(LesvgpRegle::class)->findOneBy(['id'=>$admin['regle']]);
        $formulaire=new LesvgpFormulaire();
        if(isset($_POST)){
           //dd($_POST);
            foreach($_POST as $nom=>$val){
                if($val=='oui' && $nom!='levage'){
                    $pan=explode('-', $nom);
                    if($pan[0]=='Commun'){
                        $commun[$pan[1]]=0;
                    }elseif($pan[0]=='Equipement'){
                        $equipement[$pan[1]]=0;
                    }else{
                        $levage[$pan[1]]=0;
                    }
                }
            }
            if(isset($commun) && $commun!=null){
                $don['Commun']=$commun;    
            }
            if(isset($levage) && $levage!=null){
                $don['Levage']=$levage;
            }
            if (isset($equipement) && $equipement!=null) {
                $don['Equipement']=$equipement;
            }
            //dd($don);
            $formulaire->setDonnees(json_encode($don));
        }
        $formulaire->setNom($_POST['nom']);
        $formulaire->setLevage($_POST['levage']);
        $formulaire->setDuree($_POST['duree']);
        if(isset($_POST['commentaire']) && $_POST['commentaire']!=null){
            $formulaire->setCommentaireFormulaire($_POST['commentaire']);
        }
        $formulaire->setQuestionnaire($_POST['questionnaire']);
        $formulaire->setRegle($regle);
        $manager->persist($formulaire);
        $manager->flush();
        $form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy([], ['id' => 'desc']);
        $admin['formulaire']=$form->getId();
        $session->set('admin', $admin);

        if($_POST['questionnaire']==true){
            $admin['formulaire']=$formulaire->getId();
            $admin['levage']=$_POST['levage'];
            return $this->redirectToRoute('adminAjQuestionnaire');
        }else{
            return $this->redirectToRoute('admin_Menu');
        }
    }
   
/**-----Questionnnaire---------Questionnnaire---------Questionnnaire---------Questionnnaire---------Questionnnaire---------Questionnnaire---- */


     /**
     * @Route("/admin/AjQuestionnaires", name="adminAjQuestionnaire")
     */
    public function AjoutQuestionnaire(SessionInterface $session)
    {
        for($i='a'; $i<'z'; $i++){
            $lettres[]=strtoupper ($i);
        }
        //dd($lettres);
        $admin=$session->get('admin', []);
        
        //dd($Proposition);
        return $this->render('admin/questionnaire.html.twig', [
            'regle'=>$admin['regle']
        ]);
    }

    /**
     * @Route("/admin/AjoutQuestionnaires", name="adminAjoutQuestionnaire")
     */
    public function AjouterQuestionnaire(SessionInterface $session, EntityManagerInterface $manager)
    {
        $admin=$session->get('admin', []);
        $questionnaire=new LesvgpQuestionnaire();
        $form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy([], ['id' => 'desc']);
        //$form=$this->getDoctrine()->getRepository(LesvgpFormulaire::class)->findOneBy(['id' => $admin['formlaire']]);
        $lettre='';
        foreach($_POST as $key=>$val){
            if($val!=null && $key!='regle'){
                $pan=explode('-', $key);
                if($pan[0]=='titre'){
                    $lettre=$pan[1];
                    $tab[$lettre][$key]=$val;
                }else{
                    $tab[$lettre][$key]=$val;
                }
            }
        }
        $questionnaire->setDonnees(json_encode($tab));
        $questionnaire->setFormulaire($form);
        //dd($questionnaire);
        $manager->persist($questionnaire);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }

}
