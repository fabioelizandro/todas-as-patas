<?php

namespace TodasAsPatas\ApiBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use TodasAsPatas\ApiBundle\Entity\Organization;
use TodasAsPatas\ApiBundle\Entity\UserOrganizationRepository;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class OrganizationSubscriber implements EventSubscriberInterface
{

    /**
     * @var UserOrganizationRepository
     */
    private $userOrganizationRepository;

    /**
     *
     * @var ObjectManager
     */
    private $userOrganizationManager;

    /**
     * Construct
     */
    function __construct(UserOrganizationRepository $userOrganizationRepository, ObjectManager $om)
    {
        $this->userOrganizationRepository = $userOrganizationRepository;
        $this->userOrganizationManager = $om;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'app.organization.pre_update' => 'updateUsers'
        );
    }

    /**
     * Atualiza a lista de usuários
     * 
     * @param ResourceEvent $event
     */
    public function updateUsers(ResourceEvent $event)
    {
        /* @var $organization Organization */
        $organization = $event->getSubject();

        $originalUsers = $this->userOrganizationRepository->findBy(array('organization' => $organization));

        foreach ($originalUsers as $user) {
            if ($organization->getUsers()->contains($user) === false) {
                $organization->getUsers()->removeElement($user);
                $this->userOrganizationManager->remove($user);
            }
        }
    }

}
