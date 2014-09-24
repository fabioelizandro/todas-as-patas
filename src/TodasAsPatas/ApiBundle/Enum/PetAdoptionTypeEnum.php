<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetAdoptionTypeEnum extends AbstractEnum
{

    /**
     * @var PetAdoptionType
     */
    public $TAP;

    /**
     * @var PetAdoptionType
     */
    public $MANUAL;

    public function __construct()
    {
        $this->TAP = new PetAdoptionType(1, 'Todas as Patas');
        $this->MANUAL = new PetAdoptionType(2, 'Manual');
    }

}
