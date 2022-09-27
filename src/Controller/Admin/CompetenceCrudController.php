<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competence::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle(Crud::PAGE_INDEX, 'Liste des compétences')
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une compétence')
        ->setPageTitle(Crud::PAGE_NEW, 'Créer une compétence')
        ->setPageTitle(Crud::PAGE_DETAIL, 'Consulter une compétence');
    }

    public function configureActions(Actions $actions): Actions{
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa-solid fa-plus pe-1')->setLabel('Ajouter compétence');
        })
        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fas fa-trash text-danger')->setLabel('Supprimer compétence');
        })
        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fas fa-edit text-warning')->setLabel('Editer compétence');
        })
        ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
            return $action->setIcon('fas fa-eye text-info')->setLabel('Consulter compétence');
        })
        ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
            return $action->setLabel('Supprimer compétence');
        })
        ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
            return $action->setIcon('fas fa-edit text-light')->setLabel('Editer compétence');
        })
        ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
            return $action->setIcon('fa-solid fa-arrow-left text-light')->setLabel('Retour');
        })
        ->reorder(Crud::PAGE_DETAIL, [Action::INDEX, Action::EDIT, Action::DELETE]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                        ->hideOnForm()
                        ->hideOnDetail()
                        ->hideOnIndex(),
            TextField::new('nom'),
            TextareaField::new('description'),
        ];
    }
}
