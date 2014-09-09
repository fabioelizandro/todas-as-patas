<?php

namespace ByteinCoffee\ExtraBundle\Gaufrette;

/**
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
interface ResolverInterface
{

    /**
     * Resolve path 
     * 
     * @param string $path resolve path
     */
    public function resolve($path);
}
