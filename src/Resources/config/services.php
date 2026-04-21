<?php

use ACAT\KeycloakBundle\Security\KeycloakProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {

    $services = $configurator->services();
    $services->set(KeycloakProvider::class)
        ->autowire()
        ->autoconfigure()
        ->public();

    $services->alias('acat_keycloak.user_provided', KeycloakProvider::class);

};
