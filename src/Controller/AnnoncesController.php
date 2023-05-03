<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Annonces;
use App\Entity\Favorites;
use App\Form\AnnoncesType;
use Cocur\Slugify\Slugify;
use App\Data\AnnonceSearch;
use App\Services\UploadFile;
use App\Form\AnnonceSearchType;
use App\Repository\UserRepository;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\EntityManagerInterface;    
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    #[Route('/rent', name: 'app_rent')]
    public function index(Request $request, AnnoncesRepository $annoncesRepository,EntityManagerInterface $entityManager)
    {
        $allAnnonces = $annoncesRepository->findAll();

        $data = new AnnonceSearch();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(AnnonceSearchType::class, $data);
        $form->handleRequest($request);
        $annonces = $annoncesRepository->findSearch($data);
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        return $this->render('annonces/rent.html.twig', [
            'allAnnonces' => $allAnnonces,
            'form' => $form->createView(),
            'annonces' => $annonces,
            'page' => $page
        ]);
    }

    #[Route('/purchase', name: 'app_purchase')]
    public function purchase(Request $request, AnnoncesRepository $annoncesRepository, EntityManagerInterface $entityManager)
    {
        $allAnnonces = $annoncesRepository->findAll();
        $data = new AnnonceSearch();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(AnnonceSearchType::class, $data);
        $form->handleRequest($request);
        $annonces = $annoncesRepository->findSearch($data);
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        return $this->render('annonces/purchase.html.twig', [
            'allAnnonces' => $allAnnonces,
            'form' => $form->createView(),
            'annonces' => $annonces,
            'page' => $page
        ]);
    }


    #[Route('/depot-annonce', name: 'app_depot-annonce')]
    public function depotAnnonce(Request $request, EntityManagerInterface $entityManager, UploadFile $uploadFile, AnnoncesRepository $annoncesRepository): Response
    {

        $annonces = new Annonces();
        // Création du formulaire
        $form = $this->createForm(AnnoncesType::class, $annonces);
        
        // Traitement de la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $annonces->setImage($uploadFile->moveFile($image));

            $annonces->setCreatedAt(new \DateTimeImmutable('Europe/Paris'));
            $annoncesRepository->save($annonces, true);

            $data = $form->getData();

            // Récupération de la valeur de l'élément cible
            $targetValue = $data->getAgency();

            // Génération du slug à partir de la valeur de l'élément cible
            $slugify = new Slugify();
            $slug = $slugify->slugify($targetValue);

            $data->setSlug($slug);

            $entityManager->persist($annonces);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('annonces/depot-annonce.html.twig', [
            'annonceForm' => $form->createView(),
        ]);
    }

    public function getSlug($text)
    {
        $slugify = new Slugify();
        return $slugify->slugify($text);
    }
}
?>
