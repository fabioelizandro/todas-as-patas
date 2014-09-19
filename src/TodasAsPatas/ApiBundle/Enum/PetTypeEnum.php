<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetTypeEnum extends AbstractEnum
{

    /**
     * @var PetType
     */
    public $DOG;

    /**
     * @var PetType
     */
    public $CAT;

    public function __construct()
    {
        $this->DOG = new PetType(1, 'Cachorro');
        $this->CAT = new PetType(2, 'Gato');
    }

}
