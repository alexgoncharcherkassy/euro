<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("team1Id", EntityType::class, [
                'label' => 'Team #1',
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("goals1", TextType::class, [
                'label' => 'Enter goals team #1',
                'attr' => ['class' => 'form-control']
            ])
            ->add("team2Id", EntityType::class, [
                'label' => 'Team #2',
                'class' => 'AppBundle\Entity\Team',
                'property' => 'country',
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add("goals2", TextType::class, [
                'label' => 'Enter goals team #2',
                'attr' => ['class' => 'form-control']
            ])
            ->add("dateGame", BirthdayType::class, [
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
