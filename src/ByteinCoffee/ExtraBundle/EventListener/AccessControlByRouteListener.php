<?php

namespace ByteinCoffee\ExtraBundle\EventListener;

use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class AccessControlByRouteListener
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SecurityContextInterface
     */
    private $securityContext;

    function __construct(RouterInterface $router, SecurityContextInterface $securityContext)
    {
        $this->router = $router;
        $this->securityContext = $securityContext;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        $route = $this->router->getRouteCollection()->get($request->get('_route'));

        if (null === $route) {
            return;
        }

        if (null !== $route->getOption('roles')) {
            if (!$this->securityContext->isGranted($route->getOption('roles'))) {
                throw new AccessDeniedHttpException();
            }
        }

        if (null !== $route->getOption('granted_expression')) {
            if (!$this->securityContext->isGranted($route->getOption('granted_expression'))) {
                throw new AccessDeniedHttpException();
            }
        }
    }

}
