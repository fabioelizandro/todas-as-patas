<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * AdoptionRequestMessage
 */
class AdoptionRequestMessage extends AbstractMessage
{

    /**
     * @var boolean
     */
    private $aproved;

    /**
     * Set aproved
     *
     * @param boolean $aproved
     * @return AdoptionRequestMessage
     */
    public function setAproved($aproved)
    {
        $this->aproved = $aproved;

        return $this;
    }

    /**
     * Get aproved
     *
     * @return boolean 
     */
    public function getAproved()
    {
        return $this->aproved;
    }

}
