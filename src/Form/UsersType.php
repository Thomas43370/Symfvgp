<?php

namespace App\Form;

use App\Entity\LesvgpUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'=>'Votre identifiant'
            ])
            ->add('email', EmailType::class, [
                'label'=>'votre email',
                'attr'=>[
                    'placeholder'=>'une adresse mail valide'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label'=>'votre mot de passe',
            ])
            ->add('confirm_password', PasswordType::class, [
                'label'=>'Confirmez votre mot de passe',
            ])
            ->add('roles', HiddenType::class, [
                'data'=>'"ROLE_USER"'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LesvgpUsers::class,
        ]);
    }
}
