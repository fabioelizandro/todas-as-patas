<?php

namespace TodasAsPatas\ApiBundle\Utils;

use LogicException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
trait UserCatcherTrait
{
    
    /**
     * @return ContainerInterface 
     */
    abstract public function getContainer();
    
    /**
      * Pega o usuaŕio do contexto de segurança
     *
     * @return mixed
     *
     * @throws LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    public function getUser()
    {
        if (!$this->getContainer()->has('security.context')) {
            throw new LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->getContainer()->get('security.context')->getToken()) {
            return;
        }

        if (!\is_object($user = $token->getUser())) {
            return;
        }

        return $user;
    }
}
