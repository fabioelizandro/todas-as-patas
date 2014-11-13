<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TodasAsPatas\ApiBundle\Entity\Text;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class TextController extends BaseController
{

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function enumAction(Request $request)
    {
        $criteria = $this->config->getCriteria();
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
                ->setData($this->resourcesToEnum($resources))
        ;

        if ($request->get('_format')) {
            $view->setFormat($request->get('_format'));
        }

        if ($this->getConfiguration()->getSerializationGroups() !== null) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($this->getConfiguration()->getSerializationGroups()));
        }

        return $this->handleView($view);
    }

    private function resourcesToEnum($resources)
    {
        /* @var $resources Text[] */
        $enum = array();
        foreach ($resources as $resource) {
            $enum[$resource->getType()->getReference()] = $resource;
        }

        return $enum;
    }

}
