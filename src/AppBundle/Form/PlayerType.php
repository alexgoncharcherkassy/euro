<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("team", EntityType::class, [
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("firstName", TextType::class, [
                'label' => 'Enter first name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("lastName", TextType::class, [
                'label' => 'Enter last name',
                'attr' => ['class' => 'form-control']
            ])
            ->add("birthDay", BirthdayType::class, [
                'label' => 'Enter birth day',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'form-control']

            ])
            ->add("biography", TextareaType::class, [
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
