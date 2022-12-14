<?php

namespace App\Controller;

use App\Repository\ExamenRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

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
        $user = $this->getUser();

        $examen = $this->repo->findBy(array(), array("date" => "DESC"), 5);

        if ($user) {
            $cookie = new Cookie("Cookie Test", $user->getEmail(), strtotime('tomorrow'), '/');
            $res = new Response();
            $res->headers->setCookie($cookie);
            $res->send();
        }

        // dd($res);

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

        return $this->render('accueil/index.html.twig', [ "examens" => $examens]);
    }

    #[Route('/mentions-legales', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('accueil/cgu.html.twig');
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('accueil/faq.html.twig');
    }

    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpd(): Response
    {
        return $this->render('accueil/rgpd.html.twig');
    }
}
