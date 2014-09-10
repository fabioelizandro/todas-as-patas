<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', null, array(
                    'label' => 'Nome'
                ))
                ->add('acronym', null, array(
                    'label' => 'Sigla'
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
        return 'todasaspatas_apibundle_state';
    }

}
