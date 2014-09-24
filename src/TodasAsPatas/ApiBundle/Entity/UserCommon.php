<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * UserCommon
 */
class UserCommon extends User
{

    public function getRoles()
    {
        return \array_merge(parent::getRoles(), array('ROLE_USER_COMMON'));
    }

}
