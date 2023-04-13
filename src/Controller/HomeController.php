<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AnnoncesRepository $repositoryAnnonces): Response
    {
        $annonces = $repositoryAnnonces->findAll();

        $annonceData = [];

        foreach ($annonces as $annonce) {
            $annonceData[] = [
                'id' => $annonce->getId(),
                'image' => $annonce->getImage(),
                'agency' => $annonce->getAgency(),
                'type' => $annonce->getType(),
                'price' => $annonce->getPrice(),
                'rooms' => $annonce->getRooms(),
                'bedrooms' => $annonce->getBedrooms(),
                'surface' => $annonce->getSurface(),
                'floor' => $annonce->getFloor(),
                'address' => $annonce->getAddress(),
                'description' => $annonce->getAgency(),
                
            ];
        }

        return $this->render('home/index.html.twig', [
            'annonces' => $annonceData,
        ]);
    }
}
