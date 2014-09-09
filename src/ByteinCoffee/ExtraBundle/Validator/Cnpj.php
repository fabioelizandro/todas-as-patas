<?php

namespace ByteinCoffee\ExtraBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 * 
 * @Annotation
 */
class Cnpj extends Constraint
{

    public $message = "Cnpf %cnpj% não é válido";
    public $messageLength = "Cnpj %cnpj% deve ter 14 números";

}
