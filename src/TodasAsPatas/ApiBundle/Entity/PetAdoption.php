<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;
use TodasAsPatas\ApiBundle\Enum\PetAdoptionType;
use TodasAsPatas\ApiBundle\Enum\PetAdoptionTypeEnum;

/**
 * PetAdoption
 */
class PetAdoption
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $typeId;

    /**
     * @var UserCommon
     */
    private $user;

    /**
     * @var Pet
     */
    private $pet;

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
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return PetAdoption
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     * @return PetAdoption
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set PetAdoptionType
     *
     * @param PetAdoptionType $petAdoptionType
     * @return PetAdoption
     */
    public function setType(PetAdoptionType $petAdoptionType)
    {
        return $this->setTypeId($petAdoptionType->getId());
    }

    /**
     * Get PetAdoptionType
     *
     * @return PetAdoptionType
     */
    public function getType()
    {
        return PetAdoptionTypeEnum::getInstance()->getItem($this->getTypeId());
    }

    /**
     * Set user
     *
     * @param UserCommon $user
     * @return PetAdoption
     */
    public function setUser(UserCommon $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserCommon 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set pet
     *
     * @param Pet $pet
     * @return PetAdoption
     */
    public function setPet(Pet $pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get pet
     *
     * @return Pet 
     */
    public function getPet()
    {
        return $this->pet;
    }

}
