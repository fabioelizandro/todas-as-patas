<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetGenderEnum;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;
use Symfony\Component\Validator\Constraints;

class PetType extends AbstractType
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
                ->add('organization', null, array(
                    'label' => 'Organização'
                ))
                ->add('breeds', null, array(
                    'label' => 'Raças'
                ))
        ;

        if ($builder->getData() !== null && $builder->getData()->getId()) {
            $builder
                    ->add('profileImage', 'fsi_file', array(
                        'required' => false,
                        'label' => 'Imagem de perfil'
                    ))
                    ->add('images', 'collection', array(
                        'type' => 'todasaspatas_apibundle_petimage',
                        'label' => 'Imagens',
                        'allow_add' => true,
                        'allow_delete' => true,
                        'prototype' => true,
                        'by_reference' => false,
                        'required' => false,
                        'options' => array(
                            'horizontal' => true,
                            'label_render' => false,
                        )
                    ))
            ;
        } else {
            $builder
                    ->add('profileImage', 'fsi_file', array(
                        'required' => true,
                        'label' => 'Imagem de perfil',
                        'constraints' => array(
                            new Constraints\NotNull(),
                        )
                    ))
                    ->add('images', 'collection', array(
                        'type' => 'todasaspatas_apibundle_petimage_creating',
                        'label' => 'Imagens',
                        'allow_add' => true,
                        'allow_delete' => true,
                        'prototype' => true,
                        'by_reference' => false,
                        'required' => false,
                        'options' => array(
                            'horizontal' => true,
                            'label_render' => false,
                        )
                    ))
            ;
        }

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Pet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_pet';
    }

}
