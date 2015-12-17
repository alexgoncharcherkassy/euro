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
            ->add("firstName", 'text', [
                'label' => 'Enter first name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("lastName", 'text', [
                'label' => 'Enter last name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("birthDay", 'date', [
                'label' => 'Enter birth day',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'placeholder' => '30.12.2000',
                'attr' => ['class' => 'form-control']

            ])
            ->add("biography", 'textarea', [
                'label' => 'Enter biography player',
                'attr' => ['class' => 'form-control']
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
