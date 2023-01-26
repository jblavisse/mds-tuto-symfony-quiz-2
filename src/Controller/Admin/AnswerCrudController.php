<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class AnswerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Answer::class;
    }

    public function configureCrud(Crud $crud): Crud {
        return $crud
        ->setEntityLabelInSingular('Réponse')
        ->setEntityLabelInPlural('Réponses');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('content'),
            BooleanField::new('isCorrect'),
            AssociationField::new('question')
        ];
    }
}
