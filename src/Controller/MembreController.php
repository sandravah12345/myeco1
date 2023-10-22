<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModificationUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MembreController extends AbstractController
{

    private $manager;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }
    
    #[Route('/membre', name: 'app_membre')]
    public function index(): Response
    {
        return $this->render('membre/MonCompte.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }

    #[Route('/membre/modification/{id}', name: 'app_modify_user')]
    public function modifyUser(Request $request, EntityManagerInterface $entityManager, User $user)
    {
        
        $form = $this->createForm(ModificationUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute('app_membre', []);
        }

        return $this->render('membre/modification.html.twig', [
            'form' => $form->createView(),
            'user' => $user,

        ]);
    }
}


