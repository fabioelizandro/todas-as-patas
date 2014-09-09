<?php

namespace TodasAsPatas\ApiBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * Group
 */
class Group extends BaseGroup
{

    /**
     * ToString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}
