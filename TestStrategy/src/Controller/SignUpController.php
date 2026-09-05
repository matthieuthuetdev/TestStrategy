<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'sign_up', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
    ): Response {
        $form = $this->createForm(SignUpType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $password = $form->get('password')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            if ($userRepository->findOneBy(['email' => $email])) {
                $form->addError(new FormError('Cette adresse e-mail est déjà utilisée.'));
            } elseif ($password !== $confirmPassword) {
                $form->addError(new FormError('Les deux mots de passe doivent être identiques.'));
            } else {
                $user = new User();
                $user->setFirstName($form->get('firstName')->getData());
                $user->setLastName($form->get('lastName')->getData());
                $user->setEmail($email);
                $user->setPassword($passwordHasher->hashPassword($user, $password));

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Votre compte a été créé. Vous pouvez maintenant vous connecter.');

                return $this->redirectToRoute('sign_in');
            }
        }

        return $this->render('sign_up/index.html.twig', [
            'form' => $form,
        ]);
    }
}
