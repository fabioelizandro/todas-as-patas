<?php

namespace ByteinCoffee\ExtraBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for the Unique Entity validator
 *
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class UniqueEntity extends Constraint
{

    public $message = 'This value is already used.';
    public $service = 'bytein_coffee_extra.validator.unique_entity';
    public $em = null;
    public $repositoryMethod = 'findBy';
    public $repositoryService = null;
    public $repositoryClass = null;
    public $fields = array();
    public $errorPath = null;
    public $ignoreNull = true;

    public function getRequiredOptions()
    {
        return array('fields');
    }

    /**
     * The validator must be defined as a service with this name.
     *
     * @return string
     */
    public function validatedBy()
    {
        return $this->service;
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getDefaultOption()
    {
        return 'fields';
    }

}
