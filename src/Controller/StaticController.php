<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
// src/Controller/StaticController.php
{
    #[Route('/faq', name: 'app_faq')]
    public function index(): Response
    {
        return $this->render('static/faq.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }

    // #[Route('/static', name: 'app_faq')]
    // public function faq(): Response
    // {
    //     return $this->render('static/faq.html.twig', [
    //         'controller_name' => 'StaticController',
    //     ]);
    // }

    #[Route('/livraison', name: 'app_livraison')]
    public function livrasion(): Response
    {
        return $this->render('static/livraison.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }
    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('static/cgv.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }
    #[Route('/vie', name: 'app_vie')]
    public function vie(): Response
    {
        return $this->render('static/vie.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }
}
