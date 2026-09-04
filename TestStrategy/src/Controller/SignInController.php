<?php

namespace App\Controller;

use App\Form\SignInType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInController extends AbstractController
{
    #[Route('/sign-in', name: 'sign_in', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm(SignInType::class, [
            'email' => $lastUsername,
        ]);

        return $this->render('sign_in/index.html.twig', [
            'form' => $form,
            'error' => $error,
        ]);
    }
}
