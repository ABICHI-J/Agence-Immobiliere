<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces')]
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        $annonces = $annoncesRepository->findAll();

        return $this->render('annonces/annonces.html.twig', [
            'annonces' => $annonces,
        ]);
    }
}
 ?>