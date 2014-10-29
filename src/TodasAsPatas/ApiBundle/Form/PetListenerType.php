<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetGenderEnum;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;

class PetListenerType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('sizeId', 'choice', array(
                    'label' => 'Tamanho',
                    'choices' => PetSizeEnum::getInstance()->getList(),
                ))
                ->add('ageId', 'choice', array(
                    'label' => 'Idade',
                    'choices' => PetAgeEnum::getInstance()->getList(),
                ))
                ->add('genderId', 'choice', array(
                    'label' => 'Género',
                    'choices' => PetGenderEnum::getInstance()->getList(),
                ))
                ->add('breeds', null, array(
                    'label' => 'Raças',
                    'required' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\PetListener'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_petlistener';
    }

}
