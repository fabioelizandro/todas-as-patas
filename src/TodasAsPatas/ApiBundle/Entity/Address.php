<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * Address
 */
class Address
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $district;

    /**
     * @var City
     */
    private $city;

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
     * Set number
     *
     * @param integer $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Address
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set city
     *
     * @param City $city
     * @return Address
     */
    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * To String 
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getStreet();
    }

}
