<?php

namespace App\Form;

use App\Entity\LesvgpVgp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AjoutPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ImagePhoto', FileType::class, [
            'label'=>false,
            'multiple'=>false,
            'mapped'=>false,
            'required'=>false
        ])
        ->add('texteimg', TextType::class, [
            'label'=>'Le Texte en haut de la premiere page'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpVgp::class,
        ]);
    }
}
