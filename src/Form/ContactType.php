<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prenom *'
                ]
            ])
            ->add('lastname',TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom *'
                ]
            ])
            ->add('subject',TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sujet *'
                ]
            ])
            ->add('email',EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Adresse mail *'
                ]
            ])
            ->add('message',TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre message *',
                ],
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
