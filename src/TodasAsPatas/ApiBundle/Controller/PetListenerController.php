<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use TodasAsPatas\ApiBundle\Entity\PetListener;
use TodasAsPatas\ApiBundle\Entity\UserCommon;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PetListenerController extends BaseController
{
    
    public function indexAction(Request $request)
    {
        $criteria = $this->config->getCriteria(array(
            'user' => $this->getUser()
        ));
        $sorting = $this->config->getSorting();

        $repository = $this->getRepository();

        if ($this->config->isPaginated()) {
            $resources = $this->resourceResolver->getResource(
                    $repository, 'createPaginator', array($criteria, $sorting)
            );
            $resources->setCurrentPage($request->get('page', 1), true, true);
            $resources->setMaxPerPage($this->config->getPaginationMaxPerPage());
        } else {
            $resources = $this->resourceResolver->getResource(
                    $repository, 'findBy', array($criteria, $sorting, $this->config->getLimit())
            );
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('index.html'))
                ->setTemplateVar($this->config->getPluralResourceName())
                ->setData($resources)
        ;

        if ($request->get('_format')) {
            $view->setFormat($request->get('_format'));
        }

        if ($this->getConfiguration()->getSerializationGroups() !== null) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($this->getConfiguration()->getSerializationGroups()));
        }

        return $this->handleView($view);
    }
    
    public function createNew()
    {
        /* @var $petListener PetListener */
        $petListener = parent::createNew();
        $user = $this->getUser();
        if (null === $user|| false === ($user instanceof UserCommon)) {
            throw $this->createAccessDeniedException();
        }
        
        $petListener->setUser($this->getUser());
        
        return $petListener;
    }
    
    public function findOr404(Request $request, array $criteria = array())
    {
        return parent::findOr404($request, \array_merge($criteria), array(
            'user' => $this->getUser()
        ));
    }
}
