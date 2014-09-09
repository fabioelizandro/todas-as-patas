<?php

namespace ByteinCoffee\ExtraBundle\Sylius;

use Sylius\Bundle\ResourceBundle\Controller\ConfigurationFactory as BaseFactory;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ConfigurationFactory extends BaseFactory
{

    public function createConfiguration($bundlePrefix, $resourceName, $templateNamespace, $templatingEngine = 'twig')
    {
        return new Configuration(
                $this->parametersParser, $bundlePrefix, $resourceName, $templateNamespace, $templatingEngine
        );
    }

}
