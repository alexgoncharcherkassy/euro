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
            ->add("fullTitle", 'text', [
                'label' => 'Enter full title',
                'attr' => ['class' => 'form-control']
            ])
            ->add("description", 'textarea', [
                'label' => 'Enter description country',
                'attr' => ['class' => 'form-control']
            ]);
            /*->add("team", "entity", [
                'class' => new Team(),
                'property' => 'id'
            ]);*/
         /* ->add('team', 'collection', [
              'type' => new TeamType(),
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
              'cascade_validation' => true
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
