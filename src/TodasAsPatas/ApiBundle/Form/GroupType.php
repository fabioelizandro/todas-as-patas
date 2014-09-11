<?php

namespace TodasAsPatas\ApiBundle\Form;

use TodasAsPatas\ApiBundle\Enum\RoleEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', null, array(
                    'attr' => array('autofocus' => 'autofocus'),
                    'label' => 'Nome'
                ))
                ->add('roles', 'choice', array(
                    'choices' => RoleEnum::getInstance()->getList(),
                    'multiple' => true,
                    'label' => "Regras",
                    'help_label_tooltip' => array('title' => 'As regras são utilizadas para definir qual será o nível de acesso que o usuário irá ter'),
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Group'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_group';
    }

}
