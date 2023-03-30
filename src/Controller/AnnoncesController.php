<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use App\Repository\PurchaseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    #[Route('/rent', name: 'app_rent')]
    public function index(Request $request, AnnoncesRepository $annoncesRepository)
    {
        $surface = $request->query->get('surface');
        $price = $request->query->get('prix');
        $sort = $request->query->get('sort');
        $order = $request->query->get('order');

        // $annonces = $annoncesRepository->filter('price' >= 10);
        $annonces = $annoncesRepository->findAll();

        // Appliquez les filtres si nécessaire
        if ($surface) {
            $annonces = array_filter($annonces, function($annonce) use ($surface) {
                return $annonce->getSurface() <= $surface;
            });
        }
        if ($price) {
            $annonces = array_filter($annonces, function($annonce) use ($price) {
                return $annonce->getPrice() <= $price;
            });
        }

        // Trier les résultats si nécessaire
        if ($sort && $order) {
            usort($annonces, function($annonceA, $annonceB) use ($sort, $order) {
                $a = $annonceA->$sort();
                $b = $annonceB->$sort();
                if ($order == 'asc') {
                    return ($a < $b) ? -1 : 1;
                } else {
                    return ($a < $b) ? 1 : -1;
                }
            });
        }

        return $this->render('annonces/rent.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    #[Route('/purchase', name: 'app_purchase')]
    public function purchase(Request $request, AnnoncesRepository $annoncesRepository)
    {
        $surface = $request->query->get('surface');
        $price = $request->query->get('prix');
        $sort = $request->query->get('sort');
        $order = $request->query->get('order');

        // $annonces = $annoncesRepository->filter('price' >= 10);
        $annonces = $annoncesRepository->findAll();

        // Appliquez les filtres si nécessaire
        if ($surface) {
            $annonces = array_filter($annonces, function($annonce) use ($surface) {
                return $annonce->getSurface() <= $surface;
            });
        }
        if ($price) {
            $annonces = array_filter($annonces, function($annonce) use ($price) {
                return $annonce->getPrice() <= $price;
            });
        }

        // Trier les résultats si nécessaire
        if ($sort && $order) {
            usort($annonces, function($annonceA, $annonceB) use ($sort, $order) {
                $a = $annonceA->$sort();
                $b = $annonceB->$sort();
                if ($order == 'asc') {
                    return ($a < $b) ? -1 : 1;
                } else {
                    return ($a < $b) ? 1 : -1;
                }
            });
        }

        return $this->render('annonces/purchase.html.twig', [
            'annonces' => $annonces,
        ]);
    }
}
?>
