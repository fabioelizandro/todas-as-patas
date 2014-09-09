<?php

namespace ByteinCoffee\ExtraBundle\Enum;

/**
 * Item de uma enumeração
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
abstract class AbstractItem implements ItemInterface
{

    /**
     * Identificador do item
     * 
     * @var int
     */
    protected $id;

    /**
     * Descrição do item
     * 
     * @var string
     */
    protected $description;

    /**
     * Construtor
     * 
     * @param int $id
     * @param string $decription
     */
    function __construct($id, $decription)
    {
        $this->id = $id;
        $this->description = $decription;
    }

    /**
     * Identificador
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Descriação
     *  
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * getDescricao
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getDescription();
    }

}
