<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class TextTypeEnum extends AbstractEnum
{

    /**
     * @var TextType
     */
    public $PRIVACY_POLICY;

    /**
     * @var TextType
     */
    public $TERMS_OF_SERVICE;

    /**
     * @var TextType
     */
    public $HELP;

    /**
     * @var TextType
     */
    public $ABOUT_US;

    public function __construct()
    {
        $this->PRIVACY_POLICY = new TextType(1, 'Política de privacidade', 'privacyPolicy');
        $this->TERMS_OF_SERVICE = new TextType(2, 'Termos de uso do serviço', 'termsOfService');
        $this->HELP = new TextType(3, 'Ajuda', 'help');
        $this->ABOUT_US = new TextType(4, 'Sobre', 'aboutUs');
    }

}
