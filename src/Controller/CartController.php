<?php

namespace App\Controller;

use App\Entity\Annonces;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
      #[Route("/cart/{id}", name:"app_cart")]
     
    public function show($id): Response
    {
        $annonce = $this->entityManager->getRepository(Annonces::class)->find($id);

       
        $annonceData = [
            'id' => $id,
            'description' => $annonce->getDescription(),
            'surface' => $annonce->getSurface(),
            'price' => $annonce->getPrice(),
            'image' => $annonce->getImage(),
        ];

        return $this->render('cart/cart.html.twig', [
            'annonce' => $annonceData,
        ]);
    }
}

