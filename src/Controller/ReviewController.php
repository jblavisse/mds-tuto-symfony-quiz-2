<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use App\Entity\Review;


class ReviewController extends AbstractController
{
    #[Route('/reviews', name: 'app_review')]
    public function index(): Response
    {
        return $this->render('review/index.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
    }

    #[Route('/reviews/new', name: 'app_review_add')]
    public function add(): Response
    {
        $review = new Review();

        $form = $this->createFormBuilder($review)
        ->add('pseudo',TextType::class)
        ->add('content',TextareaType::class)
        ->getForm();

        return $this->render('review/new.html.twig', [
            'form' => $form
        ]);
    }
}
