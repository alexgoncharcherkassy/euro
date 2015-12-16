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
            ])
            ->add("groups", 'text', [
                'label' => 'Enter group',
            ])
            ->add('Save', 'submit');

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
