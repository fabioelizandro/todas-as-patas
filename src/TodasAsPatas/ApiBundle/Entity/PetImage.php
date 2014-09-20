<?php

namespace TodasAsPatas\ApiBundle\Entity;

use FSi\DoctrineExtensions\Uploadable\File;

/**
 * PetImage
 */
class PetImage
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $imageKey;

    /**
     * @var File
     */
    private $image;

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
     * Set imageKey
     *
     * @param string $imageKey
     * @return PetImage
     */
    public function setImageKey($imageKey)
    {
        $this->imageKey = $imageKey;

        return $this;
    }

    /**
     * Get imageKey
     *
     * @return string 
     */
    public function getImageKey()
    {
        return $this->imageKey;
    }

    /**
     * Set pet
     *
     * @param Pet $pet
     * @return PetImage
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

    /**
     * Get Image
     *
     * @return File|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set Image
     *
     * @param mixed $image
     * @return Pet
     */
    public function setImage($image)
    {
        if ($image !== null) {
            $this->image = $image;
        }

        return $this;
    }

}
