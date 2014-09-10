<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use TodasAsPatas\ApiBundle\Entity\StateRepository;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\Country;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class CountrySubscriber implements EventSubscriberInterface
{

    /**
     * @var StateRepository
     */
    private $stateRepository;

    /**
     *
     * @var ObjectManager
     */
    private $stateManager;

    /**
     * Construct
     */
    function __construct(StateRepository $stateRepository, ObjectManager $om)
    {
        $this->stateRepository = $stateRepository;
        $this->stateManager = $om;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.country.pre_update' => 'updateStates'
        );
    }

    /**
     * Set um usuário ao carrinho
     * 
     * @param ResourceEvent $event
     */
    public function updateStates(ResourceEvent $event)
    {
        /* @var $country Country */
        $country = $event->getSubject();

        $originalStates = $this->stateRepository->findBy(array('country' => $country));

        foreach ($originalStates as $state) {
            if ($country->getStates()->contains($state) === false) {
                $country->getStates()->removeElement($state);
                $this->stateManager->remove($state);
            }
        }
    }

}
