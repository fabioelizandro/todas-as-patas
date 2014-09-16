<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

if (getenv('DATABASE_URL')) {
    $dbUrl = getenv('DATABASE_URL');
    $parts = parse_url($dbUrl);

    $container->setParameter('sylius.database.driver', 'pdo_pgsql');
    $container->setParameter('sylius.database.host', $parts['host']);
    $container->setParameter('sylius.database.name', trim($parts['path'], '/'));
    $container->setParameter('sylius.database.user', $parts['user']);
    $container->setParameter('sylius.database.password', $parts['pass']);
    $container->setParameter('sylius.database.port', $parts['port']);
}

if (getenv("SYMFONY_ENV_VARS")) {

    $parameters = Yaml::parse(file_get_contents(__DIR__ . "/parameters_env_map.yml"));

    foreach ($parameters['parameters_env_map'] as $parameter => $envKey) {
        /* @var $container ContainerInterface */
        $container->setParameter($parameter, getenv($envKey));
    }
}
