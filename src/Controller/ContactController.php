<?php

namespace App\Controller;

use App\Entity\Contact;
/* use App\Repository\ContactRepository; */
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $submit = $request->get('submit');
        $errors = [];

        $nom = trim($request->get('nom'));
        if (empty($nom)) {
            [($errors['nom'] = 'Le nom est obligatoire *')];
        }

        $email = trim($request->get('email'));
        if (empty($email)) {
            [($errors['email'] = 'L\'email est obligatoire *')];
        }

        $message = trim($request->get('message'));
        if (empty($message)) {
            [($errors['message'] = 'Le message est obligatoire *')];
        }

        $datas = ['nom' => $nom, 'email' => $email, 'message' => $message];

        if (!isset($submit)) {
            return $this->render('contact/index.html.twig', ['data' => $datas]);
        }
        
        if (empty($errors)) {
            $this->addFlash('success', 'Message bien envoyé !');
            return $this->redirect('/contact');
        } else {
            return $this->renderForm('/contact/index.html.twig', [
                'errors' => $errors,
                'data' => $datas,
            ]);
        }

        return $this->render('contact/index.html.twig');
    }
}
