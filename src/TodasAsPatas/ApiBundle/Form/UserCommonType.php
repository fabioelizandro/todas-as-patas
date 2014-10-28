<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserCommonType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username', null, array(
                    'attr' => array('autofocus' => 'autofocus'),
                    'label' => 'Username',
                    'help_label_tooltip' => array('title' => 'O username é utilizado para realizar o login'),
                ))
                ->add('email', 'email', array(
                    'label' => 'E-mail',
                    'widget_addon_prepend' => array(
                        'text' => '@',
                    )
                ))
                ->add('firstName', null, array(
                    'label' => 'Nome'
                ))
                ->add('lastName', null, array(
                    'label' => 'Sobrenome'
                ))
                ->add('phone', 'text', array(
                    'label' => 'Telefone',
                    'help_label_tooltip' => array('title' => 'Apensa números 99 99999999'),
                ))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'required' => !($builder->getData() && $builder->getData()->getId()),
                    'first_options' => array('label' => 'Senha'),
                    'second_options' => array('label' => 'Confirme a senha'),
                    'invalid_message' => 'As senhas não conferem',
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\UserCommon',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_usercommon';
    }

}
