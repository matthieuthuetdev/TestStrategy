<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre prénom.'),
                    new Length(min: 2, max: 100, minMessage: 'Votre prénom doit contenir au moins {{ limit }} caractères.'),
                ],
                'attr' => ['autocomplete' => 'given-name'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre nom.'),
                    new Length(min: 2, max: 100, minMessage: 'Votre nom doit contenir au moins {{ limit }} caractères.'),
                ],
                'attr' => ['autocomplete' => 'family-name'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre adresse e-mail.'),
                    new Email(message: 'Veuillez renseigner une adresse e-mail valide.'),
                ],
                'attr' => ['autocomplete' => 'email'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre mot de passe.'),
                    new Regex(pattern: '/[a-z]/', message: 'Votre mot de passe doit contenir au moins une lettre minuscule.'),
                    new Regex(pattern: '/[A-Z]/', message: 'Votre mot de passe doit contenir au moins une lettre majuscule.'),
                    new Regex(pattern: '/[0-9]/', message: 'Votre mot de passe doit contenir au moins un chiffre.'),
                    new Regex(pattern: '/[^a-zA-Z0-9\s]/', message: 'Votre mot de passe doit contenir au moins un caractère spécial.'),
                    new Length(min: 8, max: 255, minMessage: 'Votre mot de passe doit contenir au moins {{ limit }} caractères.'),
                ],
                'attr' => [
                    'autocomplete' => 'new-password',
                    'minlength' => 8,
                    'pattern' => '(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9\\s]).{8,}',
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez confirmer votre mot de passe.'),
                ],
                'attr' => ['autocomplete' => 'new-password'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_token_id' => 'sign_up',
            'csrf_field_name' => '_token',
        ]);
    }
}
