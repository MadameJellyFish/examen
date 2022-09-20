<?php

namespace App\Controller;

use App\Repository\ExamenRepository;
use DateTime;
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
        $examen = $this->repo->findBy(array(), array("date" => "DESC"), 5);

        $currentDate = new DateTime();
        $examens = [];
        $examPassed = [];
        foreach ($examen as $exam) {
            $examDate = $exam->getDate();

            if ($examDate > $currentDate) {
                array_push($examens, $exam);
            } else {
                array_push($examPassed, $exam);
            }
        }

        return $this->render('accueil/index.html.twig', [ "examens" => $examens ]);
    }
}
