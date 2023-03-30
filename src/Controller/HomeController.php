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
                'id'=> $annonce->getId(),
                'description' => $annonce->getCompany(),
                'surface' => $annonce->getSurface(),
                'address' => $annonce->getAddress(),
                'type' => $annonce->getType(),
                'company' => $annonce->getCompany(),
                'price' => $annonce->getPrice(),
                'image' => $annonce->getImage(),
            ];
        }

        return $this->render('home/index.html.twig', [
            'annonces' => $annonceData,
        ]);
    }
}