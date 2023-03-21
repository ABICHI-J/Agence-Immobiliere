<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',EmailType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Email'
            ]
        ])
        ->add('firstname',TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Prenom'
            ]
        ])
        ->add('lastname',TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Nom'
            ] 
        ])
        ->add('phone',TelType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Telephone'
            ] 
        ])
        ->add('address',TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Adresse'
            ] 
        ])
        ->add('city',TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'City'
            ] 
        ])
        ->add('zipcode',TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Code Postal'
            ] 
        ])
        ->add('country',CountryType::class, [
            'label' => false,
            "preferred_choices" => ['FR']
        ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
