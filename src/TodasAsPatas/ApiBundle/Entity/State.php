<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * State
 */
class State
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
     * @var string
     */
    private $acronym;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var ArrayCollection
     */
    private $cities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new ArrayCollection();
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
     * @return State
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
     * Set acronym
     *
     * @param string $acronym
     * @return State
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string 
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set country
     *
     * @param Country $country
     * @return State
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add cities
     *
     * @param City $cities
     * @return State
     */
    public function addCity(City $cities)
    {
        $cities->setState($this);
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param City $cities
     */
    public function removeCity(City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * To String 
     * 
     * @return string
     */
    public function __toString()
    {
        if (null === $this->getCountry()) {
            return $this->getName();
        }

        return $this->getName() . ' - ' . $this->getCountry()->getName();
    }

}
