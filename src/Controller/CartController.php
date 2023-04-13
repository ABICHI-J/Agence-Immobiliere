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
            'agency' => $annonce->getAgency(),
            'type' => $annonce->getType(),
            'furnished' => $annonce->getFurnished(),
            'rooms' => $annonce->getRooms(),
            'bedrooms' => $annonce->getBedrooms(),
            'lift' => $annonce->getLift(),
            'balcony' => $annonce->getBalcony(),
            'patio' => $annonce->getPatio(),
            'floor' => $annonce->getFloor(),
            'surface' => $annonce->getSurface(),
            'price' => $annonce->getPrice(),
            'address' => $annonce->getAddress(),
            'image' => $annonce->getImage(),
            'description' => $annonce->getDescription(),
            
        ];

        return $this->render('cart/cart.html.twig', [
            
            'annonce' => $annonceData,
        ]);
    }
    
}

