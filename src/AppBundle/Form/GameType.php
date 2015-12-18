<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("team1Id", "entity", [
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("goals1", 'text', [
                'label' => 'Enter goals team #1',
                'attr' => ['class' => 'form-control']
            ])
            ->add("team2Id", "entity", [
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("goals2", 'text', [
                'label' => 'Enter goals team #2',
                'attr' => ['class' => 'form-control']
            ])
            ->add("dateGame", 'birthday', [
                'label' => 'Enter day of game',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'form-control']

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Game'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_game_type';
    }
}
