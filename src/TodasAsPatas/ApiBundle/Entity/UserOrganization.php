<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * UserOrganization
 */
class UserOrganization extends User
{

    /**
     * @var Organization
     */
    private $organization;

    /**
     * Set organization
     *
     * @param Organization $organization
     * @return UserOrganization
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Get Roles
     * 
     * @return array
     */
    public function getRoles()
    {
        return \array_merge(parent::getRoles(), array('ROLE_ORGANIZATION'));
    }

}
