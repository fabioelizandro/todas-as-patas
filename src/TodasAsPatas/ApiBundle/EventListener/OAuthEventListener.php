<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use FOS\OAuthServerBundle\Event\OAuthEvent;
use TodasAsPatas\ApiBundle\Entity\Client;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class OAuthEventListener
{

    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        /* @var $client Client */
        $client = $event->getClient();
        $event->setAuthorizedClient($client->isOwner());
    }

}
