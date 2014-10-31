<?php

namespace TodasAsPatas\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('todas_as_patas_api');

        $rootNode
                ->children()
                    ->arrayNode('pet_listener')
                        ->children()
                            ->arrayNode('mailer')
                                ->append($this->subjectDefinition())
                                ->append($this->templateDefinition())
                                ->append($this->urlDefinition())
                                ->append($this->fromDefinition())
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
    
    
    private function subjectDefinition()
    {
        $node = new Builder\ScalarNodeDefinition('subject');
        $node->isRequired();

        return $node;
    }

    private function templateDefinition()
    {
        $node = new Builder\ScalarNodeDefinition('template');
        $node->isRequired();

        return $node;
    }
    
    private function urlDefinition()
    {
        $node = new Builder\ScalarNodeDefinition('url');
        $node->isRequired();

        return $node;
    }
    
    private function fromDefinition()
    {
        $nodeEmail = new Builder\ScalarNodeDefinition('email');
        $nodeEmail->isRequired();

        $nodeName = new Builder\ScalarNodeDefinition('name');
        $nodeName->isRequired();

        $node = new Builder\ArrayNodeDefinition('from');
        $node->isRequired();
        $node->append($nodeEmail);
        $node->append($nodeName);

        return $node;
    }

}
