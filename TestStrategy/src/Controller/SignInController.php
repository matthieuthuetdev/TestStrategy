<?php

namespace App\Controller;

use App\Form\SignInType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;

class SignInController extends AbstractController
{
    #[Route('/sign-in', name: 'sign_in', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        AuthenticationUtils $authenticationUtils,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        Security $security,
    ): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(SignInType::class, [
            'email' => $lastUsername,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $password = $form->get('password')->getData();
            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
                $form->addError(new FormError('L’adresse e-mail ou le mot de passe est incorrect.'));
            } else {
                return $security->login($user, 'form_login') ?? $this->redirectToRoute('dashboard');
            }
        }

        return $this->render('sign_in/index.html.twig', [
            'form' => $form,
        ]);
    }
}
