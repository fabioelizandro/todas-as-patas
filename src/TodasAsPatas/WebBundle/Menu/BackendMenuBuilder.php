<?php

namespace TodasAsPatas\WebBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use TodasAsPatas\ApiBundle\Entity\AdoptionRequestMessageRepository;
use TodasAsPatas\ApiBundle\Entity\QuestionMessageRepository;

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

    /**
     * @var QuestionMessageRepository
     */
    private $questionMessageRepository;

    /**
     * @var AdoptionRequestMessageRepository
     */
    private $adoptionRequestMessageRepository;

    /**
     * Construct
     */
    function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext, QuestionMessageRepository $questionMessageRepository, AdoptionRequestMessageRepository $adoptionRequestMessageRepository)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
        $this->questionMessageRepository = $questionMessageRepository;
        $this->adoptionRequestMessageRepository = $adoptionRequestMessageRepository;
    }

    /**
     * Cria o menu de navegação do backend
     * 
     * @param Request $request
     * @return ItemInterface
     */
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

        $adoptionRequestNotViewed = $this->adoptionRequestMessageRepository->countNotViewed();
        $menu->addChild('Adoção', array(
            'route' => 'app_adoptionrequestmessage_index',
            'extras' => array(
                'icon' => "fa fa-heart",
                'badge' => $adoptionRequestNotViewed
            )
        ));

        $questionMessageNotViewed = $this->questionMessageRepository->countNotViewed();
        $menu->addChild('Perguntas', array(
            'route' => 'app_questionmessage_index',
            'extras' => array(
                'icon' => "fa fa-question",
                'badge' => $questionMessageNotViewed
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

        $menu->addChild('Oauth', array(
            'route' => 'app_client_index',
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

    /**
     * Filtro de segurança
     * 
     * @param ItemInterface $menu
     * @return ItemInterface
     */
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
