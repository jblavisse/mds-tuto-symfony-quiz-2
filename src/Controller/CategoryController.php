<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Category;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_category')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categoryRepository = $doctrine->getRepository(Category::class);
        $categories =  $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }
}
