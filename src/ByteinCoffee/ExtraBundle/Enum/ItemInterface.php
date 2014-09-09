<?php

namespace ByteinCoffee\ExtraBundle\Enum;

/**
 * Item da enumeração 
 * 
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
interface ItemInterface
{

    /**
     * @return int Identificador do item
     */
    public function getId();

    /**
     * @return string Descrição do item
     */
    public function getDescription();
}
