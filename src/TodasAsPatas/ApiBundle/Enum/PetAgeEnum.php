<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetAgeEnum extends AbstractEnum
{

    /**
     * @var PetAge
     */
    public $BABY;

    /**
     * @var PetAge
     */
    public $YOUNG;

    /**
     * @var PetAge
     */
    public $ADULT;

    /**
     * @var PetAge
     */
    public $SENIOR;

    public function __construct()
    {
        $this->BABY = new PetAge(1, 'Baby');
        $this->YOUNG = new PetAge(2, 'Jovem');
        $this->ADULT = new PetAge(3, 'Adulto');
        $this->SENIOR = new PetAge(4, 'Sênior');
    }

}
