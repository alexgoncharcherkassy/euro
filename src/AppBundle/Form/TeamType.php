<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("country", 'text', [
                'label' => 'Enter team',
                'attr' => ['class' => 'form-control']
            ])
            ->add("groups", 'text', [
                'label' => 'Enter group',
                'attr' => ['class' => 'form-control']
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Team'
        ]);

    }

    public function getName()
    {
        return 'app_bundle_team_type';
    }
}
