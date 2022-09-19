<?php

namespace App\Controller;

use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        // return $this->render('inscription/index.html.twig', [
        //     'controller_name' => 'InscriptionController',
        // ]);

        $form = $this->createForm(InscriptionType::class);
        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
