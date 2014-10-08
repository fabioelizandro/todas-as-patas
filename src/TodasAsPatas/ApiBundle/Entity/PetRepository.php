<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * PetRepository
 */
class PetRepository extends EntityRepository
{

    /**
     * Cria paginador com filtros
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param string $query termo de busca
     * 
     * @return Pagerfanta
     */
    public function createPaginatorByFilter(array $criteria = null, array $orderBy = null, $query = null)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();

        if ($query) {
            $queryBuilder
                    ->where($queryBuilder->expr()->like('pet.name', ':query'))
                    ->setParameter('query', "%{$query}%");
        }

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $orderBy);

        return $this->getPaginator($queryBuilder);
    }

    /**
     * {@inheritance}
     */
    protected function getAlias()
    {
        return 'pet';
    }

}
