<?php

namespace TodasAsPatas\WebBundle\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetImage;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class SerializerSubscriber implements EventSubscriberInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritance}
     */
    public static function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.post_serialize', 'class' => 'TodasAsPatas\\ApiBundle\\Entity\\Pet', 'method' => 'petPreSerialize'),
            array('event' => 'serializer.post_serialize', 'class' => 'TodasAsPatas\\ApiBundle\\Entity\\PetImage', 'method' => 'petImagePreSerialize'),
        );
    }

    /**
     * Construct
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectEvent $event
     */
    public function petPreSerialize(ObjectEvent $event)
    {
        /* @var $pet Pet */
        $pet = $event->getObject();

        $this->addMediaData($event, $pet->getProfileImageKey(), array(
            'profileImage' => 'pet_profile',
            'profileImageThumb' => 'default_thumb',
            'profileOriginalImage' => 'default'
        ));
    }

    /**
     * @param ObjectEvent $event
     */
    public function petImagePreSerialize(ObjectEvent $event)
    {
        /* @var $petImage PetImage */
        $petImage = $event->getObject();

        $this->addMediaData($event, $petImage->getImageKey(), array(
            'image' => 'pet_album',
            'imageThumb' => 'default_thumb',
            'imageOriginal' => 'default'
        ));
    }

    /**
     * ShortCut
     * 
     * @see ContainerInterface::get($id)
     */
    protected function get($serviceId)
    {
        return $this->container->get($serviceId);
    }

    /**
     * Add informações para imagens
     * 
     * @param ObjectEvent $event
     * @param array $nameFilters filtros de thumb
     */
    protected function addMediaData($event, $path, array $nameFilters)
    {
        /* @var $cacheManager CacheManager */
        $cacheManager = $this->container->get('liip_imagine.cache.manager');

        if ($path !== null) {
            foreach ($nameFilters as $name => $filter) {
                $event->getVisitor()->addData($name, $cacheManager->getBrowserPath($path, $filter));
            }
        }
    }

}
