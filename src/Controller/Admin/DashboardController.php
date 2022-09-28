<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use App\Entity\Examen;
use App\Entity\Inscription;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->container->get(AdminUrlGenerator::class);
        
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirect($url->setController(UserCrudController::class)->generateUrl());
        } else {
            return $this->redirectToRoute('app_accueil');
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Centre d'Examen");
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fa-solid fa-arrow-left', 'app_accueil');
        yield MenuItem::section('Compétences et examens', 'fas fa-list');
        yield MenuItem::subMenu('Compétences', 'fa fa-tags')->setSubItems([
                MenuItem::linkToCrud('Toutes les Compétences', 'fa fa-file-text', Competence::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter une Compétence', 'fas fa-plus', Competence::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Examen', 'fa-solid fa-folder-open')->setSubItems([
                MenuItem::linkToCrud('Tous les Examens', 'fa fa-file-text', Examen::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter un Examen', 'fas fa-plus', Examen::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Inscription', 'fa-solid fa-stamp')->setSubItems([
                MenuItem::linkToCrud('Toutes les inscriptions', 'fa fa-file-text', Inscription::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter une inscription', 'fas fa-plus', Inscription::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::section('Apprenants', 'fas fa-list');
        yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-user')->setSubItems([
                MenuItem::linkToCrud('Tous les Utilisateurs', 'fa fa-file-text', User::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter un Utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
