<?php

namespace TodasAsPatas\WebBundle\Controller\Api;

use TodasAsPatas\WebBundle\Api\LoaderDocumentation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class DocumentationController extends Controller
{

    public function indexAction()
    {
        $kernel = $this->get('kernel');
        /* @var $kernel KernelInterface */

        $resource = $kernel->locateResource('@TodasAsPatasWebBundle/Resources/doc/api_documentation.yml');
        $loader = $this->get("bytein_coffee_web.api_documentation.loader");
        if ($kernel->getEnvironment() !== "dev") {
            $loader = $this->get("bytein_coffee_web.api_documentation.loader_cache");
        }
        /* @var $loader LoaderDocumentation */
        if ($loader->supports($resource) !== true) {
            throw $this->createNotFoundException('Documentação não encontrada');
        }

        $doc = $loader->load($resource);

        return $this->render("TodasAsPatasWebBundle:Api/Documentation:doc.html.twig", array('doc' => $doc['doc']));
    }

}
