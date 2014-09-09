<?php

namespace ByteinCoffee\ExtraBundle\Gaufrette;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ResolverDelegate
{

    /**
     * @var ResolverInterface[]
     */
    private $resolvers;

    /**
     * @var string
     */
    private $defaultResolver;

    public function __construct($defaultResolver)
    {
        $this->resolvers = array();
        $this->defaultResolver = $defaultResolver;
    }

    /**
     * Add resolver
     * 
     * @param string $name
     * @param \ByteinCoffee\ExtraBundle\Gaufrette\ResolverInterface $resolver
     */
    public function addResolver($name, ResolverInterface $resolver)
    {
        $this->resolvers[$name] = $resolver;

        return $this;
    }

    /**
     * Get resolver
     * 
     * @param string $name
     * @return ResolverInterface
     */
    public function getResolver($name = null)
    {
        return $this->resolvers[$name !== null ? $name : $this->defaultResolver];
    }

}
