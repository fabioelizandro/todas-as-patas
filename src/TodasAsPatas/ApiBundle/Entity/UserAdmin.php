<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * UserAdmin
 */
class UserAdmin extends User
{

    public function getRoles()
    {
        return \array_merge(parent::getRoles(), array('ROLE_ADMIN'));
    }

}
