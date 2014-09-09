<?php

namespace ByteinCoffee\ExtraBundle\Enum;

/**
 * Classe abstrata de enumeração 
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
abstract class AbstractEnum implements EnumInterface
{

    /**
     * Lista de itens da enumeração
     * 
     * @var ItemInterface[]
     */
    protected $list;

    /**
     * @return EnumInterface
     */
    public static function getInstance()
    {
        return new static();
    }

    /**
     * @return EnumInterface
     */
    public static function getChoices()
    {
        $instance = new static();
        $list = $instance->getList();

        return \array_keys($list);
    }

    /**
     * Busca o item pelo id 
     * 
     * @param ItemInterface $id
     * @return ItemInterface 
     */
    public function getItem($id)
    {
        $list = $this->getList();

        return \array_key_exists($id, $list) ? $list[$id] : null;
    }

    /**
     * Lista de itens da enumeração
     * 
     * @return ItemInterface[]
     */
    public function getList()
    {
        if (!$this->list) {
            $this->list = $this->initList();
        }

        return $this->list;
    }

    /**
     * Lista de itens da enumeração sem associação de chaves do array
     * 
     * @return ItemInterface[]
     */
    public function getListArray()
    {
        $list = array();

        foreach ($this->getList() as $item) {
            $list[] = $item;
        }

        return $list;
    }

    /**
     * Lista de itens da ordenada
     * 
     * @return ItemInterface[]
     */
    public function getOrderedList()
    {
        $list = $this->getList();
        \sort($list);

        return $list;
    }

    /**
     * Inicia a lista de itens da enumeração
     * @return array Lista de itens
     */
    private function initList()
    {
        $list = array();
        $reflection = new \ReflectionClass($this);
        /* @var $atributoEnum \ReflectionProperty */

        foreach ($reflection->getProperties() as $atributoEnum) {
            if ($atributoEnum->isPublic() && ($atributoEnum->getValue($this) instanceof ItemInterface)) {
                $item = $atributoEnum->getValue($this);
                if (\array_key_exists($item->getId(), $list) === true) {
                    throw new EnumException(sprintf("O atributo %s da enumeração está com o ID duplicado", $atributoEnum->getName()));
                }
                $list[$item->getId()] = $item;
            }
        }

        return $list;
    }

}
