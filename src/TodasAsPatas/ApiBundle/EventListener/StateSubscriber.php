<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use TodasAsPatas\ApiBundle\Entity\CityRepository;
use TodasAsPatas\ApiBundle\Entity\State;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class StateSubscriber implements EventSubscriberInterface
{

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     *
     * @var ObjectManager
     */
    private $cityManager;

    /**
     * Construct
     */
    function __construct(CityRepository $cityRepository, ObjectManager $om)
    {
        $this->cityRepository = $cityRepository;
        $this->cityManager = $om;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.state.pre_update' => 'updateCities'
        );
    }

    /**
     * Set um usuário ao carrinho
     * 
     * @param ResourceEvent $event
     */
    public function updateCities(ResourceEvent $event)
    {
        /* @var $state State */
        $state = $event->getSubject();

        $originalCities = $this->cityRepository->findBy(array('state' => $state));

        foreach ($originalCities as $city) {
            if ($state->getCities()->contains($city) === false) {
                $state->getCities()->removeElement($city);
                $this->cityManager->remove($city);
            }
        }
    }

}
