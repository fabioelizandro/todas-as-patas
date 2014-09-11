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

        $menu->addChild('Home', array(
            'route' => 'todasaspatas_web_backend_home',
            'extras' => array(
                'icon' => "icon-home"
            )
        ));

        $menu->addChild('Usuário', array(
            'route' => 'app_useradmin_index',
            'extras' => array(
                'icon' => "icon-user",
            )
        ));

        $menu->addChild('Grupo', array(
            'route' => 'app_group_index',
            'extras' => array(
                'icon' => "icon-group"
            )
        ));

        $menu->addChild('Textos', array(
            'route' => 'app_text_index',
            'extras' => array(
                'icon' => "icon-edit"
            )
        ));

        $menu->addChild('Locais', array(
            'route' => 'app_country_index',
            'extras' => array(
                'icon' => "icon-globe"
            )
        ));

        $menu->addChild('API', array(
            'route' => 'app_api_documentation',
            'extras' => array(
                'icon' => "icon-folder-open"
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
