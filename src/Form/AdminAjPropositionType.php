<?php

namespace App\Form;

use App\Entity\LesvgpCategorie;
use App\Entity\LesvgpProposition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminAjPropositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Proposition')
            ->add('Type', ChoiceType::class, [
                'choices'=>[
                    'du TEXTE'=>'text',
                    'OUI/NON/NC'=> 'oui',
                    'BON/MAUVAIS/NC'=> 'bon',
                ]
            ])
            ->add('categ', ChoiceType::class, [
                'choices'=>[
                    'commun'=>'commun',
                    'levage'=>'levage',
                    'equipement'=>'equipement',
                ]
            ])
            ->add('Unite_Valeur', TextType::class, [
                'required'=>false
            ])
            ->add('Equipements', HiddenType::class, [
                'data'=>null
            ])
            ->add('Categorie', EntityType::class, [
                'class'=>LesvgpCategorie::class,
                'choice_label'=>'categorie',
                'required'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpProposition::class,
        ]);
    }
}
