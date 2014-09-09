<?php

namespace ByteinCoffee\ExtraBundle\Sylius;

use Sylius\Bundle\ResourceBundle\Controller\Configuration as BaseConfiguration;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class Configuration extends BaseConfiguration
{

    /**
     * Retorna o grupo de configuração que está configurado para rota
     * 
     * @return array
     */
    public function getSerializationGroups()
    {
        $serialization = $this->get('serialization', array());

        return \array_key_exists('groups', $serialization) ? $serialization['groups'] : null;
    }

    /**
     * Get parameter for request
     * 
     * @param string $parameter
     * @param mixed $default
     * @return mixed
     */
    public function get($parameter, $default = null)
    {
        return parent::get($parameter, $default);
    }

}
