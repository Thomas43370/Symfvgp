<?php

namespace App\Form;

use App\Entity\LesvgpMarque;
use App\Entity\LesvgpModele;
use App\Entity\LesvgpEnergie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Modele')
            ->add('commentaire_Modele')
            ->add('Marque', EntityType::class, [
                'class'=>LesvgpMarque::class,
                'choice_label'=>'Marque'
            ])
            ->add('Energie', EntityType::class, [
                'class'=>LesvgpEnergie::class,
                'choice_label'=>'Energie'
            ])
            ->add('Valide', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpModele::class,
        ]);
    }
}
