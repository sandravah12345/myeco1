<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
 {
     private $produitRepository;
     public function __construct (ProduitRepository $produitRepository){
         $this->produitRepository = $produitRepository;
     }
     #[Route('/panier', name: 'app_panier')]
     public function index(SessionInterface $session): Response
     {

         $this->denyAccessUnlessGranted('ROLE_USER');

         $panier = $session->get('panier', []);    
        //  $produit = $this->produitRepository->findByIds($session->get('panier'));
         // $produit = $this->produitRepository->findByIds(array_keys($panier));
 // dump($produit);
 // die;
         return $this->render('panier/index.html.twig', [
             'panier' => $panier,
        //      'produit'=> $produit
         ]);
     }

     #[Route('/panier/{produitId}', name: 'app_ajouter_panier')]
 public function ajouterAuPanier($produitId, SessionInterface $session,ManagerRegistry $manager)
 {
     $panier = $session->get('panier', []);

     // Vérifiez si l'article est déjà dans le panier
     if (isset($panier[$produitId])) {
         $panier[$produitId]['quantite']++;
     } else {
         // Récupérez les détails de l'article depuis votre base de données
         $produit = $manager->getManager()->getRepository(Produit::class)->find($produitId);

         // Ajoutez les détails de l'article dans le panier
         if ($produit) {
             $panier[$produitId] = [
                 'quantite' => 1,
                 'nom' => $produit->getName(),
                 'prix' => $produit->getPrice(),
                 // Ajoutez d'autres détails ici
             ];
         }
     }

     $session->set('panier', $panier);

     return $this->redirectToRoute('app_panier');
 }

//  #[Route('/panier/supprimer/{produitId}', name: 'app_supprimer_panier')]
//  public function supprimerDuPanier($produitId, SessionInterface $session)
//  {
//      $panier = $session->get('panier', []);
 
//      // Check if the article is in the cart
//      if (isset($panier[$produitId])) {
//          // Remove the item from the cart
//          unset($panier[$produitId]);
         
//      }
 
//      $session->set('panier', $panier);
 
//      return $this->redirectToRoute('app_panier');
//  }

//  public function calculatePanierTotal(SessionInterface $session, ManagerRegistry $manager): float
// {
//     $panier = $session->get('panier', []);
//     $total = 0.0;

//     foreach ($panier as $produitId => $item) {
//         // Retrieve the product's price from the database
//         $produit = $manager->getManager()->getRepository(Produit::class)->find($produitId);

//         if ($produit) {
//             // Calculate the item total (price * quantity) and add it to the overall total
//             $itemTotal = $produit->getPrice() * $item['quantite'];
//             $total += $itemTotal;
//         }
//     }

//     return $total;
// }

// public function total(SessionInterface $session, ManagerRegistry $manager): Response
// {
//     $this->denyAccessUnlessGranted('ROLE_USER');

//     $panier = $session->get('panier', []);
//     $total = $this->calculatePanierTotal($session, $manager);

//     return $this->render('panier/index.html.twig', [
//         'panier' => $panier,
//         'total' => $total,
//     ]);
// }

    
}

