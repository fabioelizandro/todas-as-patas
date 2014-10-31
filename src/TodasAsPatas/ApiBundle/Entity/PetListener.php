<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use TodasAsPatas\ApiBundle\Enum\PetAge;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetGender;
use TodasAsPatas\ApiBundle\Enum\PetGenderEnum;
use TodasAsPatas\ApiBundle\Enum\PetSize;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;
use TodasAsPatas\ApiBundle\Enum\PetType;
use TodasAsPatas\ApiBundle\Enum\PetTypeEnum;

/**
 * PetListener
 */
class PetListener implements PetFeaturesInterface
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sizeId;

    /**
     * @var integer
     */
    private $genderId;

    /**
     * @var integer
     */
    private $ageId;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var ArrayCollection
     */
    private $breeds;

    /**
     * @var UserCommon
     */
    private $user;

    /**
     * @var integer
     */
    private $typeId;
    
    /**
     * Construct
     */
    public function __construct()
    {
        $this->breeds = new ArrayCollection();
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
     * Set sizeId
     *
     * @param integer $sizeId
     * @return PetListener
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * Get sizeId
     *
     * @return integer 
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * Set Size
     *
     * @param PetSize $size
     * @return PetListener
     */
    public function setSize(PetSize $size)
    {
        return $this->setSizeId($size->getId());
    }

    /**
     * Get PetSize
     *
     * @return PetSize
     */
    public function getSize()
    {
        return PetSizeEnum::getInstance()->getItem($this->getSizeId());
    }

    /**
     * Set genderId
     *
     * @param integer $genderId
     * @return PetListener
     */
    public function setGenderId($genderId)
    {
        $this->genderId = $genderId;

        return $this;
    }

    /**
     * Set PetGender
     *
     * @param PetGender $gender
     * @return PetListener
     */
    public function setGender($gender)
    {
        return $this->setGenderId($gender->getId());
    }

    /**
     * Get PetGender
     *
     * @return PetGender
     */
    public function getGender()
    {
        return PetGenderEnum::getInstance()->getItem($this->getGenderId());
    }

    /**
     * Get genderId
     *
     * @return integer 
     */
    public function getGenderId()
    {
        return $this->genderId;
    }

    /**
     * Set ageId
     *
     * @param integer $ageId
     * @return PetListener
     */
    public function setAgeId($ageId)
    {
        $this->ageId = $ageId;

        return $this;
    }

    /**
     * Get ageId
     *
     * @return integer 
     */
    public function getAgeId()
    {
        return $this->ageId;
    }

    /**
     * Set PetAge
     *
     * @param PetAge $age
     * @return PetListener
     */
    public function setAge(PetAge $age)
    {
        return $this->setAgeId($age->getId());
    }

    /**
     * Get PetAge
     *
     * @return PetAge
     */
    public function getAge()
    {
        return PetAgeEnum::getInstance()->getItem($this->getAgeId());
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return PetListener
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
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     * @return PetListener
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add breeds
     *
     * @param Breed $breeds
     * @return PetListener
     */
    public function addBreed(Breed $breeds)
    {
        $this->breeds[] = $breeds;

        return $this;
    }

    /**
     * Remove breeds
     *
     * @param Breed $breeds
     */
    public function removeBreed(Breed $breeds)
    {
        $this->breeds->removeElement($breeds);
    }

    /**
     * Get breeds
     *
     * @return Collection 
     */
    public function getBreeds()
    {
        return $this->breeds;
    }

    /**
     * Set user
     *
     * @param UserCommon $user
     * @return PetListener
     */
    public function setUser(UserCommon $user)
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
     * Set typeId
     *
     * @param integer $typeId
     * @return PetListener
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
     * Set Type
     *
     * @param PetType $type
     * @return PetListener
     */
    public function setType(PetType $type)
    {
        return $this->setTypeId($type->getId());
    }

    /**
     * Get Type
     *
     * @return PetType
     */
    public function getType()
    {
        return PetTypeEnum::getInstance()->getItem($this->getTypeId());
    }
    
    /**
     * ToString
     */
    public function __toString()
    {
        return \strval($this->getId());
    }

}
