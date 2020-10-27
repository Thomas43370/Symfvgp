<?php

namespace App\Form;

use App\Entity\LesvgpRegle;
use App\Entity\LesvgpCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AjoutCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Categorie', TextType::class, [
                'required'=>true
            ])
            ->add('commentaire_Categorie', TextType::class)
            ->add('Regle', EntityType::class, [
                    'class' => LesvgpRegle::class,
                    'choice_label' => 'Regle',
                    'required' => true

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpCategorie::class,
        ]);
    }
}
