<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use TodasAsPatas\ApiBundle\Entity\QuestionMessage;
use TodasAsPatas\ApiBundle\Entity\UserCommon;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class QuestionMessageController extends BaseController
{
    public function createNew()
    {
        /* @var $question QuestionMessage */
        $question = parent::createNew();
        $user = $this->getUser();
        if (null === $user|| false === ($user instanceof UserCommon)) {
            throw $this->createAccessDeniedException();
        }
        
        $question->setUser($this->getUser());
        
        return $question;
    }
    
    public function findOr404(\Symfony\Component\HttpFoundation\Request $request, array $criteria = array())
    {
        return parent::findOr404($request, array_merge($criteria), array(
            'user' => $this->getUser()
        ));
    }
}
