<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use Faker;
use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $annonces = [];
        
        $contacts = [];
        $users= [];
        $faker = Faker\Factory::create();
        
        for($i=0; $i<15; $i++){
            $annonce = new Annonces();
            
            $annonce->setTitle($faker->streetName() .$i);
            $annonce->setDescription($faker->text() .$i);
            $annonce->setImage($faker->image() .$i. 'jpg');
            $annonce->setSlug($faker->slug() .$i);
            $annonce->setCreatedAt(new \DateTimeImmutable());


            

            $manager->persist($annonce);
            $annonces[] = $annonce;
               
            $contact = new Contact();
            $contact->setFirstname($faker->firstName() . $i);
            $contact->setLastname($faker->lastName());
            $contact->setSubject($faker->text() .$i. 'jpg');
            $contact->setEmail($faker->email());
            $contact->setMessage($faker->text());


            $manager->persist($contact);

            $contacts[]= $contact; 


            $user = new User();
            $user->setFirstname($faker->firstName() . $i);
            $user->setLastName($faker->lastName() . $i);
            $user->setEmail($faker->email().$i);
            $user->setPassword($faker->password().$i);
            $user->setPhone($faker->phoneNumber().$i);
            $user->setAddress($faker->address().$i);
            $user->setCity($faker->city().$i);
            $user->setZipcode($faker->postcode().$i);
            $user->setCountry($faker->country().$i);

            $user->setCreatedAt(new \DateTimeImmutable());








            $manager->persist($user);

            $users[]= $user; 

           
        }
           

        
        $manager->flush();
    }
}
