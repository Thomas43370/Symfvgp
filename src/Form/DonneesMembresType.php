<?php

namespace App\Form;

use App\Entity\LesvgpDonneesMembres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesMembresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Societe', TextType::class)
            ->add('Adresse', TextType::class)
            ->add('Code_Postal', TextType::class)
            ->add('Ville', TextType::class)
            ->add('email', TextType::class)
            ->add('Siret', TextType::class)
            ->add('Logo', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpDonneesMembres::class,
        ]);
    }
}
