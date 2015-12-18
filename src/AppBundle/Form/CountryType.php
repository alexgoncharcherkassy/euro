<?php

namespace AppBundle\Form;

use AppBundle\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
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
            ->add("fullTitle", 'text', [
                'label' => 'Enter full title',
                'attr' => ['class' => 'form-control']
            ])
            ->add("description", 'textarea', [
                'label' => 'Enter description country',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 8
                ]
            ]);


       /* ->add('team', 'choice', [
                'choices' => ['id1' => 1, 'id2' => 2]
            ]);*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Country'
        ]);

    }

    public function getName()
    {
        return 'app_bundle_country_type';
    }
}
