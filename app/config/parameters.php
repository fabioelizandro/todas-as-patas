<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

if (getenv('DATABASE_URL')) {
    $dbUrl = getenv('DATABASE_URL');
    $parts = parse_url($dbUrl);

    $container->setParameter('database_driver', 'pdo_pgsql');
    $container->setParameter('database_host', $parts['host']);
    $container->setParameter('database_name', trim($parts['path'], '/'));
    $container->setParameter('database_user', $parts['user']);
    $container->setParameter('database_password', $parts['pass']);
    $container->setParameter('database_port', $parts['port']);
}

if (getenv("SYMFONY_ENV_VARS")) {

    $parameters = Yaml::parse(file_get_contents(__DIR__ . "/parameters_env_map.yml"));

    foreach ($parameters['parameters_env_map'] as $parameter => $envKey) {
        /* @var $container ContainerInterface */
        $container->setParameter($parameter, getenv($envKey));
    }
}
