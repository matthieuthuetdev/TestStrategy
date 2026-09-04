<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre adresse e-mail.'),
                    new Email(message: 'Veuillez renseigner une adresse e-mail valide.'),
                ],
                'attr' => [
                    'autocomplete' => 'email',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre mot de passe.'),
                ],
                'attr' => [
                    'autocomplete' => 'current-password',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_token_id' => 'authenticate',
            'csrf_field_name' => '_token',
        ]);
    }
}
