<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserCommon
 */
class UserCommon extends User
{

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var ArrayCollection
     */
    private $favoritePets;

    public function __construct()
    {
        parent::__construct();
        $this->favoritePets = new ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return UserCommon
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return UserCommon
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return UserCommon
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add favoritePets
     *
     * @param \TodasAsPatas\ApiBundle\Entity\Pet $favoritePets
     * @return UserCommon
     */
    public function addFavoritePet(\TodasAsPatas\ApiBundle\Entity\Pet $favoritePets)
    {
        $this->favoritePets[] = $favoritePets;

        return $this;
    }

    /**
     * Remove favoritePets
     *
     * @param \TodasAsPatas\ApiBundle\Entity\Pet $favoritePets
     */
    public function removeFavoritePet(\TodasAsPatas\ApiBundle\Entity\Pet $favoritePets)
    {
        $this->favoritePets->removeElement($favoritePets);
    }

    /**
     * Get favoritePets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoritePets()
    {
        return $this->favoritePets;
    }

    /**
     * {@inheritance}
     */
    public function getRoles()
    {
        return \array_merge(parent::getRoles(), array('ROLE_USER_COMMON'));
    }

}
