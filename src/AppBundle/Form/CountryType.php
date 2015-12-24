<?php

namespace AppBundle\Form;

use AppBundle\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
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
            ->add("fullTitle", TextType::class, [
                'label' => 'Enter full title',
                'attr' => ['class' => 'form-control']
            ])
            ->add("description", TextareaType::class, [
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
