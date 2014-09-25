<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PetAdoptionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('user', null, array(
                    'label' => 'Usuário',
                    'help_label_tooltip' => array(
                        'title' => 'Caso você não escolha nenhum usuário,'
                        . ' será considerado uma adoção MANUAL, ou seja que não'
                        . ' tem relação com o TAP.'
                    ),
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\PetAdoption'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_petadoption';
    }

}
