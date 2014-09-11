<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TodasAsPatas\ApiBundle\Entity\Organization;
use TodasAsPatas\ApiBundle\Entity\UserOrganization;

class OrganizationType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* @var $organization Organization */
        $organization = $builder->getData();

        if ($organization && $organization->getUsers()->isEmpty()) {
            $organization->addUser(new UserOrganization());
        }
        
        $builder
                ->add('name', null, array(
                    'label' => 'Nome',
                    'attr' => array('autofocus' => 'autofocus')
                ))
                ->add('email', null, array(
                    'label' => 'E-mail',
                    'widget_addon_prepend' => array(
                        'text' => '@',
                    )
                ))
                ->add('phone', 'text', array(
                    'label' => 'Telefone',
                    'help_block' => 'Digite apenas números',
                ))
                ->add('address', 'todasaspatas_apibundle_address', array(
                    'label' => 'Endereço'
                ))
                ->add('users', 'collection', array(
                    'type' => 'todasaspatas_apibundle_userorganization',
                    'label' => 'Usuários',
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
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Organization'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_organization';
    }

}
