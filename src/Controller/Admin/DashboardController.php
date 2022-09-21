<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use App\Entity\Examen;
use App\Entity\Inscription;
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
    // #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($url->setController(CompetenceCrudController::class)->generateUrl());

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
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
        yield MenuItem::subMenu('Compétences', 'fas fa-list', Competence::class);
        yield MenuItem::subMenu('Examen', 'fa fa-tags')->setSubItems([
                MenuItem::linkToCrud('All Examens', 'fa fa-file-text', Examen::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Add Examen', 'fas fa-plus', Examen::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Inscription', 'fas fa-list', Inscription::class);
    }
}
