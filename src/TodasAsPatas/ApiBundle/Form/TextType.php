<?php

namespace TodasAsPatas\ApiBundle\Form;

use TodasAsPatas\ApiBundle\Enum\TextTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', null, array(
                    'attr' => array('autofocus' => 'autofocus'),
                    'label' => 'Título'
                ))
                ->add('content', null, array(
                    'label' => 'Conteúdo',
                    'help_label_tooltip' => array('title' => 'Esse é um editor de texto HTML. Dica: para quebrar uma linha segure "Shift" + "Enter"'),
                ))
                ->add('typeId', 'choice', array(
                    'choices' => TextTypeEnum::getInstance()->getList(),
                    'label' => 'Tipo'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Text'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_text';
    }

}
