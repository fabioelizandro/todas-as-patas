<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractItem;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class TextType extends AbstractItem
{

    private $reference;

    public function __construct($id, $decription, $reference)
    {
        parent::__construct($id, $decription);
        $this->reference = $reference;
    }

    function getReference()
    {
        return $this->reference;
    }

    function setReference($reference)
    {
        $this->reference = $reference;
        
        return $this;
    }

}
