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
        $max = 5;
        $currentDate = new \DateTime('now');

        $examens = $this->repo->findBy(array("date" => "date"), array("date" => "DESC"), 5);

        return $this->render('accueil/index.html.twig', [ "examens" => $examens ]);
    }
}
