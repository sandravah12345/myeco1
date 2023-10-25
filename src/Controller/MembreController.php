<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categorie;
use App\Form\ModificationUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('membre/MonCompte.html.twig', [
            
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
    #[Route('/membre/delete/{id}', name: 'app_delete_membre')]
    public function deleteUser(int $id, Request $request): Response
    {
        if ($this->isCsrfTokenValid('supprimer', $request->query->get('token', ''))) {
        if ($id) {
            $user  = $this->manager->getRepository(User::class)->find($id);
            $this->manager->remove($user);
            $this->manager->flush();
        }

        return $this->redirectToRoute('app_membre');    } else {
            throw new BadRequestException('Token CSRF invalide.');
        }
    }
}


