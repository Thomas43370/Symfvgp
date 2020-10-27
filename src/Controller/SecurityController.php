<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/Acces_Membres", name="security_login")
     */
    public function index()
    {
        if ($this->getUser()) {
            //dd($this->getUser());
            return $this->redirectToRoute('Espace-Client');
        }
        
        return $this->render('security/index.html.twig', [
        ]);
    }

    /**
     * @Route("/Deconnexion", name="security_logout")
     */

    public function Logout()
    {
    }
}
