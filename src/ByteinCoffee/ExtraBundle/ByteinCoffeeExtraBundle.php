<?php

namespace ByteinCoffee\ExtraBundle;

use ByteinCoffee\ExtraBundle\DependencyInjection\Compiler\ResolversCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ByteinCoffeeExtraBundle extends Bundle
{

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ResolversCompilerPass());
    }

}
