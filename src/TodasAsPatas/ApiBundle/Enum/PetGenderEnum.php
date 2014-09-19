<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetGenderEnum extends AbstractEnum
{

    /**
     * @var PetGender
     */
    public $MALE;

    /**
     * @var PetGender
     */
    public $FEMALE;

    public function __construct()
    {
        $this->MALE = new PetGender(1, 'Macho');
        $this->FEMALE = new PetGender(2, 'Fêmea');
    }

}
