<?php

namespace App\Controller\Admin;

use App\Entity\Examen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExamenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Examen::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
