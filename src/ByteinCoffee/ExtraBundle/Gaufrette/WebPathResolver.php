<?php

namespace ByteinCoffee\ExtraBundle\Gaufrette;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class WebPathResolver implements ResolverInterface
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $prefix;

    function __construct(RequestStack $requestStack, $prefix)
    {
        $this->requestStack = $requestStack;
        $this->prefix = $prefix;
    }

    public function resolve($path)
    {
        if ($path === null) {
            return "";
        }

        $request = $this->requestStack->getCurrentRequest();

        return sprintf('%s%s/%s/%s', $request->getSchemeAndHttpHost(), $request->getBasePath(), $this->prefix, ltrim($path, '/')
        );
    }

}
