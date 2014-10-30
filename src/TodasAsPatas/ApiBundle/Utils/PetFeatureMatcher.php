<?php

namespace TodasAsPatas\ApiBundle\Utils;

use TodasAsPatas\ApiBundle\Entity\PetFeaturesInterface;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetFeatureMatcher
{

    /**
     * Verificação combinação das caracteristicas dos pets
     * 
     * @param PetFeaturesInterface $petFeature1
     * @param PetFeaturesInterface $petFeature2
     * 
     * @return boolean 
     */
    public function match(PetFeaturesInterface $petFeature1, PetFeaturesInterface $petFeature2)
    {
        $sizeSimilarity = $this->getScaleSimilarity($petFeature1->getSize()->getId(), $petFeature2->getSize()->getId(), PetSizeEnum::getInstance()->count()) * 5;
        $ageSimilarity = $this->getScaleSimilarity($petFeature1->getAge()->getId(), $petFeature2->getAge()->getId(), PetAgeEnum::getInstance()->count()) * 5;
        $genderSimilarity = $this->getBooleanSimilarity($petFeature1->getGender()->getId(), $petFeature2->getGender()->getId()) * 2;
    }
    
    private function getBooleanSimilarity($value1, $value2)
    {
        return $value1 === $value2 ? 1 : 0;
    }
    
    private function getScaleSimilarity($value1, $value2, $quantity)
    {
        $scaleDiff = $value1 > $value2 ? $value1 = $value2 : $value2 - $value1;
        
        return 1 - (($scaleDiff / $quantity));
    }
    
}
