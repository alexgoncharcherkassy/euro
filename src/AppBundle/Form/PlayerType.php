<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("team", "entity", [
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("firstName", 'text', [
                'label' => 'Enter first name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("lastName", 'text', [
                'label' => 'Enter last name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("birthDay", 'birthday', [
                'label' => 'Enter birth day',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'form-control']

            ])
            ->add("biography", 'textarea', [
                'label' => 'Enter biography player',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 8
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Player'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_player_type';
    }
}
