<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Générer une nouvelle instance de l'entité
        $category = new Category();

        // 1bis. Préciser des valeurs pour les propriétés de votre
        // futur enregistrement
        $category->setTitle("Dinosaures");
        $category->setDescription("Tout savoir sur ces fabuleux reptiles");


        // 2. Prendre en compte votre futur enregistrement
        // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)
        $manager->persist($category);

        // 3. Exécution d'une requête SQL (INSERT INTO)
        $manager->flush();
    }
}
