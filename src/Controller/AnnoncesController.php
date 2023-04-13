<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use Cocur\Slugify\Slugify;
use App\Services\UploadFile;
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
        $surface = $request->query->get('surface');
        $price = $request->query->get('prix');
        $sort = $request->query->get('sort');
        $order = $request->query->get('order');

        // $em = $this->getEntityManager();
        // $moins5k = $em->createQuery('SELECT * FROM Annonces WHERE price < 5000');
        // $annonces = $moins5k->getResult();
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
    public function purchase(Request $request, AnnoncesRepository $annoncesRepository, EntityManagerInterface $entityManager)
    {
        $annonces = $annoncesRepository->findAll();
        $prices = [];
        foreach ($annonces as $annonce) {
            $prices[] = $annonce->getPrice();
        }
        $form = $this->createFormBuilder()
        ->add('prices', ChoiceType::class, [
            'choices' => [
                'Prix croissant' => 'asc',
                'Prix décroissant' => 'desc',
            ],
            'label' => 'Trier par prix : ',
            'required' => true,
        ])
            ->getForm();
        dd($form);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();
            $sortOrder = $data['prices'];

            $annonces = $annoncesRepository->findBy([], [
                'prices' => $sortOrder == 'asc' ? 'ASC' : 'DESC',
            ]);
        }

        return $this->render('annonces/purchase.html.twig', [
            'form' => $form->createView(),
            'annonces' => $annonces,
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
