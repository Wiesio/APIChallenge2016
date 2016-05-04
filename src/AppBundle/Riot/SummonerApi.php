<?php
namespace AppBundle\Riot;

use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;

class SummonerApi
{
    /**
     * @var ApiRequestQueueCollection
     */
    protected $requestQueues;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(ApiRequestQueueCollection $requestQueues, EntityManagerInterface $entityManager)
    {
        $this->requestQueues = $requestQueues;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $regionId
     * @param $summonerNames
     * @return Player[]|null
     */
    public function getSummonersByNames($regionId, $summonerNames = [])
    {
        $summonerNames = array_slice($summonerNames, 0, 40);
        $url = sprintf('/api/lol/%s/v1.4/summoner/by-name/%s',
            $regionId,
            implode(',', $summonerNames)
        );
        $response = $this->requestQueues->executeRequest($regionId, $url);

        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $playerJsonObjects = json_decode($response->data);
        } else {
            return $response;
        }
        
        $players = [];
        $playerRepository = $this->entityManager->getRepository('AppBundle:Player');
        foreach ($playerRepository->findBy(['region' => $regionId, 'summonerName' => $summonerNames]) as $player) {
            $players[$player->getSummonerId()] = $player;
        }

        return $this->updatePlayers($players, $playerJsonObjects, $regionId);
    }

    /**
     * @param $regionId
     * @param $summonerIds
     * @return Player[]|null
     */
    public function getSummonersByIds($regionId, $summonerIds = [])
    {
        $summonerIds = array_slice($summonerIds, 0, 40);
        $url = sprintf('/api/lol/%s/v1.4/summoner/%s',
            $regionId,
            implode(',', $summonerIds)
        );
        $response = $this->requestQueues->executeRequest($regionId, $url);
        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $playerJsonObjects = json_decode($response->data);
        } else {
            return $response;
        }

        $players = [];
        $playerRepository = $this->entityManager->getRepository('AppBundle:Player');
        foreach ($playerRepository->findBy(['region' => $regionId, 'summonerId' => $summonerIds]) as $player) {
            $players[$player->getSummonerId()] = $player;
        }

        return $this->updatePlayers($players, $playerJsonObjects, $regionId);
    }

    /**
     * @param $players Player[] Players found in database
     * @param $playerJsonObjects object API response
     * @param $regionId string Region ID
     * @return Player[]
     */
    private function updatePlayers($players, $playerJsonObjects, $regionId)
    {
        $result = [];
        foreach ($playerJsonObjects as $playerJsonObj) {
            if (isset($playerJsonObj->id)) {
                if (array_key_exists($playerJsonObj->id, $players)) {
                    $player = $players[$playerJsonObj->id];
                    unset($players[$playerJsonObj->id]);
                } else {
                    $player = new Player();
                    $player->setSummonerId($playerJsonObj->id)
                        ->setRegion($regionId);
                    $this->entityManager->persist($player);
                }
                $player->setSummonerName(isset($playerJsonObj->name)
                    ? $playerJsonObj->name : null)
                    ->setProfileIcon(isset($playerJsonObj->profileIconId)
                        ? $playerJsonObj->profileIconId : null)
                    ->setSummonerLevel(isset($playerJsonObj->summonerLevel)
                        ? $playerJsonObj->summonerLevel : null);
                if (isset($playerJsonObj->revisionDate)) {
                    $revisionDate = new \DateTime();
                    $timestamp = $playerJsonObj->revisionDate <= $revisionDate->getTimestamp()
                        ?: round($playerJsonObj->revisionDate / 1000);
                    $revisionDate->setTimestamp($timestamp);
                    $player->setRevisionDate($revisionDate);
                }
                $result[] = $player;
            }
        }
        $this->entityManager->flush();

        return $result;
    }

}