<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use TodasAsPatas\ApiBundle\Enum\PetAge;
use TodasAsPatas\ApiBundle\Enum\PetGender;
use TodasAsPatas\ApiBundle\Enum\PetSize;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
interface PetFeaturesInterface
{

    /**
     * Get PetSize
     * 
     * @return PetSize 
     */
    public function getSize();

    /**
     * Get PetAge
     * 
     * @return PetAge
     */
    public function getAge();

    /**
     * Get PetGender
     * 
     * @return PetGender
     */
    public function getGender();

    /**
     * Get Breeds
     * 
     * @return ArrayCollection
     */
    public function getBreeds();
}
