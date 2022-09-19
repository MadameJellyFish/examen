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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
        $inscriptions = $repoInscript->findBy(['user' => $user]);

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

    #[Route('/profil/edit', name:'app_edit_profil')]
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

    #[Route('/profil/edit/password', name:'app_edit_password')]
    public function editPassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        if ($request->isMethod("POST")) {
            $user = $this->repo->findOneBy(array('id' => 1));

            if ($request->request->get('password1') == $request->request->get('password2')) {
                $user->setPassword(
                $hasher->hashPassword(
                    $user,
                    $request->request->get('password1')
                )
            );
            $em->persist($user);
            $em->flush();

                $this->addFlash('message', "Ton mot de passe à bien été mis à jour!");
                return $this->redirectToRoute('app_profil');
            } else {
                $this->addFlash('error', "Tes mots de passe ne sont pas identiques, recommence!");
            }
        }

        return $this->renderForm('profil/edit_password.html.twig');
    }

    // #[Route('/user/profil/delete')]
}
