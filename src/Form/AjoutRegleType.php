<?php

namespace App\Form;

use App\Entity\LesvgpRegle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutRegleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Regle', TextType::class, [
                'attr' =>[
                    'placeholder'=>'la Nouvelle Regle',
                ],
                'label'=>'La Regle'
            ])
            ->add('commentaire_Regle')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpRegle::class,
        ]);
    }
}
