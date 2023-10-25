<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProduitController extends AbstractController
{

    
    private $manager;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }

    
    #[Route('/produit', name: 'app_produit')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $produit = new Produit;
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPhotoFile = $form->get('image')->getData();

            if ($newPhotoFile) {
                $cheminOrigine = pathinfo($newPhotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($cheminOrigine);
                $nouveauChemin = $safeFilename . '-' . uniqid() . '.' . $newPhotoFile->guessExtension();

                try {
                    $newPhotoFile->move(
                        $this->getParameter('IMG_URL_PRODUIT'),
                        $nouveauChemin
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue : ' . $e->getMessage());
                    return $this->redirectToRoute('app_produit');
                }
                $produit->setImage($nouveauChemin);
            }
            $this->manager->persist($produit);
            $this->manager->flush();
            return $this->redirectToRoute('app_produit', []);
        }
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'form' => $form->createView(),
        ]);

        
    }
    #[Route('/produit/affichage', name: 'app_affichage')]
    public function affichage(): Response
    {


        $produits = $this->manager->getRepository(Produit::class)->findAll();

        return $this->render('produit/affichage.html.twig', [
            "produits"=> $produits


        ]);
    } 

    #[Route('/produit/homme', name: 'app_homme')]
    public function affichageHomme(EntityManagerInterface $entityManager): Response
    {


        $repository = $entityManager->getRepository(Produit::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.categorie = :categorieId')
            ->setParameter('categorieId',3)
            ->getQuery();

            $produits = $query->getResult();

        return $this->render('produit/homme.html.twig', [
            "produits"=> $produits


        ]);
    } 

    #[Route('/produit/femme', name: 'app_femme')]
    public function affichageFemme(EntityManagerInterface $entityManager): Response
    {


        $repository = $entityManager->getRepository(Produit::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.categorie = :categorieId')
            ->setParameter('categorieId',4)
            ->getQuery();

            $produits = $query->getResult();

        return $this->render('produit/femme.html.twig', [
            "produits"=> $produits


        ]);
    } 

    #[Route('/produit/enfant', name: 'app_enfant')]
    public function affichageEnfant(EntityManagerInterface $entityManager): Response
    {


        $repository = $entityManager->getRepository(Produit::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.categorie = :categorieId')
            ->setParameter('categorieId',5)
            ->getQuery();

            $produits = $query->getResult();

        return $this->render('produit/enfant.html.twig', [
            "produits"=> $produits


        ]);
    } 
    #[Route('/produit/modification/{id}', name: 'app_modif')]
    public function modifyProduit(Produit $produit, Request $request, EntityManagerInterface $entityManager): Response {

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/modification.html.twig',[
            'form' => $form->createView(),
            'produit' => $produit,
            
        ]);
    }

    #[Route('/produit/delete/{id}', name: 'app_delete_produit')]
    public function deleteProduit(int $id, Request $request): Response
    {
        if ($this->isCsrfTokenValid('supprimer', $request->query->get('token', ''))) {
        if ($id) {
            $produit  = $this->manager->getRepository(Produit::class)->find($id);
            $this->manager->remove($produit);
            $this->manager->flush();
        }

        return $this->redirectToRoute('app_produit');    } else {
            throw new BadRequestException('Token CSRF invalide.');
        }
    }
     } 





