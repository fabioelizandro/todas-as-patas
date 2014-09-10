<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Country
 */
class Country
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $states;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->states = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add states
     *
     * @param State $states
     * @return Country
     */
    public function addState(State $states)
    {
        $states->setCountry($this);
        $this->states[] = $states;

        return $this;
    }

    /**
     * Remove states
     *
     * @param State $states
     */
    public function removeState(State $states)
    {
        $this->states->removeElement($states);
    }

    /**
     * Get states
     *
     * @return Collection 
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * To String 
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}
