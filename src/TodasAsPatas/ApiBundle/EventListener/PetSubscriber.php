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
class PetSubscriber implements EventSubscriberInterface
{

    /**
     * @var \TodasAsPatas\ApiBundle\Entity\PetImageRepository
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
    function __construct(\TodasAsPatas\ApiBundle\Entity\PetRepository $stateRepository, ObjectManager $om)
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
        /* @var $pet \TodasAsPatas\ApiBundle\Entity\Pet */
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
