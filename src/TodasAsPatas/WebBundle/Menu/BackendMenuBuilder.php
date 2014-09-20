<?php

namespace TodasAsPatas\WebBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Builder dos menus do backend
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class BackendMenuBuilder
{

    /**
     * @var FactoryInterface 
     */
    private $factory;

    /**
     * @var SecurityContextInterface
     */
    private $securityContext;

    function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Dashboard', array(
            'route' => 'todasaspatas_web_backend_home',
            'extras' => array(
                'icon' => "fa fa-dashboard"
            )
        ));

        $menu->addChild('Pet', array(
            'route' => 'app_pet_index',
            'extras' => array(
                'icon' => "fa fa-paw",
            )
        ));

        $menu->addChild('Raça', array(
            'route' => 'app_breed_index',
            'extras' => array(
                'icon' => "fa fa-tags",
            )
        ));

        $menu->addChild('Organizações', array(
            'route' => 'app_organization_index',
            'extras' => array(
                'icon' => "fa fa-briefcase",
            )
        ));

        $menu->addChild('Usuário', array(
            'route' => 'app_useradmin_index',
            'extras' => array(
                'icon' => "fa fa-user",
            )
        ));

        $menu->addChild('Grupo', array(
            'route' => 'app_group_index',
            'extras' => array(
                'icon' => "fa fa-group"
            )
        ));

        $menu->addChild('Textos', array(
            'route' => 'app_text_index',
            'extras' => array(
                'icon' => "fa fa-edit"
            )
        ));

        $menu->addChild('Locais', array(
            'route' => 'app_country_index',
            'extras' => array(
                'icon' => "fa fa-globe"
            )
        ));

        $menu->addChild('API', array(
            'route' => 'app_api_documentation',
            'extras' => array(
                'icon' => "fa fa-folder-open"
            )
        ));

        return $this->removeUnauthorized($menu);
    }

    private function removeUnauthorized(ItemInterface $menu)
    {
        /* @var $item ItemInterface */
        $items = $menu->getChildren();
        foreach ($items as $item) {
            if (null === $item->getExtra('roles')) {
                continue;
            }
            if (!$this->securityContext->isGranted($item->getExtra('roles'))) {
                $menu->removeChild($item->getName());
            }
        }

        return $menu;
    }

}
