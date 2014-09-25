<?php

namespace TodasAsPatas\ApiBundle\Entity;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * AbstractMessageRepository
 */
class AbstractMessageRepository extends EntityRepository
{

    /**
     * Retorna a quantidade de registros que não foram visualizados ainda
     */
    public function countNotViewed()
    {
        return $this->count(array('viewed' => false));
    }

    /**
     * Retorna a quantidade de registros criados no período
     *
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     */
    public function count(array $criteria = array(), \DateTime $dateStart = null, \DateTime $dateEnd = null)
    {
        $alias = $this->getAlias();
        $queryBuilder = $this->createQueryBuilder($alias);
        $queryBuilder->select("COUNT({$alias}.id)");

        if ($dateStart !== null) {
            $queryBuilder
                    ->andWhere($queryBuilder->expr()->gte($alias . '.createdAt', ':dateStart'))
                    ->setParameter('dateStart', $dateStart);
        }

        if ($dateEnd !== null) {
            $queryBuilder
                    ->andWhere($queryBuilder->expr()->lte($alias . '.createdAt', ':dateEnd'))
                    ->setParameter('dateEnd', $dateEnd);
        }

        $this->applyCriteria($queryBuilder, $criteria);

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

}
