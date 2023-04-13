<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/favoris', name: 'app_favoris')]
    public function favoris(): Response
    {
        
        return $this->render('account/favoris.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/gestion', name: 'app_gestion')]
    public function gestion(): Response
    {
        return $this->render('account/gestion.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/gestion/infos-personnelles', name: 'app_infos-personnelles')]
    public function infosPersonnelles(): Response
    {
        return $this->render('account/infos-personnelles.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/account/gestion/identifiants', name: 'app_identifiants')]
    public function identifiants(): Response
    {
        return $this->render('account/identifiants.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
