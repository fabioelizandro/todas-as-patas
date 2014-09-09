<?php

namespace TodasAsPatas\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Área de trabalho do administrador
 *
 * @author Fábio Lemos Elizandro
 */
class HomeController extends Controller
{

    public function indexAction()
    {
        return $this->render('TodasAsPatasWebBundle:Backend/Home:home.html.twig');
    }

}
