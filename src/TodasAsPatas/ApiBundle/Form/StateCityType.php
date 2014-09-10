<?php

namespace TodasAsPatas\ApiBundle\Form;

use TodasAsPatas\ApiBundle\Entity\City;
use TodasAsPatas\ApiBundle\Entity\State;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StateCityType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* @var $state State */
        $state = $builder->getData();
        
        if ($state && $state->getCities()->isEmpty()) {
            $state->addCity(new City());
        }
        
        $builder
                ->add('cities', 'collection', array(
                    'type' => 'todasaspatas_apibundle_city',
                    'label' => 'Cidades',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'options' => array(
                        'horizontal' => true,
                        'label_render' => false,
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\State'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_state_city';
    }

}
