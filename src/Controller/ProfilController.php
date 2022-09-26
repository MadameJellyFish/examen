<?php

namespace App\Controller;

use App\Form\EditUtilisateurType;
use App\Repository\InscriptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(InscriptionRepository $repoInscript, Request $request): Response
    {
        $user = $this->getUser();
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

        usort($examToCome, function ($a, $b) {
            return strtotime($a->getDate()->format('d-m-Y')) - strtotime($b->getDate()->format('d-m-Y'));
        });

        usort($examPassed, function ($a, $b) {
            return strtotime($b->getDate()->format('d-m-Y')) - strtotime($a->getDate()->format('d-m-Y'));
        });

        $form = $this->createForm(EditUtilisateurType::class, $user, ['attr' => ['class' => 'formModif']]);
        $form->handleRequest($request);

        return $this->renderForm('profil/profil.html.twig', ['user' => $user,'form' => $form, "examToCome" => $examToCome, "examPassed" => $examPassed]);
    }

    #[Route('/profil/edit', name:'app_edit_profil')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $request->toArray();

        $date = (new DateTime())->setDate($form["date_year"], $form["date_month"], $form["date_day"]);
        $user->setNom($form["nom"])->setPrenom($form['prenom'])->setDate($date)->setTelephone($form["telephone"]);
        $em->flush();

        $user = $this->getUser();

        $info = [
                "email" => $user->getEmail(),
                "nom" => $user->getNom(),
                "prenom" => $user->getPrenom(),
                "date" => $user->getDate(),
                "telephone" => $user->getTelephone()
            ];

        return $this->json($info); 
    }

    #[Route('/profil/edit/password', name:'app_edit_password')]
    public function editPassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        if ($request->isMethod("POST")) {
            // $user = $this->repo->findOneBy(array('id' => 1));
            $user = $this->getUser();

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

    #[Route('/profil/delete', name:'app_delete')]
    public function delete(EntityManagerInterface $em): Response
    {
        $user = $this->getUser()->setOnline(false);
        $em->flush();

        return $this->redirectToRoute('app_logout');
    }

    #[Route('/profil/historique/{id}', name:'app_historique')]
    public function historique(InscriptionRepository $repoInscript, PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();
        $user->getId();
        $inscriptions = $repoInscript->findBy(['user' => $user]);
        $examens = [];

        foreach ($inscriptions as $inscription) {
            $examen = $inscription->getExamen();

            array_push($examens, $examen);
        }

        usort($examens, function ($a, $b) {
            return strtotime($b->getDate()->format('d-m-Y')) - strtotime($a->getDate()->format('d-m-Y'));
        });

        $examPage = $paginator->paginate($examens, $request->query->getInt('page', 1), 1);

        return $this->render('profil/historique.html.twig', ["examens" => $examPage]);
    }
}
