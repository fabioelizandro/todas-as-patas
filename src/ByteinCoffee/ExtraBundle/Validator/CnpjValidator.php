<?php

namespace ByteinCoffee\ExtraBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class CnpjValidator extends ConstraintValidator
{

    public function validate($cnpj, Constraint $constraint)
    {
        $cnpj = \str_pad(\strval($cnpj), 14, "0", STR_PAD_LEFT);
        if (\strlen($cnpj) !== 14) {
            $this->context->addViolation(
                    $constraint->messageLength, array('%cnpj%' => $cnpj)
            );
        }

        if ($this->isCnpfValid($cnpj) === false) {
            $this->context->addViolation(
                    $constraint->message, array('%cnpj%' => $cnpj)
            );
        }
    }

    /**
     * Valida os digitos verificadores do CNPJ
     * 
     * @param integer $cnpj
     * @return boolean
     */
    public function isCnpfValid($cnpj)
    {
        $cnpjArray = \str_split(\strval($cnpj));
        $digitOne = $this->generateDigit($cnpjArray, array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2));
        $digitTwo = $this->generateDigit($cnpjArray, array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2));

        return ($cnpjArray[12] == $digitOne && $cnpjArray[13] == $digitTwo);
    }

    /**
     * Gera um digito verificador
     * 
     * @param integer $cnpj
     * @param array $multipliers
     */
    private function generateDigit($cnpj, array $multipliers)
    {
        $sun = 0;
        for ($i = 0; $i <= (\count($multipliers) - 1); $i++) {
            $sun += $multipliers[$i] * $cnpj[$i];
        }
        $digit = 11 - ($sun % 11);
        if ($digit >= 10) {
            $digit = 0;
        }

        return $digit;
    }

}
