<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Galerie;
use Doctrine\Persistence\ObjectManager;
Use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
       $this->encoder = $encoder; 
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        $createdAt = $faker->dateTimeBetween('-6 months', 'now');
        $createdAtImmutable = \DateTimeImmutable::createFromMutable($createdAt);
        // Utilistation de faker

        // Création d'un utilisateurs
        $user = new User();

        $user->setEmail('user@test.com')
             ->setPrenom($faker->firstName())
             ->setNom($faker->lastName())
             ->setTelephone($faker->phoneNumber())
             ->setAPropos($faker->text())
             ->setInstagram('instagram')
             ->setPicture('picture');

        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        // création de 10 blog post
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new Blogpost();

            

            $blogpost->setTitre($faker->words(3, true))
                     ->setCreatedAt($createdAtImmutable)
                     ->setContenu($faker->text(350))
                     ->setSlug($faker->slug(3))
                     ->setAuthor($user);

            $manager->persist($blogpost);
        }

        // création de 5 catégories
        for ($k=0; $k < 5; $k++) {

            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                      ->setDescription($faker->words(10, true))
                      ->setSlug($faker->slug());

            $manager->persist($categorie);          
            
            // creation de 5 catégories
            for ($j=0; $j < 2; $j++) { 
                $galerie = new Galerie();
                
                $galerie->setNom($faker->words(3, true))
                ->setLargeur($faker->randomFloat(2, 20, 60))
                ->setHauteur($faker->randomFloat(2, 20, 60))
                ->setEnVente($faker->randomElement([true, false]))
                ->setDatRealisation($createdAtImmutable)
                ->setCreatedAt($createdAtImmutable)
                ->setDescription($faker->text())
                ->setPortfolio($faker->randomElement([true, false]))
                ->setSlug($faker->slug())
                ->setFile('/images/image.jpg')
                ->addCategorie($categorie)
                ->setPrix($faker->randomFloat(2, 100, 9999))
                ->setAuthor($user);
                
                $manager->persist($galerie);
                
                
            }
        }

        $manager->flush();
    }
}
