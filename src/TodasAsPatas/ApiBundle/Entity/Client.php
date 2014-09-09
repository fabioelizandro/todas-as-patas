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

}
