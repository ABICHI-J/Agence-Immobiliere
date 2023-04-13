<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Annonces;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $annonces = [];
        $users= [];
        $faker = Faker\Factory::create();
        $slugify = new Slugify();

        
        for($i=0; $i<25; $i++){
            $annonce = new Annonces();
            
            $annonce->setAgency($faker->word());
            $annonce->setType($faker->word());
            $annonce->setSurface($faker->randomNumber(3, true));            
            $annonce->setRooms($faker->randomNumber(1, true));
            $annonce->setBedrooms($faker->randomNumber(1, true));
            $annonce->setFurnished($faker->boolean());
            $annonce->setFloor($faker->randomNumber(1, true));
            $annonce->setBalcony($faker->randomNumber(1, true));
            $annonce->setPatio($faker->randomNumber(1, true));
            $annonce->setLift($faker->boolean());
            $annonce->setPrice($faker->randomNumber(3, true));
            $annonce->setGuarantee($faker->randomNumber(2, true));
            $annonce->setDescription($faker->text('300'));
            $annonce->setImage($faker->imageUrl(360, 360, 'annonces', true));
            $annonce->setAddress($faker->address());
            $annonce->setNickname($faker->word());            
            $annonce->setPhone($faker->phoneNumber());
            $annonce->setSlug($slugify->slugify($annonce->getAgency()));
            $annonce->setCreatedAt(new \DateTimeImmutable());
            $annonce->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($annonce);
            $annonces[] = $annonce;



            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setFirstname($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setImage($faker->imageUrl(360, 360, 'users', true));
            $user->setPhone($faker->phoneNumber());
            $user->setAddress($faker->address());
            $user->setCity($faker->city());
            $user->setZipcode($faker->postcode());
            $user->setCountry($faker->country());
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($user);

            $users[]= $user; 
        }
        
        $manager->flush();
    }
}
