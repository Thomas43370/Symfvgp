<?php

namespace App\Form;

use App\Entity\LesvgpRegle;
use App\Entity\LesvgpTitre;
use App\Entity\LesvgpQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdminAjQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Question', TextType::class, [
                'required' => true
            ])
            ->add('Verif', TextType::class, [
                'required' => true
            ])
            ->add('Titre', EntityType::class, [
                    'class'=> LesvgpTitre::class,
                    'choice_label' => 'Titre',
                    'required' => true
            ])
            ->add('Regle', EntityType::class, [
                'class'=> LesvgpRegle::class,
                'choice_label' => 'Regle',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpQuestion::class,
        ]);
    }
}
