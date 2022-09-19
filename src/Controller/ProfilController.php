<?php

namespace App\Controller;

use App\Form\EditUtilisateurType;
use App\Repository\InscriptionRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    private UserRepository $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    #[Route('/profil', name: 'app_profil')]
    public function index(InscriptionRepository $repoInscript): Response
    {
        $user = $this->repo->findOneBy(array('id' => 1));
        $inscriptions = $repoInscript->findBy(['utilisateur' => $user]);

        $currentDate = new DateTime();
        $examToCome = [];
        $examPassed = [];
        foreach ($inscriptions as $inscription) {
            $exam = $inscription->getExamen();
            $examDate = $exam->getDate();

            if ($examDate > $currentDate) {
                array_push($examToCome, $exam);
            } else {
                array_push($examPassed, $exam);
            }
        }
        return $this->render('profil/profil.html.twig', ['user' => $user, "examToCome" => $examToCome, "examPassed" => $examPassed]);
    }

    #[Route('/profil/edit', name:'app_profil_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->repo->findOneBy(array('id' => 1));
        $form = $this->createForm(EditUtilisateurType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Ton profil a bien été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        return $this->renderForm('profil/edit.html.twig', ['form' => $form]); 
    }
}
