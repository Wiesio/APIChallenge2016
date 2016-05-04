<?php
namespace AppBundle\Riot;

use AppBundle\Entity\MatchReference;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchListApi
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
     * @param $playerId
     * @param array $options
     * @return Player|null
     */
    public function getMatchListByPlayerId($regionId, $playerId, $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $options = $resolver->resolve($options);

        $playerRepository = $this->entityManager->getRepository('AppBundle:Player');
        $player = $playerRepository->findBy(['region' => $regionId, 'summonerId' => $playerId]);
        if (!$player) {
            throw new \InvalidArgumentException('Player ID (' . $playerId . ') is invalid');
        } else {
            $player = current($player);
        }

        $url = sprintf('/api/lol/%s/v2.2/matchlist/by-summoner/%s',
            $regionId,
            $playerId
        );
        $firstParameter = true;
        if (isset($options['championIds'])) {
            $url .= ($firstParameter ? '?' : '&') . 'championIds=' . implode(',', $options['championIds']);
            $firstParameter = false;
        }
        if (isset($options['rankedQueues'])) {
            $url .= ($firstParameter ? '?' : '&') . 'rankedQueues=' . implode(',', $options['rankedQueues']);
            $firstParameter = false;
        }
        if (isset($options['seasons'])) {
            $url .= ($firstParameter ? '?' : '&') . 'seasons=' . implode(',', $options['seasons']);
            $firstParameter = false;
        }
        if (isset($options['beginTime'])) {
            /** @var \DateTime $beginTime */
            $beginTime = $options['beginTime'];
            $url .= ($firstParameter ? '?' : '&') . 'beginTime=' . ($beginTime->getTimestamp() * 1000);
            $firstParameter = false;
        }
        if (isset($options['endTime'])) {
            /** @var \DateTime $endTime */
            $endTime = $options['endTime'];
            $url .= ($firstParameter ? '?' : '&') . 'endTime=' . ($endTime->getTimestamp() * 1000);
            $firstParameter = false;
        }
        if (array_key_exists('beginIndex', $options) && !is_null($options['beginIndex'])) {
            $url .= ($firstParameter ? '?' : '&') . 'beginIndex=' . $options['beginIndex'];
            $firstParameter = false;
        }
        if (array_key_exists('endIndex', $options) && !is_null($options['endIndex'])) {
            $url .= ($firstParameter ? '?' : '&') . 'endIndex=' . $options['endIndex'];
        }

        $response = $this->requestQueues->executeRequest($regionId, $url);
        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $matchListJsonObject = json_decode($response->data);
        } else {
            return $response;
        }

        $result = [];
        if (isset($matchListJsonObject->matches) && is_array($matchListJsonObject->matches)) {
            $championIds = [];
            $matchIds = [];
            $matchesJsonObject = $matchListJsonObject->matches;
            foreach ($matchesJsonObject as $matchJsonObj) {
                if (isset($matchJsonObj->champion) && isset($matchJsonObj->matchId)) {
                    $championIds[] = $matchJsonObj->champion;
                    $matchIds[] = $matchJsonObj->matchId;
                }
            }
            $matchReferences = [];
            $matchReferenceRepository = $this->entityManager->getRepository('AppBundle:MatchReference');
            foreach ($matchReferenceRepository->findBy([
                'matchId' => $matchIds,
                'region' => $regionId,
                'player' => $player,
            ]) as $matchReference) {
                $matchReferences[$matchReference->getMatchId()] = $matchReference;
            }
            $champions = [];
            $championRepository = $this->entityManager->getRepository('AppBundle:Champion');
            foreach ($championRepository->findBy(['region' => $regionId, 'championId' => $championIds]) as $champion) {
                $champions[$champion->getChampionId()] = $champion;
            }
            foreach ($matchListJsonObject->matches as $matchJsonObj) {
                if (isset($matchJsonObj->champion) && isset($matchJsonObj->matchId)) {
                    if (array_key_exists($matchJsonObj->matchId, $matchReferences)) {
                        $matchReference = $matchReferences[$matchJsonObj->matchId];
                        unset($matchReferences[$matchJsonObj->matchId]);
                    } else {
                        $matchReference = new MatchReference();
                        $matchReference->setRegion($regionId)
                            ->setPlayer($player)
                            ->setChampion($champions[$matchJsonObj->champion]);
                        $this->entityManager->persist($matchReference);
                        $matchDetailRepository = $this->entityManager
                            ->getRepository('AppBundle:MatchDetail');
                        $matchDetail = $matchDetailRepository->findByRegionMatchIdAndPlayer($regionId,
                            $matchJsonObj->matchId, $player);
                        $matchReference->setMatchDetail($matchDetail);
                    }
                    $matchReference->setMatchId(isset($matchJsonObj->matchId)
                        ? $matchJsonObj->matchId : null)
                        ->setLane(isset($matchJsonObj->lane)
                            ? $matchJsonObj->lane : null)
                        ->setPlatformId(isset($matchJsonObj->platformId)
                            ? $matchJsonObj->platformId : null)
                        ->setQueueType(isset($matchJsonObj->queue)
                            ? $matchJsonObj->queue : null)
                        ->setRole(isset($matchJsonObj->role)
                            ? $matchJsonObj->role : null)
                        ->setSeason(isset($matchJsonObj->season)
                            ? $matchJsonObj->season : null);
                    if (isset($matchJsonObj->timestamp)) {
                        $matchFinish = new \DateTime();
                        $timestamp = $matchJsonObj->timestamp <= $matchFinish->getTimestamp()
                            ?: round($matchJsonObj->timestamp / 1000);
                        $matchFinish->setTimestamp($timestamp);
                        $matchReference->setMatchFinish($matchFinish);
                    }
                    $result[] = $matchReference;
                }
            }
            $this->entityManager->flush();
        }

        return $result;
    }

    private function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'championIds' => [],
            'rankedQueues' => [],
            'seasons' => [],
            'beginTime' => new \DateTime('2010-01-01 00:00:00+00:00'),
            'endTime' => new \DateTime(),
            'beginIndex' => 0,
            'endIndex' => PHP_INT_MAX,
        ));
        $resolver->setAllowedTypes('championIds', 'array');
        $resolver->setAllowedTypes('rankedQueues', 'array');
        $resolver->setAllowedTypes('seasons', 'array');
        $resolver->setAllowedTypes('beginTime', '\DateTime');
        $resolver->setAllowedTypes('endTime', '\DateTime');
        $resolver->setAllowedTypes('beginIndex', 'int');
        $resolver->setAllowedTypes('endIndex', 'int');
    }
}
