<?php

namespace App\Controller;

use App\Form\UsersType;
use App\Entity\LesvgpUsers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LesvgpfacilesController extends AbstractController
{
    /**
     * @Route("/lesvgpfaciles", name="lesvgpfaciles")
     */
    public function index(): Response
    {
        return $this->render('lesvgpfaciles/index.html.twig', [
            'controller_name' => 'LesvgpfacilesController',
        ]);
    }

    /**
     * @Route("/Inscription", name="Inscription")
     */
    public function Inscription(Request $request, EntityManagerInterface $entitymanager, UserPasswordEncoderInterface $encoder)
    {
        $user=new LesvgpUsers();

        $form=$this->createForm(UsersType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //dd($user);
            $hash= $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $entitymanager->persist($user);
            $entitymanager->flush();
            return $this->redirectToRoute('security_login');
        }

        return $this->render('lesvgpfaciles/Inscription.html.twig', [
            'form'=> $form->createView(),
            'titre' => 'titre',
        ]);
    }
}
