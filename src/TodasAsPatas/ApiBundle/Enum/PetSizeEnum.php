<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetSizeEnum extends AbstractEnum
{

    /**
     * @var PetSize
     */
    public $SMALL;

    /**
     * @var PetSize
     */
    public $MEDIUM;

    /**
     * @var PetSize
     */
    public $LARGE;


    public function __construct()
    {
        $this->SMALL = new PetSize(1, 'Pequeno');
        $this->MEDIUM = new PetSize(2, 'Médio');
        $this->LARGE = new PetSize(3, 'Grande');
    }

}
