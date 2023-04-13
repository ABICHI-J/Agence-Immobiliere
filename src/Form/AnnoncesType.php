<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnoncesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('agency', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'Appartement',
                    'Maison' => 'Maison',
                    'Parking' => 'Parking',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'flex-ai-c',
                ],
                'label' => false,
            ])
            ->add('surface', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('rooms', ChoiceType::class, [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Combien y a-t-il de pièces ?',
            ])
            ->add('bedrooms', ChoiceType::class, [
                'choices' => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Combien y a-t-il de chambres ?',
            ])
            ->add('furnished', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'yes',
                    'Non' => 'no',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'flex-ai-c',
                ],
                'label' => false,
            ])
            ->add('floor', ChoiceType::class, [
                'choices' => [
                    'rdc' => 'rdc',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('balcony', ChoiceType::class, [
                'choices' => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'balcon',
            ])
            ->add('patio', ChoiceType::class, [
                'choices' => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'terrase',
            ])
            ->add('lift', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'yes',
                    'Non' => 'no',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'flex-ai-c',
                ],
                'label' => false,
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('guarantee', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'id' => 'textarea',
                    'placeholder' => 'Votre description *',
                ],
                'label' => false,
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'label' => false,
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => false,
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Votre prénom ou pseudo à afficher sur l\'annonce :',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Mélina, Mélina Duquin, MelinaD, etc...',
                ],
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Votre numéro de téléphone :',
            ])
            ->add('slug', HiddenType::class, [
                'mapped' => false, // indique que ce champ ne doit pas être mappé sur une propriété de l'objet formulaire
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
