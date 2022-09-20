<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\ExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetenceController extends AbstractController
{

    private CompetenceRepository $repo;

    public function __construct(CompetenceRepository $repo)
    {
        $this->repo = $repo;
    }

    #[Route('/competence', name: 'app_competence')]
    public function index(): Response
    {

        $competences = $this->repo->findAll();
        return $this->render('competence/index.html.twig', [
            'competences' => $competences
        ]);
    }

    #[Route('/competence/{id}', name: 'competence.show', methods: ['GET', 'POST'])]
    public function show($id, ExamenRepository $examRepo): Response
    {

        $competence = $this->repo->find($id);
        $form = $this->createForm(CompetenceType::class);
        
        $examens = $examRepo->findBy(['competence' => $competence]);
        // $examens->getInscriptions();
        dd($examens);

        return $this->render('/competence/show.html.twig', ['form' => $form->createView(), 'competence' => $competence, 'examens'=> $examens]);
    }
}
