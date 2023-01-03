<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categoryRepository = $doctrine->getRepository(Category::class);
        $categories =  $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    #[Route('/categories/{id}', name: 'category_details')]
    public function single(ManagerRegistry $doctrine,int $id): Response
    {
        $categoryRepository = $doctrine->getRepository(Category::class);
        $category =  $categoryRepository->find($id);

        return $this->render('category/details.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category
        ]);
    }

}
