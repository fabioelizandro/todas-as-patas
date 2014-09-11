<?php

namespace TodasAsPatas\ApiBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use TodasAsPatas\ApiBundle\Enum\Role;
use TodasAsPatas\ApiBundle\Enum\RoleEnum;

/**
 * Group
 */
class Group extends BaseGroup
{

    /**
     * Retorna as roles como enumeração
     * 
     * @return Role[]
     */
    public function getRolesAsObject()
    {
        $roles = array();
        foreach ($this->getRoles() as $role) {
            if (RoleEnum::getInstance()->getItem($role)) {
                $roles[] = RoleEnum::getInstance()->getItem($role);
            }
        }

        return $roles;
    }

    /**
     * ToString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}
