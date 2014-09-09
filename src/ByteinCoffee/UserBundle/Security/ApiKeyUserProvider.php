<?php

namespace ByteinCoffee\UserBundle\Security;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface
{

    /**
     * @var UserManagerInterface
     */
    private $userManger;

    function __construct(UserManagerInterface $userManger)
    {
        $this->userManger = $userManger;
    }

    public function getUsernameForApiKey($apiKey)
    {
        $user = $this->userManger->findUserBy(array('apiKey' => $apiKey));

        return $user !== null? $user->getUsername() : null;
    }

    /**
     * @param stirng $username
     * 
     * @return \ByteinCoffee\UserBundle\Entity\User
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userManger->findUserByUsername($username);

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class || \is_subclass_of($class, 'Symfony\Component\Security\Core\User\User');
    }

}
