<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FSi\DoctrineExtensions\Uploadable\File;
use TodasAsPatas\ApiBundle\Enum\PetAge;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetGender;
use TodasAsPatas\ApiBundle\Enum\PetGenderEnum;
use TodasAsPatas\ApiBundle\Enum\PetSize;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;

/**
 * Pet
 */
class Pet implements PetFeaturesInterface
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
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var DateTime
     */
    private $deletedAt;

    /**
     * @var integer
     */
    private $displayQuantity;

    /**
     * @var integer
     */
    private $sizeId;

    /**
     * @var integer
     */
    private $ageId;

    /**
     * @var integer
     */
    private $genderId;

    /**
     * @var ArrayCollection
     */
    private $breeds;

    /**
     * @var Organization
     */
    private $organization;

    /**
     * @var string
     */
    private $profileImageKey;

    /**
     * @var File
     */
    private $profileImage;

    /**
     * @var ArrayCollection
     */
    private $images;

    /**
     * @var boolean
     */
    private $adopted;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->displayQuantity = 0;
        $this->breeds = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->adopted = false;
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
     * @return Pet
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
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return Pet
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
     * @return Pet
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
     * Set deletedAt
     *
     * @param DateTime $deletedAt
     * @return Pet
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
     * Set displayQuantity
     *
     * @param integer $displayQuantity
     * @return Pet
     */
    public function setDisplayQuantity($displayQuantity)
    {
        $this->displayQuantity = $displayQuantity;

        return $this;
    }

    /**
     * Get displayQuantity
     *
     * @return integer 
     */
    public function getDisplayQuantity()
    {
        return $this->displayQuantity;
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     * @return Pet
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
     * @return Pet
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
     * Set ageId
     *
     * @param integer $ageId
     * @return Pet
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
     * @return Pet
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
        return $this->setAgeId(PetAgeEnum::getInstance()->getItem($this->getAgeId()));
    }

    /**
     * Set genderId
     *
     * @param integer $genderId
     * @return Pet
     */
    public function setGenderId($genderId)
    {
        $this->genderId = $genderId;

        return $this;
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
     * Set PetGender
     *
     * @param PetGender $gender
     * @return Pet
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
     * Add breeds
     *
     * @param Breed $breeds
     * @return Pet
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
     * Set organization
     *
     * @param Organization $organization
     * @return Pet
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Get Profile Image
     *
     * @return File|null
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * Set Profile Image
     *
     * @param mixed $profileImage
     * @return Pet
     */
    public function setProfileImage($profileImage)
    {
        if ($profileImage !== null) {
            $this->profileImage = $profileImage;
        }

        return $this;
    }

    /**
     * Set profileImageKey
     *
     * @param string $profileImageKey
     * @return Pet
     */
    public function setProfileImageKey($profileImageKey)
    {
        $this->profileImageKey = $profileImageKey;

        return $this;
    }

    /**
     * Get profileImageKey
     *
     * @return string 
     */
    public function getProfileImageKey()
    {
        return $this->profileImageKey;
    }

    /**
     * Add images
     *
     * @param PetImage $image
     * @return Pet
     */
    public function addImage(PetImage $image)
    {
        $image->setPet($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove images
     *
     * @param PetImage $images
     */
    public function removeImage(PetImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set adopted
     *
     * @param boolean $adopted
     * @return Pet
     */
    public function setAdopted($adopted)
    {
        $this->adopted = $adopted;

        return $this;
    }

    /**
     * Get adopted
     *
     * @return boolean 
     */
    public function getAdopted()
    {
        return $this->adopted;
    }

    /**
     * Is adopted
     *
     * @return boolean 
     */
    public function isAdopted()
    {
        return $this->adopted;
    }

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
