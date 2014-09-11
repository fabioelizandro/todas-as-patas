<?php

namespace TodasAsPatas\ApiBundle\Enum;

use ByteinCoffee\ExtraBundle\Enum\AbstractEnum;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class RoleEnum extends AbstractEnum
{

    /**
     * @var Role
     */
    public $ROLE_USER_CRUD;

    /**
     * @var Role
     */
    public $ROLE_GROUP;

    /**
     * @var Role
     */
    public $ROLE_TEXT;

    /**
     * @var Role
     */
    public $ROLE_LOCAL;

    /**
     * @var Role
     */
    public $ROLE_OAUTH;

    /**
     * @var Role
     */
    public $ROLE_API_DOCUMENTATION;

    /**
     * @var Role
     */
    public $ROLE_DASHBOARD;

    public function __construct()
    {
        $this->ROLE_API_DOCUMENTATION = new Role('ROLE_API_DOCUMENTATION', 'Documentação da API');
        $this->ROLE_GROUP = new Role('ROLE_GROUP', 'Módulo de grupos');
        $this->ROLE_LOCAL = new Role('ROLE_LOCAL', 'Módulo de localidades');
        $this->ROLE_OAUTH = new Role('ROLE_OAUTH', 'Oauth');
        $this->ROLE_TEXT = new Role('ROLE_TEXT', 'Módulo de textos');
        $this->ROLE_USER_CRUD = new Role('ROLE_USER_CRUD', 'Módulo de usuário');
        $this->ROLE_DASHBOARD = new Role('ROLE_DASHBOARD', 'Acesso as informações da dashboard');
    }

}
