<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Pagerfanta\Pagerfanta;
use Swift_Mailer;
use Swift_Message;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Templating\EngineInterface;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetListener;
use TodasAsPatas\ApiBundle\Entity\PetListenerRepository;
use TodasAsPatas\ApiBundle\Utils\PetFeatureMatcher;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetListenerSubscriber implements EventSubscriberInterface
{

    use \TodasAsPatas\ApiBundle\Utils\UserCatcherTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Array de configurçaões do listener
     * 
     * @var array
     */
    private $options;

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
    function __construct(ContainerInterface $container, array $options)
    {
        $this->container = $container;
        $this->options = $options;
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
        $petListenerRepository = $this->get('app.repository.petlistener');
        $petFeatureMatcher = new PetFeatureMatcher();

        $petListeners = $petListenerRepository->createPaginator();
        $petListeners->setMaxPerPage(40);

        for ($page = 1; $page <= $petListeners->getNbPages(); $page++) {
            $petListeners->setCurrentPage($page, true, true);

            foreach ($petListeners as $petListener) {
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
        /* @var $templating EngineInterface */
        /* @var $mailer Swift_Mailer */
        $templating = $this->get('templating');
        $mailer = $this->get('mailer');

        $emailContent = $templating->render($this->options['mailer']['template'], array(
            'pet' => $pet, 'petListener' => $petListener, 'url' => $this->options['mailer']['url'])
        );

        $message = Swift_Message::newInstance()
                ->setSubject($this->options['mailer']['subject'])
                ->setFrom($this->options['mailer']['from']['email'], $this->options['mailer']['from']['name'])
                ->setTo($petListener->getUser()->getEmail())
                ->setBody($emailContent, 'text/html')
        ;

        return $mailer->send($message);
    }

    /**
     * @see ContainerInterface::get($id)
     */
    private function get($id)
    {
        return $this->container->get($id);
    }

}
