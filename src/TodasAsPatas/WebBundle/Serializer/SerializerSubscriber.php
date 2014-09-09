<?php

namespace TodasAsPatas\WebBundle\Serializer;

use ByteinCoffee\ExtraBundle\Gaufrette\ResolverDelegate;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use TodasAsPatas\SiteBundle\Entity\Call;
use TodasAsPatas\SiteBundle\Entity\Scenario;
use TodasAsPatas\SiteBundle\Entity\Simulator;
use TodasAsPatas\SiteBundle\Entity\SimulatorModel;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class SerializerSubscriber implements EventSubscriberInterface
{

    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var ResolverDelegate
     */
    private $resolverDelegate;

    /**
     * @var RouterInterface
     */
    private $router;

    function __construct(CacheManager $cacheManager, ResolverDelegate $resolverDelegate, RouterInterface $router)
    {
        $this->cacheManager = $cacheManager;
        $this->resolverDelegate = $resolverDelegate;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
        );
    }

    /**
     * Add informações para imagens
     * 
     * @param ObjectEvent $event
     * @param array $nameFilters filtros de thumb
     */
    protected function addMediaData($event, $path, array $nameFilters)
    {
        if ($path !== null) {
            foreach ($nameFilters as $name => $filter) {
                $event->getVisitor()->addData($name, $this->cacheManager->getBrowserPath($path, $filter));
            }
        }
    }

}
