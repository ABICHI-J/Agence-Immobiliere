<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Annonces;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\BigIntType;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $annonces = [];
        
        $contacts = [];
        $users= [];
        new BigIntType();
        $faker = Faker\Factory::create();
        $slugify = new Slugify();

        
        for($i=0; $i<15; $i++){
            $annonce = new Annonces();
            
            $annonce->setTitle($faker->streetName());
            $annonce->setDescription($faker->text(40));
            $annonce->setImage($faker->imageUrl(360, 360, 'animals', true, 'cats'));
            $annonce->setSurface($faker->randomNumber(3, true). ' m2');
            $annonce->setPrice($faker->randomNumber(6, true));
            $annonce->setAddress($faker->address());
            $annonce->setSlug($slugify->slugify($annonce->getTitle()));
            $annonce->setCreatedAt(new \DateTimeImmutable());
            $annonce->setLatitude( bigInt());
            $annonce->setLongitude( bigInt());




            

            $manager->persist($annonce);
            $annonces[] = $annonce;
               
            $contact = new Contact();
            $contact->setFirstname($faker->firstName());
            $contact->setLastname($faker->lastName());
            $contact->setSubject($faker->text(100));
            $contact->setEmail($faker->email());
            $contact->setMessage($faker->text());


            $manager->persist($contact);

            $contacts[]= $contact; 


            $user = new User();
            $user->setFirstname($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setPhone($faker->phoneNumber());
            $user->setAddress($faker->address());
            $user->setCity($faker->city());
            $user->setZipcode($faker->postcode());
            $user->setCountry($faker->country());
            $user->setImage($faker->imageUrl(360, 360, 'persons', true));


            $user->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($user);

            $users[]= $user; 
        }
        
        $manager->flush();
    }
}
