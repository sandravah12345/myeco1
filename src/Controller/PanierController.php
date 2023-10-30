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
        $produit = $this->produitRepository->findByIds($session->get('panier'));
        // $produit = $this->produitRepository->findByIds(array_keys($panier));
// dump($produit);
// die;
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'produit'=> $produit
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

}
