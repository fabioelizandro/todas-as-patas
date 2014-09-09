<?php

namespace ByteinCoffee\ExtraBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ResolversCompilerPass implements CompilerPassInterface
{

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tags = $container->findTaggedServiceIds('byteincoffee.gaufrette.resolver');

        if (count($tags) > 0 && $container->hasDefinition('bytein_coffee_extra.gaufrette.resolver_delegate')) {
            $delegate = $container->getDefinition('bytein_coffee_extra.gaufrette.resolver_delegate');

            foreach ($tags as $id => $tag) {
                $delegate->addMethodCall('addResolver', array($tag[0]['resolver'], new Reference($id)));
            }
        }
    }

}
