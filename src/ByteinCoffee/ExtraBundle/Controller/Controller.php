<?php

namespace ByteinCoffee\ExtraBundle\Controller;

use ByteinCoffee\ExtraBundle\Sylius\Configuration;
use JMS\Serializer\SerializationContext;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controlador base 
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class Controller extends ResourceController
{

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function showAction(Request $request)
    {
        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('show.html'))
                ->setTemplateVar($this->config->getResourceName())
                ->setData($this->findOr404($request))
        ;
        
        if ($request->get('_format')) {
            $view->setFormat($request->get('_format'));
        }
        
        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
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

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $resource = $this->createNew();
        $form = $this->createCreateForm($resource);

        if ($request->isMethod('POST') && $form->submit($request)->isValid()) {
            $resource = $this->domainManager->create($resource);

            if (null === $resource) {
                return $this->redirectHandler->redirectToIndex();
            }

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($resource));
            }

            return $this->redirectHandler->redirectTo($resource);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('create.html'))
                ->setData(array(
            $this->config->getResourceName() => $resource,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Request $request)
    {
        $resource = $this->findOr404($request);
        $form = $this->createUpdateForm($resource);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->submit($request)->isValid()) {
            $this->domainManager->update($resource);

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($resource));
            }

            return $this->redirectHandler->redirectTo($resource);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('update.html'))
                ->setData(array(
            $this->config->getResourceName() => $resource,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * @param object|null $resource
     *
     * @return FormInterface
     */
    protected function createCreateForm($resource = null)
    {
        $form = $this->createForm($this->config->getFormType(), $resource, array(
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * @param object|null $resource
     *
     * @return FormInterface
     */
    protected function createUpdateForm($resource = null)
    {
        $form = $this->createForm($this->config->getFormType(), $resource, array(
            'method' => 'PUT'
        ));

        return $form;
    }

    /**
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $resource = $this->findOr404($request);
        $this->domainManager->delete($resource);

        if ($this->config->isApiRequest()) {
            $view = $this
                    ->view()
                    ->setTemplate($this->config->getTemplate('delete.html'))
                    ->setTemplateVar($this->config->getResourceName())
                    ->setData(array('message' => 'deletado com sucesso'))
            ;

            return $this->handleView($view);
        }

        return $this->redirectHandler->redirectToIndex();
    }

    /**
     * Retorna o novo tipo de configuração
     * 
     * @return Configuration
     */
    public function getConfiguration()
    {
        return parent::getConfiguration();
    }

}
