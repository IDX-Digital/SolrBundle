<?php

namespace FS\SolrBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('fs_solr');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('fs_solr');
        }
        $rootNode->children()
            ->arrayNode('endpoints')
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('dsn')->end()
                        ->scalarNode('scheme')->end()
                        ->scalarNode('host')->end()
                        ->scalarNode('port')->end()
                        ->scalarNode('path')->end()
                        ->scalarNode('core')->end()
                        ->scalarNode('timeout')->end()
                        ->booleanNode('active')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end()
            ->booleanNode('auto_index')->defaultValue(true)->end()
        ->end();

        return $treeBuilder;
    }
}
