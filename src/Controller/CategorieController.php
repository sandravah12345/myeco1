<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Form\CategoriemodifType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
private $manager;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(Request $request): Response
    {

        $categorie = new Categorie;
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($categorie);
            $this->manager->flush();
            return $this->redirectToRoute('app_categorie', []);
        }
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'form' => $form->createView(),
        ]);
    }
    #[Route('/categorie/modification/{id}', name: 'app_categorie_modif')]
    public function modifyCategorie(Categorie $categorie, Request $request, EntityManagerInterface $entityManager): Response {

        $form = $this->createForm(CategoriemodifType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie');
        }

        return $this->render('categorie/modification.html.twig',[
            'form' => $form->createView(),
            'categorie' => $categorie,
        
        ]);
}
} 
