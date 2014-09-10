<?php

namespace TodasAsPatas\ApiBundle\Form;

use TodasAsPatas\ApiBundle\Entity\Country;
use TodasAsPatas\ApiBundle\Entity\State;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CountryType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* @var $country Country */
        $country = $builder->getData();

        if ($country && $country->getStates()->isEmpty()) {
            $country->addState(new State());
        }

        $builder
                ->add('name', null, array(
                    'label' => 'Nome',
                    'attr' => array('autofocus' => 'autofocus')
                ))
                ->add('states', 'collection', array(
                    'type' => 'todasaspatas_apibundle_state',
                    'label' => 'Estado',
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
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Country'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_country';
    }

}
