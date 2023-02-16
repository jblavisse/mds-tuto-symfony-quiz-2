<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Category;
use App\Entity\Quiz;

class AppFixtures extends Fixture
{
    // public function randomHex() {
    //     $chars = 'ABCDEF0123456789';
    //     $color = '#';
    //     for ( $i = 0; $i < 6; $i++ ) {
    //       $color .= $chars[rand(0, strlen($chars) - 1)];
    //     }
    //     return $color;
    // }


    public function load(ObjectManager $manager): void
    {

    //     for($i=1; $i<=15;$i++) {
    //         // 1. Générer une nouvelle instance de l'entité
    //         $category = new Category();

    //         // 1bis. Préciser des valeurs pour les propriétés de votre
    //         // futur enregistrement
    //         $category->setTitle("Catégorie numéro ".$i);
    //         $category->setDescription("Description de la catégorie numéro ".$i);
    //         $category->setColor($this->randomHex());

    //         // 2. Prendre en compte votre futur enregistrement
    //         // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)

    //         $manager->persist($category);
    //         }

    //         // 3. Exécution d'une requête SQL (INSERT INTO)
    //         $manager->flush();

        $category = new Category();
        $category->setTitle("Titre de ma catégorie");
        $manager->persist($category);
        $this->addReference('maCategoriequitue', $category);

        $quiz = new Quiz();
        $newCategory = $this->getReference('maCategoriequitue');
        $quiz->setCategory($newCategory);
        $quiz->setTitle("Mon quiz qui tache");
        $manager->persist($quiz);
        $manager->flush();
    }

}
