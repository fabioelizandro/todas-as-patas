<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * City
 */
class City
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
     * @var State
     */
    private $state;

    /**
     *
     * @var ArrayCollection
     */
    private $addresses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
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
     * @return City
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
     * Set state
     *
     * @param State $state
     * @return City
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add addresses
     *
     * @param Address $addresses
     * @return City
     */
    public function addAddress(Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param Address $addresses
     */
    public function removeAddress(Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * To String 
     * 
     * @return string
     */
    public function __toString()
    {
        if (null === $this->getState()) {
            return $this->getName();
        }

        return $this->getName() . ' - ' . $this->getState()->getAcronym();
    }

}
