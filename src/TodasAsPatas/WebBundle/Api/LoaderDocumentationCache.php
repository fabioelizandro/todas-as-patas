<?php

namespace TodasAsPatas\WebBundle\Api;

use Doctrine\Common\Cache\Cache;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class LoaderDocumentationCache extends LoaderDocumentation
{

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(Cache $cache)
    {
        parent::__construct();
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null)
    {
        if ($this->cache->contains('api.documentation') === false) {
            $this->cache->save('api.documentation', parent::load($resource));
        }

        return $this->cache->fetch('api.documentation');
    }

}
