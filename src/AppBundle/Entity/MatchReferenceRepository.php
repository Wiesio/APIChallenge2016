<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MatchReferenceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchReferenceRepository extends EntityRepository
{
    /**
     * @param $regionId
     * @return MatchReference|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getLatestEmptyReference($regionId)
    {
        $queryBuilder = $this->createQueryBuilder('matchReference');
        $queryBuilder->where('matchReference.matchDetail IS NULL')
            ->andWhere('matchReference.region = :region')
            ->setParameter('region', $regionId)
            ->orderBy('matchReference.matchFinish', 'DESC')
            ->setMaxResults(1);
        $query = $queryBuilder->getQuery();

        return $query->getOneOrNullResult();
    }
}
