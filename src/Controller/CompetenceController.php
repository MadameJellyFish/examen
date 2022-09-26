<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Repository\CompetenceRepository;
use App\Repository\ExamenRepository;
use App\Repository\InscriptionRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

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
    public function show($id, ExamenRepository $examRepo, CompetenceRepository $compRepo, UserRepository $useRepo, InscriptionRepository $inscriRepo,Request $request, EntityManagerInterface $entityManager): Response
    {

        $competence = $this->repo->find($id);
        $examens = $examRepo->findBy(['competence' => $competence]);

        $submit = $request->get('submit');
        
        $user = $this->getUser();
        $inscription = new Inscription;
        
        $userExamToCome = $useRepo->examenDate($inscriRepo, $user); // je recupere tous les examens pas encore passe // cote user

        $examDispo = $compRepo->examenDate($examRepo, $competence); // renvoie un tableau des examns pas encore passe vis a vis de la date d'aujourd'hui

        if (isset($submit)) {
            
            $examen_id = $request->get('examen_id');
            $examen = $examRepo->find($examen_id);
            
            // 1 verfier user nb inscription ==3 max et verfier que ca soit sur les examens pas encore passer
            // 2 verifier nb par examen <= 5 max
            // que la date sois passer ou non l'inscription à des est limité à 3
            // 3 faire une difference entre les examens passe et à venir pour que le user ne soit pas bloqué par ces anciennes isncriptions 

            if(count($userExamToCome)>= 3 || $examen->getInscriptions()->count() >=5){

                if(count($userExamToCome)>= 3){
                    $this->addFlash('erreur', 'Vous avez dépassé votre nombre d\'inscriptions');
                    return $this->redirectToRoute(('app_accueil'));

                } else if($examen->getInscriptions()->count() >=5){

                    $this->addFlash('erreur', 'L\examen est complet');
                    return $this->redirectToRoute(('app_accueil'));
                }
            }
            
            $user->getId();
            $inscription->setUser($user);
            $inscription->setExamen($examen);
            
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }
        return $this->render('/competence/show.html.twig', ['competence' => $competence, 'examens' => $examens, 'examDispo' => $examDispo]);
    }
}

// 1 correspond à l'id de l'examen

/////////// verison formulaire symfony /////////
// $form = $this->createForm(ExamenType::class);

// $form->handleRequest($request);

// $user = $this->getUser();
// $inscription = new Inscription;

// if ($form->isSubmitted() && $form->isValid()) {

//     $inscription->setUser($user)->getId();
//     $inscription->setExamen($form['Examen']->getData()); // get data recupere la valeur de l'input

    // $entityManager->persist($inscription);
    // $entityManager->flush();

//     return $this->redirectToRoute('app_profil');
// }
// return $this->render('/competence/show.html.twig', ['form' => $form->createView(), 'competence' => $competence, 'examens' => $examens]);