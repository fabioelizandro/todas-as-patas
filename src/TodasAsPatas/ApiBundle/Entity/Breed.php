<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;
use TodasAsPatas\ApiBundle\Enum\PetType;
use TodasAsPatas\ApiBundle\Enum\PetTypeEnum;

/**
 * Breed
 */
class Breed
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
     * @var DateTime
     */
    private $deletedAt;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $typeId;

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
     * @return Breed
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
     * Set deletedAt
     *
     * @param DateTime $deletedAt
     * @return Breed
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return Breed
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
     * @return Breed
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
     * Set typeId
     *
     * @param integer $typeId
     * @return Breed
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
     * @return Breed
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
     * toString
     */
    public function __toString()
    {
        return $this->getName();
    }

}
