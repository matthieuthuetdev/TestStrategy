<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/dashboard/account', name: 'account')]
    public function account(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('password')->getData();

            if ($newPassword !== null && $newPassword !== '') {
                if ($currentPassword === null || $currentPassword === '') {
                    $form->get('currentPassword')->addError(new FormError('L’ancien mot de passe est obligatoire pour le modifier.'));
                } elseif (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $form->get('currentPassword')->addError(new FormError('L’ancien mot de passe est incorrect.'));
                } else {
                    $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
                }
            }

            if (count($form->getErrors(true)) === 0) {
                $user->setUpdatedAt(new \DateTimeImmutable());
                $entityManager->flush();
                $this->addFlash('success', 'Les informations de votre compte ont été mises à jour.');

                return $this->redirectToRoute('account');
            }
        }

        return $this->render('dashboard/account.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
