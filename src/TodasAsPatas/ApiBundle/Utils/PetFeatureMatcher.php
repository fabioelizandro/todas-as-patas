<?php

namespace TodasAsPatas\ApiBundle\Utils;

use TodasAsPatas\ApiBundle\Entity\Breed;
use TodasAsPatas\ApiBundle\Entity\PetFeaturesInterface;
use TodasAsPatas\ApiBundle\Enum\PetAgeEnum;
use TodasAsPatas\ApiBundle\Enum\PetSizeEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetFeatureMatcher
{

    /**
     * Simularidade mínima para realizar um match
     */
    const MIN_SIMILARITY = 0.8;

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
        $breedSimilarity = $this->getArraySimilarity($petFeature1->getBreeds()->getIterator()->getArrayCopy(), $petFeature2->getBreeds()->getIterator()->getArrayCopy(), function(Breed $breed1, Breed $breed2) {
                    if ($breed1->getId() === $breed2->getId()) {
                        return 0;
                    }
                    return ($breed1->getId() > $breed2->getId()) ? 1 : -1;
                }) * 3;
        
        $similarity = ($sizeSimilarity + $ageSimilarity + $genderSimilarity + $breedSimilarity) / (5 + 5 + 2 + 3);

        return $similarity >= self::MIN_SIMILARITY;
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

    private function getArraySimilarity(array $array1, array $array2, $caparationFunction)
    {
        $count = \count($array1) > \count($array2) ? \count($array1) : \count($array2);
        if ($count == 0) {
            return 1;
        }
        
        $arrayDiff = array_udiff($array1, $array2, $caparationFunction);
        $diff = $count - \count($arrayDiff);
        
        
        return $diff / $count;
    }

}
