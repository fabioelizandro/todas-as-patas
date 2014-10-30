<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetListener;
use TodasAsPatas\ApiBundle\Entity\PetListenerRepository;
use TodasAsPatas\ApiBundle\Utils\PetFeatureMatcher;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetListenerSubscriber implements EventSubscriberInterface
{

    use \TodasAsPatas\ApiBundle\Utils\UserCatcher;
    
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritance}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.pet.post_create' => 'dispatchPet'
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
     * Canonicalize Nome
     * 
     * @param ResourceEvent $event
     */
    public function dispatchPet(ResourceEvent $event)
    {
        /* @var $pet Pet */
        /* @var $petListenerRepository PetListenerRepository */
        /* @var $petListeners Pagerfanta */
        $pet = $event->getSubject();
        $petListenerRepository = $this->get('app.petlistener.repository');
        $petFeatureMatcher = new PetFeatureMatcher();
        
        $petListeners = $petListenerRepository->createPaginator();
        $petListeners->setMaxPerPage(40);
        
        for ($page = 1; $page <= $petListeners->getNbPages(); $page++) {
            $petListeners->setCurrentPage(1, true, true);
            
            foreach ($petListener as $petListeners) {
                if ($petFeatureMatcher->match($pet, $petListener)) {
                    $this->notificateUser($pet, $petListener);
                }
            }
        }

    }
    
    /**
     * {@inheritance}
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Notifica o usuário de que um cachorro compativel com seu perfil foi encontrado
     * 
     * @param Pet $pet
     * @param PetListener $petListener
     */
    private function notificateUser(Pet $pet, PetListener $petListener)
    {
        //        $emailContent = $this->templating->render($this->options['mailer']['template'], array(
//            'user' => $user, 'event' => $event)
//        );
//        $message = Swift_Message::newInstance()
//                ->setSubject($this->options['mailer']['subject'])
//                ->setFrom($this->options['mailer']['from']['email'], $this->options['mailer']['from']['name'])
//                ->setTo($this->options['mailer']['to']['email'])
//                ->setBody($emailContent, 'text/html')
//        ;
//        $this->mailer->send($message);
    }
    
    /**
     * @see ContainerInterface::get($id)
     */
    private function get($id)
    {
        return $this->container->get($id);
    }

    

}
