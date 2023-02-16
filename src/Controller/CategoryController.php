<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;


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

    #[Route('/categories/{id}', name: 'category_details', requirements: ['id' => '\d+'])]
    public function single(ManagerRegistry $doctrine,int $id): Response
    {
        $categoryRepository = $doctrine->getRepository(Category::class);
        $category =  $categoryRepository->find($id);

        return $this->render('category/details.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category
        ]);
    }


    #[Route('/categories/new', name: 'category_new')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {

        $category = new Category();
        $category->setTitle('Ma nouvelle catégorie');
        $category->setColor('#888888');


        $form = $this->createFormBuilder($category)
        ->add('title',TextType::class)
        ->add('description', TextareaType::class)
        ->add('color', ColorType::class)
        ->add('Enregistrer', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();

        }

        return $this->render('category/new.html.twig', [
            'form' => $form
        ]);
    }

}
