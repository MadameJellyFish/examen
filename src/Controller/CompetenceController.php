<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\ExamenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show($id, ExamenRepository $examRepo, Request $request, EntityManagerInterface $entityManager): Response
    {

        $competence = $this->repo->find($id);
        $examens = $examRepo->findBy(['competence' => $competence]);

        $form = $this->createForm(CompetenceType::class);
        $form->handleRequest($request);
    
        $user = $this->getUser();
        $inscription = new Inscription;

        if ($form->isSubmitted() && $form->isValid()) {

            $inscription->setUser($user)->getId();
            $inscription->setExamen($form['Examen']->getData()); // get data recupere la valeur de l'input

            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }
        return $this->render('/competence/show.html.twig', ['form' => $form->createView(), 'competence' => $competence, 'examens' => $examens]);
    }
}
