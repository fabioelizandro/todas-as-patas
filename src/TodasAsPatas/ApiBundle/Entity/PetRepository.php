<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * PetRepository
 */
class PetRepository extends EntityRepository
{

    use \TodasAsPatas\ApiBundle\Utils\CanonicalizerTrait;

    /**
     * Cria paginador com filtros
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param string $queryTerm termo de busca
     * 
     * @return Pagerfanta
     */
    public function createPaginatorByFilter(array $criteria = null, array $orderBy = null, $queryTerm = null)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();

        if ($queryTerm) {
            $queryBuilder
                    ->where($queryBuilder->expr()->like('pet.nameCanonical', ':query'))
                    ->setParameter('query', "%{$this->canonicalize($queryTerm)}%");
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
