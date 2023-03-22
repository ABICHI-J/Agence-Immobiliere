<?php

namespace App\Controller;

use App\Entity\Annonces;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{#[Route('/cart', name: 'app_cart')]

    public function show(Annonces $annonces): Response
    {
        return $this->render('cart/show.html.twig', [
            'annonces' => $annonces,
        ]);
    }
}
