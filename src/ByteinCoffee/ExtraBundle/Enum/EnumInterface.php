<?php

namespace ByteinCoffee\ExtraBundle\Enum;

/**
 * Interface de uma enumeração 
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
interface EnumInterface
{

    /**
     * @return ItemInterface[] Itens da enumeração
     */
    public function getList();

    /**
     * @return ItemInterface Item da enumeração
     */
    public function getItem($id);
}
