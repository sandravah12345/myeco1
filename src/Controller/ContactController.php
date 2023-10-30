<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    private $manager; 
    
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }
    
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                // Handle form submission
            }
        
            return $this->render('contact/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }

//         if($this->getUser()) {
//             $contact->setNom($this->getUser()->getNom())
//                     ->setPrenom($this->getUser()->getPrenom())
//                     ->setEmail($this->getUser()->getEmail());
//         }

//         if ($form->isSubmitted() && $form->isValid()) {
//             $this->manager->persist($contact);
//             $this->manager->flush();
//             return $this->redirectToRoute('app_contact', []);
//         }
// }
}



