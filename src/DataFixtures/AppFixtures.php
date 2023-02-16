<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\Category;
use App\Entity\Quiz;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function loadAdmin(ObjectManager $manager) {
        $admin = new User();
        $admin->setEmail('jb@jb.fr');
        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword(
          $this->userPasswordHasherInterface->hashPassword(
            $admin, 'root1234'
          )
        );

        $manager->persist($admin);
        $manager->flush();
    }

    public function loadCategories(ObjectManager $manager, $faker) {
        for($i=1; $i<=15;$i++) {
            // 1. Générer une nouvelle instance de l'entité
            $category = new Category();

            // 1bis. Préciser des valeurs pour les propriétés de votre
            // futur enregistrement
            $category->setTitle($faker->sentence());
            $category->setDescription($faker->paragraph());
            $category->setColor($faker->hexColor());

            // 2. Prendre en compte votre futur enregistrement
            // Pour un potentiel ajout dans la BDD (PAS DE SQL FAIT)

            $manager->persist($category);
            $this->addReference('category_'.$i, $category);
        }
        $manager->flush();
    }

    public function loadQuizzes(ObjectManager $manager, $faker) {

        for($i=1; $i<=30;$i++) {
            $quiz = new Quiz();
            $currentCategory = $this->getReference('category_'.mt_rand(1,15));
            $quiz->setCategory($currentCategory);
            $quiz->setTitle($faker->sentence());
            $quiz->setImg($faker->image('public/uploads/img/', 640, 480, '', false));
            $manager->persist($quiz);
        }
        $manager->flush();
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create("fr_FR");

        $this->loadCategories($manager,$faker);
        $this->loadQuizzes($manager,$faker);
        $this->loadAdmin($manager);
    }

}
