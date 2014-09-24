<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetImageRepository;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetSubscriber implements EventSubscriberInterface
{

    /**
     * @var PetImageRepository
     */
    private $petImageRepository;

    /**
     *
     * @var ObjectManager
     */
    private $petImageManager;

    /**
     * Construct
     */
    function __construct(PetImageRepository $stateRepository, ObjectManager $om)
    {
        $this->petImageRepository = $stateRepository;
        $this->petImageManager = $om;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.pet.pre_update' => 'updateImages'
        );
    }

    /**
     * Atualiza os dados da lista
     * 
     * @param ResourceEvent $event
     */
    public function updateImages(ResourceEvent $event)
    {
        /* @var $pet Pet */
        $pet = $event->getSubject();

        $originalImages = $this->petImageRepository->findBy(array('pet' => $pet));

        foreach ($originalImages as $image) {
            if ($pet->getImages()->contains($image) === false) {
                $pet->getImages()->removeElement($image);
                $this->petImageManager->remove($image);
            }
        }
    }

}
