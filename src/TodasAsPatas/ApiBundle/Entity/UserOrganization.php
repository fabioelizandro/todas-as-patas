<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * UserOrganization
 */
class UserOrganization extends User
{

    /**
     * Get Username
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Set Email
     * 
     * @param string $email
     * @return string
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        return parent::setEmail($email);
    }

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
