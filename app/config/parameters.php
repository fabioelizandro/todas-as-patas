<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

if (getenv("SYMFONY_PARAMETERS_FILE") === 'parameters.php') {

    $parameters = Yaml::parse(file_get_contents(__DIR__ . "/parameters.yml.dist"));

    foreach ($parameters['parameters'] as $parameter => $defaultValue) {
        /* @var $container ContainerInterface */
        $container->setParameter($parameter, getenv($parameter));
    }
}


