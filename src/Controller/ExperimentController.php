<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperimentController extends AbstractController
{
    #[Route('/experiment', name: 'app_experiment')]
    public function index(): Response
    {
        return $this->render('accueil/experiment.html.twig', [
            'controller_name' => 'ExperimentController',
        ]);
    }
}
