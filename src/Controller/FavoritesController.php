<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Annonces;
use App\Entity\Favorites;
use App\Repository\FavoritesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavoritesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/annonce/{id}/manage_favorites/{page}', name: 'app_manage_favorites')]
    public function manageFavorites(Annonces $annonces, EntityManagerInterface $entityManager, Request $request): Response
    {
        // Get the current user
        $user = $this->getUser();

        // Redirect the user to the login page if they are not logged in
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Handle POST requests (add a favorite)
        if ($request->isMethod('POST')) {
            // Check if the user has already added this annonce to their favorites
            $existingFavorite = $entityManager
                ->getRepository(Favorites::class)
                ->findOneBy(['annonce' => $annonces, 'user' => $user]);

            if (!$existingFavorite) {
                // Create a new favorite
                $favorites = new Favorites();
                $favorites->setUser($user);
                $favorites->setAnnonce($annonces);

                // Save the new favorite to the database
                $entityManager->persist($favorites);
                $entityManager->flush();
            }
        }

        // Handle DELETE requests (remove a favorite)
        if ($request->isMethod('DELETE')) {
            // Get the favorite record for the current user and annonce
            $existingFavorite = $entityManager
                ->getRepository(Favorites::class)
                ->findOneBy(['annonce' => $annonces, 'user' => $user]);

            // If a favorite exists, remove it from the database
            if ($existingFavorite) {
                $entityManager->remove($existingFavorite);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('app_purchase', ['id' => $annonces->getId()]);
    }

}
