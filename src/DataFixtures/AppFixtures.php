<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

use App\Entity\Category;
use App\Entity\Quiz;

class AppFixtures extends Fixture
{
    public function randomHex() {
        $chars = 'ABCDEF0123456789';
        $color = '#';
        for ( $i = 0; $i < 6; $i++ ) {
          $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create("fr_FR");

        for($i=1; $i<=15;$i++) {
            // 1. Générer une nouvelle instance de l'entité
            $category = new Category();

            // 1bis. Préciser des valeurs pour les propriétés de votre
            // futur enregistrement
            $category->setTitle($faker->sentence());
            $category->setDescription("Description de la catégorie numéro ".$i);
            $category->setColor($this->randomHex());

            // 2. Prendre en compte votre futur enregistrement
            // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)

            $manager->persist($category);
            $this->addReference('category_'.$i, $category);
            }


        for($i=1; $i<=30;$i++) {
            $quiz = new Quiz();
            $currentCategory = $this->getReference('category_'.mt_rand(1,15));
            $quiz->setCategory($currentCategory);
            $quiz->setTitle("Quiz numéro ".$i);
            $manager->persist($quiz);
        }


        // 3. Exécution d'une requête SQL (INSERT INTO)
        $manager->flush();

    }

}
