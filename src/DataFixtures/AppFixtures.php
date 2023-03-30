<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Annonces;
use App\Entity\Purchase;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $annonces = [];
        $purchases = [];
        $contacts = [];
        $users= [];
        $faker = Faker\Factory::create();
        $slugify = new Slugify();

        
        for($i=0; $i<10; $i++){
            $annonce = new Annonces();
            
            $annonce->setCompany($faker->streetName());
            $annonce->setImage($faker->imageUrl(360, 360, 'animals', true, 'cats'));
            $annonce->setType($faker->streetName());
            $annonce->setRooms($faker->randomNumber(1, true));
            $annonce->setBedrooms($faker->randomNumber(1, true));
            $annonce->setFloor($faker->randomNumber(1, true));
            $annonce->setAddress($faker->address());
            $annonce->setSurface($faker->randomNumber(3, false));
            $annonce->setPrice($faker->randomNumber(4, true));
            $annonce->setAddress($faker->address());
            $annonce->setSlug($slugify->slugify($annonce->getCompany()));
            $annonce->setCreatedAt(new \DateTimeImmutable());



            $manager->persist($annonce);
            $annonces[] = $annonce;



            $purchase = new Purchase();
            
            $purchase->setCompany($faker->streetName());
            $purchase->setImage($faker->imageUrl(360, 360, 'animals', true, 'cats'));
            $purchase->setType($faker->streetName());
            $purchase->setRooms($faker->randomNumber(1, true));
            $purchase->setBedrooms($faker->randomNumber(1, true));
            $purchase->setFloor($faker->randomNumber(1, true));
            $purchase->setAddress($faker->address());
            $purchase->setSurface($faker->randomNumber(3, false));
            $purchase->setPrice($faker->randomNumber(4, true));
            $purchase->setAddress($faker->address());
            $purchase->setSlug($slugify->slugify($purchase->getCompany()));
            $purchase->setCreatedAt(new \DateTimeImmutable());



            $manager->persist($purchase);
            $purchases[] = $purchase;
               
            // $contact = new Contact();
            // $contact->setFirstname($faker->firstName());
            // $contact->setLastname($faker->lastName());
            // $contact->setSubject($faker->text(100));
            // $contact->setEmail($faker->email());
            // $contact->setMessage($faker->text());


            // $manager->persist($contact);

            // $contacts[]= $contact; 


            // $user = new User();
            // $user->setFirstname($faker->firstName());
            // $user->setLastName($faker->lastName());
            // $user->setEmail($faker->email());
            // $user->setPassword($faker->password());
            // $user->setPhone($faker->phoneNumber());
            // $user->setAddress($faker->address());
            // $user->setCity($faker->city());
            // $user->setZipcode($faker->postcode());
            // $user->setCountry($faker->country());
            // $user->setImage($faker->imageUrl(360, 360, 'persons', true));


            // $user->setCreatedAt(new \DateTimeImmutable());

            // $manager->persist($user);

            // $users[]= $user; 
        }
        
        $manager->flush();
    }
}
