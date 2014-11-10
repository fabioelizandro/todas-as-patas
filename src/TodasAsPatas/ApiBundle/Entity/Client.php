<?php

namespace TodasAsPatas\ApiBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * Client Oauth
 */
class Client extends BaseClient
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $owner;

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->owner = false;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set owner
     *
     * @param boolean $owner
     * @return Client
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return boolean 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Is owner
     *
     * @return boolean 
     */
    public function isOwner()
    {
        return $this->getOwner();
    }

}
