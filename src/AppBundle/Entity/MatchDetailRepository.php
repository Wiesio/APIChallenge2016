<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MatchDetailRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchDetailRepository extends EntityRepository
{
    /**
     * @param $regionId
     * @param $matchId
     * @param Player $player
     * @return MatchDetail|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByRegionMatchIdAndPlayer($regionId, $matchId, Player $player)
    {
        $queryBuilder = $this->createQueryBuilder('matchDetail');
        $queryBuilder->leftJoin('matchDetail.participants', 'participant')
            ->where('matchDetail.region = :region')
            ->setParameter('region', $regionId)
            ->andWhere('matchDetail.matchId = :matchId')
            ->setParameter('matchId', $matchId)
            ->andWhere('participant.player = :player')
            ->setParameter('player', $player)
            ->setMaxResults(1);
        $query = $queryBuilder->getQuery();

        return $query->getOneOrNullResult();
    }


    /**
     * @param string $firstPlayerKey
     * @param string $secondPlayerKey
     * @param $isSecondPlayerAlly
     * @param string $outcome
     * @param \DateTime $from
     * @return Champion[]
     */
    public function getMatchStatistics($firstPlayerKey, $secondPlayerKey, $isSecondPlayerAlly, $outcome, \DateTime $from = null)
    {
        if (!$from) {
            $from = new \DateTime();
            $from->sub(new \DateInterval('P7D'));
            $from->setTime(0, 0, 0);
        }

        $queryBuilder = $this->createQueryBuilder('matchDetail');
        $queryBuilder->select('COUNT(matchDetail.id)')
            ->leftJoin('matchDetail.teams', 'team')
            ->leftJoin('matchDetail.participants', 'firstPlayer')
            ->leftJoin('firstPlayer.champion', 'firstPlayerChampion')
            ->leftJoin('matchDetail.participants', 'secondPlayer')
            ->leftJoin('secondPlayer.champion', 'secondPlayerChampion')
            ->andWhere('team.teamId = firstPlayer.teamId')
            ->andWhere('firstPlayerChampion.key = :firstPlayerKey')
            ->setParameter('firstPlayerKey', $firstPlayerKey)
            ->andWhere('secondPlayerChampion.key = :secondPlayerKey')
            ->setParameter('secondPlayerKey', $secondPlayerKey)
            ->andWhere('team.winner = :outcome')
            ->setParameter('outcome', $outcome)
            ->andWhere('matchDetail.matchCreation >= :from')
            ->setParameter('from', $from);
        if ($isSecondPlayerAlly) {
            $queryBuilder->andWhere('firstPlayer.teamId = secondPlayer.teamId');
        } else {
            $queryBuilder->andWhere('firstPlayer.teamId != secondPlayer.teamId');
        }
        $query = $queryBuilder->getQuery();

        return $query->getSingleScalarResult();
    }
}