<?php

namespace App\Controller;

use App\Repository\ExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private ExamenRepository $repo;
    public function __construct(ExamenRepository $repo)
    {
        $this->repo = $repo;
    }

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $examens = $this->repo->findBy(array(), array("date" => "DESC"), 5);
        // dd($examens);
        return $this->render('accueil/index.html.twig', [ "examens" => $examens ]);
    }
}
