<?php

namespace TodasAsPatas\ApiBundle\Utils;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
trait CanonicalizerTrait
{

    /**
     * Canonicalize 
     * 
     * @param string $string
     * @return string
     */
    protected function canonicalize($string)
    {
        return null === $string ? null : mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string));
    }

}
