<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
// src/Controller/StaticController.php
{
    public function faq(): Response
    {
        return $this->render('static/faq.html.twig');
    }

    public function about(): Response
    {
        return $this->render('static/about.html.twig');
    }

    public function contact(): Response
    {
        return $this->render('static/contact.html.twig');
    }
}
