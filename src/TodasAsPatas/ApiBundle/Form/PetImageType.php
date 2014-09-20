<?php

namespace TodasAsPatas\ApiBundle\Form;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PetImageType extends AbstractType
{

    /**
     * @var boolean
     */
    protected $creating;

    /**
     * Construct
     */
    function __construct($creating)
    {
        $this->creating = $creating;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->creating) {
            $builder
                    ->add('image', 'fsi_file', array(
                        'required' => true,
                        'label' => 'imagem',
                        'constraints' => array(
                            new Constraints\NotNull(),
                        )
                    ))
            ;
        } else {
            $builder
                    ->add('image', 'fsi_file', array(
                        'required' => false,
                        'label' => 'imagem'
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
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\PetImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        if ($this->creating) {
            return 'todasaspatas_apibundle_petimage_creating';
        }
        
        return 'todasaspatas_apibundle_petimage';
    }

}
