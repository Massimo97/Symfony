<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ],
                'label' => false,
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de famille',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ],
                'label' => false,
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ],
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-19/20'
                ],
                'label' => false,
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ],
                'label' => false,
            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Password',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
            ])
            ->add('passwordConf', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Confirm Password',
                    'class' => 'nm-inset-green-50 rounded-full py-2 px-4 w-9/20'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'attr' => [
                    'class' => 'inline-block align-middle',
                    'id' => 'agreeTerms'
                ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'nm-convex-green-400-sm rounded-full py-2 px-4 w-9/20 font-extrabold'
                ],
                'label' => 'S\'insrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
