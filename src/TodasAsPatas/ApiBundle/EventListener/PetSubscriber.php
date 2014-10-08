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

    use \TodasAsPatas\ApiBundle\Utils\CanonicalizerTrait;

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
            'app.pet.pre_update' => array(
                array('updateImages', 5),
                array('canonicalizeName', 10)
            ),
            'app.pet.pre_create' => 'canonicalizeName'
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

    /**
     * Canonicalize Nome
     * 
     * @param ResourceEvent $event
     */
    public function canonicalizeName(ResourceEvent $event)
    {
        /* @var $pet Pet */
        $pet = $event->getSubject();
        $pet->setNameCanonical($this->canonicalize($pet->getName()));
    }

}
