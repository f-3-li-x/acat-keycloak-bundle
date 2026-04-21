<?php

namespace ACAT\KeycloakBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 *
 */
class Configuration implements ConfigurationInterface
{

    /**
     *
     */
    private const string TREE = 'acat_keycloak';

    /**
     *
     */
    private const string IDENTIFIER_CLAM = 'identifier_claim';

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
       $treeBuilder = new TreeBuilder(self::TREE);
       $treeBuilder->getRootNode()
           ->children()
           ->scalarNode(self::IDENTIFIER_CLAM)->defaultValue('sub')->end()
           ->end();
       return $treeBuilder;
    }
}
