<?php

namespace TodasAsPatas\ApiBundle\Form;

use ByteinCoffee\ExtraBundle\Form\Transformer\ObjectToIdentifierTransformer;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{

    /**
     * @var ObjectRepository
     */
    private $cityRepository;

    function __construct(ObjectRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ObjectToIdentifierTransformer($this->cityRepository);

        $builder
                ->add('number', null, array(
                    'label' => 'Número'
                ))
                ->add('postalCode', 'text', array(
                    'label' => 'CEP',
                    'help_block' => 'Digite apenas números',
                    'attr' => array('pattern' => '\d*')
                ))
                ->add('street', null, array(
                    'label' => 'Rua'
                ))
                ->add('district', null, array(
                    'label' => 'Bairro'
                ))
                ->add($builder->create('city', 'text', array(
                            'label' => 'Cidade',
                        ))->addModelTransformer($transformer))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodasAsPatas\ApiBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todasaspatas_apibundle_address';
    }

}
