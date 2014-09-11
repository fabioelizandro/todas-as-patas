<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserAdminType extends AbstractType
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
                ->add('groups', null, array(
                    'label' => 'Grupos',
                    'help_label_tooltip' => array('title' => 'O grupo de usuário é que define qual o nível de acesso do mesmo, cuidado nessa parte do cadastro ;)'),
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
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\UserAdmin',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_useradmin';
    }

}
