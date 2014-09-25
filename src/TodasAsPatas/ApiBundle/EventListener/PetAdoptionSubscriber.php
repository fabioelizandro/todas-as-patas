<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use TodasAsPatas\ApiBundle\Entity\PetAdoption;
use TodasAsPatas\ApiBundle\Enum\PetAdoptionTypeEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetAdoptionSubscriber implements EventSubscriberInterface
{

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.petadoption.pre_create' => 'updateType',
            'app.petadoption.pre_update' => 'updateType'
        );
    }

    /**
     * Atualiza o tipo da adoção
     * 
     * @param ResourceEvent $event
     */
    public function updateType(ResourceEvent $event)
    {
        /* @var $petAdoption PetAdoption */
        $petAdoption = $event->getSubject();

        if ($petAdoption->getUser() === null) {
            $petAdoption->setType(PetAdoptionTypeEnum::getInstance()->MANUAL);
        }else{
            $petAdoption->setType(PetAdoptionTypeEnum::getInstance()->TAP);
        }
    }

}
