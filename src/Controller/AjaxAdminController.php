<?php

namespace App\Controller;

use App\Entity\LesvgpRegle;
use App\Entity\LesvgpTitre;
use App\Entity\LesvgpQuestion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxAdminController extends AbstractController
{
    /**
     * @Route("/ajax/admin", name="ajax_admin")
     */
    public function index(): Response
    {
        return $this->render('ajax_admin/index.html.twig', [
            'controller_name' => 'AjaxAdminController',
        ]);
    }

     /**
     * @Route("/admin/ajax/QuestionnaireAjax", name="admin_QuestionnaireAjax")
    */
    public function AjoutQuestionnaireAjax(Request $request, SessionInterface $session)
    {
        $admin=$session->get('admin', []);
        $titre=$this->getDoctrine()->getRepository(LesvgpTitre::class)->findAll();
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach ($titre as $student) {
                //dd($student);
                $temp = array(
                    'name' => $student->getTitre(),
                    'id' =>  $student->getId()
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('ajax_admin/index.html.twig', [
                'temp' =>$titre
            ]);
        }
    }

    /**
     * @Route("/admin/ajax/Questions", name="adminajax__Questions", methods={"GET"})
    */
    public function gestionquestion(Request $request, SessionInterface $session)
    {
        $admin=$session->get('admin', []);
        $regle=$this->getDoctrine()->getRepository(LesvgpRegle::class)->findOneBy(['id' => $_GET['regle']]);
        $quest=$this->getDoctrine()->getRepository(LesvgpQuestion::class)->findBy(['Titre'=>$_GET['idtitre'], 'Regle'=>$regle],['Titre'=>'ASC']);
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach ($quest as $student) {
                //dd($student);
                $temp = array(
                    'question' => $student->getQuestion(),
                    'verif' =>$student->getVerif(),
                    'id' =>  $student->getId()
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('ajax_admin/index.html.twig', [
                'temp'=> $quest,   
            ]);
        }
    }
}
