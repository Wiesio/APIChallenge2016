<?php
namespace AppBundle\Riot;

use AppBundle\Entity\ChampionMastery;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;

class ChampionMasteryApi
{
    /**
     * @var ApiRequestQueueCollection
     */
    protected $requestQueues;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var array
     */
    private $platformIdMap = [
        'br' => 'br1',
        'eune' => 'eun1',
        'euw' => 'euw1',
        'jp' => 'jp1',
        'kr' => 'kr',
        'lan' => 'la1',
        'las' => 'la2',
        'na' => 'na1',
        'oce' => 'oc1',
        'tr' => 'tr1',
        'ru' => 'ru1',
        'pbe' => 'pbe1',
    ];

    public function __construct(ApiRequestQueueCollection $requestQueues, EntityManagerInterface $entityManager)
    {
        $this->requestQueues = $requestQueues;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $regionId
     * @param $playerId
     * @return Player|null
     */
    public function getMasteriesByPlayerId($regionId, $playerId)
    {
        if (!array_key_exists($regionId, $this->platformIdMap)) {
            throw new \InvalidArgumentException('Region ID (' . $regionId . ') is invalid');
        }
        $playerRepository = $this->entityManager->getRepository('AppBundle:Player');
        $player = $playerRepository->findBy(['region' => $regionId, 'summonerId' => $playerId]);
        if (!$player) {
            throw new \InvalidArgumentException('Player ID (' . $playerId . ') is invalid');
        } else {
            $player = current($player);
        }

        $url = sprintf('/championmastery/location/%s/player/%s/champions',
            $this->platformIdMap[$regionId],
            $playerId
        );
        $response = $this->requestQueues->executeRequest($regionId, $url);


        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $masteriesJsonObjects = json_decode($response->data);
        } else {
            return $response;
        }

        $result = [];
        $masteries = [];
        $championMasteryRepository = $this->entityManager->getRepository('AppBundle:ChampionMastery');
        foreach ($championMasteryRepository->findByPlayer($player) as $mastery) {
            $masteries[$mastery->getChampion()->getChampionId()] = $mastery;
        }

        $championIds = [];
        foreach ($masteriesJsonObjects as $masteryJsonObj) {
            if (isset($masteryJsonObj->championId)) {
                if (!array_key_exists($masteryJsonObj->championId, $masteries)) {
                    $championIds[] = $masteryJsonObj->championId;
                }
            }
        }
        $champions = [];
        $championRepository = $this->entityManager->getRepository('AppBundle:Champion');
        foreach ($championRepository->findBy(['region' => $regionId, 'championId' => $championIds]) as $champion) {
            $champions[$champion->getChampionId()] = $champion;
        }
        foreach ($masteriesJsonObjects as $masteryJsonObj) {
            if (isset($masteryJsonObj->championId)) {
                if (array_key_exists($masteryJsonObj->championId, $masteries)) {
                    $mastery = $masteries[$masteryJsonObj->championId];
                    unset($masteries[$masteryJsonObj->championId]);
                } else {
                    if (array_key_exists($masteryJsonObj->championId, $champions)) {
                        $champion = $champions[$masteryJsonObj->championId];
                    } else {
                        continue;
                    }
                    $mastery = new ChampionMastery();
                    $mastery->setPlayer($player)
                        ->setChampion($champion);
                    $this->entityManager->persist($mastery);
                }
                $mastery->setHighestGrade(isset($masteryJsonObj->highestGrade)
                    ? $masteryJsonObj->highestGrade : null)
                    ->setChampionPoints(isset($masteryJsonObj->championPoints)
                        ? $masteryJsonObj->championPoints : null)
                    ->setChampionPointsUntilNextLevel(isset($masteryJsonObj->championPointsUntilNextLevel)
                        ? $masteryJsonObj->championPointsUntilNextLevel : null)
                    ->setChestGranted(isset($masteryJsonObj->chestGranted)
                        ? $masteryJsonObj->chestGranted : null)
                    ->setChampionLevel(isset($masteryJsonObj->championLevel)
                        ? $masteryJsonObj->championLevel : null)
                    ->setChampionPointsSinceLastLevel(isset($masteryJsonObj->championPointsSinceLastLevel)
                        ? $masteryJsonObj->championPointsSinceLastLevel : null);
                if (isset($masteryJsonObj->lastPlayTime)) {
                    $lastPlayTime = new \DateTime();
                    $timestamp = $masteryJsonObj->lastPlayTime <= $lastPlayTime->getTimestamp()
                        ?: round($masteryJsonObj->lastPlayTime / 1000);
                    $lastPlayTime->setTimestamp($timestamp);
                    $mastery->setLastPlayTime($lastPlayTime);
                }
                $result[] = $mastery;
            }
        }
        foreach ($masteries as $mastery) {
            $this->entityManager->remove($mastery);
        }
        $this->entityManager->flush();

        return $result;
    }
}
