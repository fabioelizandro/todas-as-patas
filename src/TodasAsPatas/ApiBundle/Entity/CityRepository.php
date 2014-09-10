<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * CityRepository
 */
class CityRepository extends EntityRepository
{

    /**
     * Cria um paginador a partir de uma query de busca de cidades
     * 
     * @param string $query
     * 
     * @return Pagerfanta
     */
    public function createPaginatorByQuery($query = null)
    {
        $alias = $this->getAlias();
        $queryBuilder = $this->getCollectionQueryBuilder();

        if ($query) {
            $queryBuilder->where($queryBuilder->expr()->like($queryBuilder->expr()->lower("{$alias}.name"), ':query'));
            $queryLower = \mb_convert_case($query, MB_CASE_LOWER, mb_detect_encoding($query));
            $queryBuilder->setParameter('query', "%{$queryLower}%");
        }

        return $this->getPaginator($queryBuilder);
    }

}
