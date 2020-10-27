<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteClientController extends AbstractController
{
    /**
     * @Route("/compte/client", name="compte_client")
     */
    public function index(): Response
    {
        return $this->render('compte_client/index.html.twig', [
            'controller_name' => 'CompteClientController',
        ]);
    }
}
