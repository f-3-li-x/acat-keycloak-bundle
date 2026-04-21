<?php

namespace ACAT\KeycloakBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 *
 */
class KeycloakExtension extends Extension
{

    /**
     *
     */
    private const string IDENTIFIER_CALM = 'identifier_claim';
    /**
     *
     */
    private const string ACAT_KEYCLOAK_IDENTIFIER = 'acat_keycloak.identifier_claim';

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @return void
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container) : void
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter(self::ACAT_KEYCLOAK_IDENTIFIER, $config[self::IDENTIFIER_CALM]);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');

    }
}
