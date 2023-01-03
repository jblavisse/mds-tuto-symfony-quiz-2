<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Quiz;
use Doctrine\Persistence\ManagerRegistry;


class QuizController extends AbstractController
{
    #[Route('/quizzes/{id}', name: 'app_quiz')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $quizRepository = $doctrine->getRepository(Quiz::class);
        $quiz = $quizRepository->find($id);

        return $this->render('quiz/details.html.twig', [
            'quiz' => $quiz
        ]);
    }
}
