<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use TodasAsPatas\ApiBundle\Entity\AbstractMessage;
use TodasAsPatas\ApiBundle\Entity\UserCommon;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
abstract class AbstractMessageController extends BaseController
{
    public function createNew()
    {
        /* @var $message AbstractMessage */
        $message = parent::createNew();
        $user = $this->getUser();
        if (null === $user|| false === ($user instanceof UserCommon)) {
            throw $this->createAccessDeniedException();
        }
        
        $message->setUser($this->getUser());
        
        return $message;
    }
    
    public function findOr404(Request $request, array $criteria = array())
    {
        return parent::findOr404($request, \array_merge($criteria), array(
            'user' => $this->getUser()
        ));
    }
}
