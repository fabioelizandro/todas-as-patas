<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * GroupRepository
 */
class GroupRepository extends EntityRepository
{
    public function createNew()
    {
        $className = $this->getClassName();

        return new $className('');
    }
}
