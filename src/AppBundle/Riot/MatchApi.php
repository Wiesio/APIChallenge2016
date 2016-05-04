<?php
namespace AppBundle\Riot;

use AppBundle\Entity\BannedChampion;
use AppBundle\Entity\Event;
use AppBundle\Entity\Frame;
use AppBundle\Entity\Mastery;
use AppBundle\Entity\MatchDetail;
use AppBundle\Entity\MatchReference;
use AppBundle\Entity\Participant;
use AppBundle\Entity\ParticipantFrame;
use AppBundle\Entity\ParticipantStats;
use AppBundle\Entity\ParticipantTimeline;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use AppBundle\Entity\Rune;
use AppBundle\Entity\Team;
use AppBundle\Entity\Timeline;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Debug\Exception\ClassNotFoundException;

class MatchApi
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
     * @param $matchId
     * @param bool $includeTimeline
     * @return MatchDetail|null
     */
    public function getMatch($regionId, $matchId, $includeTimeline = false)
    {
        $matchDetailRepository = $this->entityManager->getRepository('AppBundle:MatchDetail');
        $matchDetail = $matchDetailRepository->findBy([
            'region' => $regionId,
            'matchId' => $matchId,
        ]);
        if ($matchDetail) {
            return $matchDetail;
        }

        $url = sprintf('/api/lol/%s/v2.2/match/%s?includeTimeline=%s',
            $regionId,
            $matchId,
            $includeTimeline ? 'true' : 'false'
        );
        $response = $this->requestQueues->executeRequest($regionId, $url);

        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $matchDetailsJsonObj = json_decode($response->data);
        } else {
            return $response;
        }

        $matchDetail = new MatchDetail();
        $matchDetail->setMatchId($matchId)
            ->setRegion($regionId);

        if (isset($matchDetailsJsonObj->matchCreation)) {
            $creationDateTime = new \DateTime();
            $timestamp = $matchDetailsJsonObj->matchCreation <= $creationDateTime->getTimestamp()
                ?: round($matchDetailsJsonObj->matchCreation / 1000);
            $creationDateTime->setTimestamp($timestamp);
            $matchDetail->setMatchCreation($creationDateTime);
        }
        $matchDetail
            ->setMatchDuration(isset($matchDetailsJsonObj->matchDuration) ? $matchDetailsJsonObj->matchDuration : null)
            ->setMatchMode(isset($matchDetailsJsonObj->matchMode) ? $matchDetailsJsonObj->matchMode : null)
            ->setMatchType(isset($matchDetailsJsonObj->matchType) ? $matchDetailsJsonObj->matchType : null)
            ->setMatchVersion(isset($matchDetailsJsonObj->matchVersion) ? $matchDetailsJsonObj->matchVersion : null)
            ->setPlatformId(isset($matchDetailsJsonObj->platformId) ? $matchDetailsJsonObj->platformId : null)
            ->setQueueType(isset($matchDetailsJsonObj->queueType) ? $matchDetailsJsonObj->queueType : null)
            ->setSeason(isset($matchDetailsJsonObj->season) ? $matchDetailsJsonObj->season : null);
        if (isset($matchDetailsJsonObj->participants) && is_array($matchDetailsJsonObj->participants)) {
            $playerRepository = $this->entityManager->getRepository('AppBundle:Player');
            foreach ($matchDetailsJsonObj->participants as $participantJsonObj) {
                $participant = new Participant();
                $participant
                    ->setChampionId(isset($participantJsonObj->championId) ? $participantJsonObj->championId : null)
                    ->setHighestAchievedSeasonTier(isset($participantJsonObj->highestAchievedSeasonTier)
                        ? $participantJsonObj->highestAchievedSeasonTier : null)
                    ->setParticipantId(isset($participantJsonObj->participantId)
                        ? $participantJsonObj->participantId : null)
                    ->setSpell1Id(isset($participantJsonObj->spell1Id) ? $participantJsonObj->spell1Id : null)
                    ->setSpell2Id(isset($participantJsonObj->spell2Id) ? $participantJsonObj->spell2Id : null)
                    ->setTeamId(isset($participantJsonObj->teamId) ? $participantJsonObj->spell2Id : null);

                if (isset($participantJsonObj->masteries) && is_array($participantJsonObj->masteries)) {
                    foreach ($participantJsonObj->masteries as $masteryJsonObj) {
                        $mastery = new Mastery();
                        $mastery->setMasteryId(isset($masteryJsonObj->masteryId) ? $masteryJsonObj->masteryId : null)
                            ->setRank(isset($masteryJsonObj->rank) ? $masteryJsonObj->rank : null);
                        $participant->addMastery($mastery);
                    }
                }

                if (isset($participantJsonObj->runes) && is_array($participantJsonObj->runes)) {
                    foreach ($participantJsonObj->runes as $runeJsonObj) {
                        $rune = new Rune();
                        $rune->setRuneId(isset($runeJsonObj->runeId) ? $runeJsonObj->runeId : null)
                            ->setRank(isset($runeJsonObj->rank) ? $runeJsonObj->rank : null);
                        $participant->addRune($rune);
                    }
                }

                if (isset($participantJsonObj->timeline)) {
                    $timelineJsonObj = $participantJsonObj->timeline;
                    $timeline = new ParticipantTimeline();
                    $timeline->setLane(isset($timelineJsonObj->lane) ? $timelineJsonObj->lane : null)
                        ->setRole(isset($timelineJsonObj->role) ? $timelineJsonObj->role : null);
                    unset($timelineJsonObj->lane, $timelineJsonObj->role);
                    foreach ($timelineJsonObj as $dataType => $dataValues) {
                        $className = ucfirst($dataType);
                        $classPath = 'AppBundle\\Entity\\' . $className;
                        try {
                            /** @var ParticipantTimelineData $participantTimelineData */
                            $participantTimelineData = new $classPath();
                            $participantTimelineData
                                ->setZeroToTen(isset($dataValues->zeroToTen) ? $dataValues->zeroToTen : null)
                                ->setTenToTwenty(isset($dataValues->tenToTwenty) ? $dataValues->tenToTwenty : null)
                                ->setTwentyToThirty(isset($dataValues->twentyToThirty) ? $dataValues->twentyToThirty : null)
                                ->setThirtyToEnd(isset($dataValues->thirtyToEnd) ? $dataValues->thirtyToEnd : null);
                            $setterName = 'set' . $className;
                            $timeline->$setterName($participantTimelineData);
                            $this->entityManager->persist($participantTimelineData);
                        } catch (ClassNotFoundException $e) {
                            dump($e);
                        }
                    }
                    $participant->setParticipantTimeline($timeline);
                }

                if (isset($participantJsonObj->stats)) {
                    $participantStatsJsonObj = $participantJsonObj->stats;
                    $participantStats = new ParticipantStats();
                    foreach ($participantStatsJsonObj as $propertyName => $propertyValue) {
                        try {
                            $setterName = 'set' . ucfirst($propertyName);
                            $participantStats->$setterName($propertyValue);
                        } catch (\BadMethodCallException $e) {
                            dump($e);
                        }
                    }
                    $participant->setParticipantStats($participantStats);
                }

                if (isset($matchDetailsJsonObj->participantIdentities)
                    && is_array($matchDetailsJsonObj->participantIdentities)
                ) {
                    foreach ($matchDetailsJsonObj->participantIdentities as $participantIdentity) {
                        if (isset($participantIdentity->participantId)
                            && isset($participantIdentity->player)
                            && isset($participantIdentity->player->summonerId)
                            && $participantIdentity->participantId == $participant->getParticipantId()
                        ) {
                            $player = $playerRepository->findBy([
                                'region' => $regionId,
                                'summonerId' => $participantIdentity->player->summonerId,
                            ]);
                            if (!$player) {
                                $playerJsonObj = $participantIdentity->player;
                                $player = new Player();
                                $player->setSummonerId($playerJsonObj->summonerId)
                                    ->setRegion($regionId)
                                    ->setMatchHistoryUri(isset($playerJsonObj->matchHistoryUri)
                                        ? $playerJsonObj->matchHistoryUri : null)
                                    ->setProfileIcon(isset($playerJsonObj->profileIcon)
                                        ? $playerJsonObj->profileIcon : null)
                                    ->setSummonerName(isset($playerJsonObj->summonerName)
                                        ? $playerJsonObj->summonerName : null);
                            } else {
                                $player = current($player);
                                $matchReferenceRepository = $this->entityManager
                                    ->getRepository('AppBundle:MatchReference');
                                $matchReference = $matchReferenceRepository->findBy([
                                    'region' => $regionId,
                                    'player' => $player,
                                    'matchId' => $matchId,
                                ]);
                                if ($matchReference) {
                                    $matchDetail->addMatchReference(current($matchReference));
                                }
                            }
                            $participant->setPlayer($player);
                            break;
                        }
                    }
                }

                $matchDetail->addParticipant($participant);
            }
        }

        if (isset($matchDetailsJsonObj->teams) && is_array($matchDetailsJsonObj->teams)) {
            foreach ($matchDetailsJsonObj->teams as $teamJsonObj) {
                $team = new Team();
                $team->setBaronKills(isset($teamJsonObj->baronKills) ? $teamJsonObj->baronKills : null)
                    ->setDominionVictoryScore(isset($teamJsonObj->dominionVictoryScore)
                        ? $teamJsonObj->dominionVictoryScore : null)
                    ->setDragonKills(isset($teamJsonObj->dragonKills) ? $teamJsonObj->dragonKills : null)
                    ->setFirstBaron(isset($teamJsonObj->firstBaron) ? $teamJsonObj->firstBaron : null)
                    ->setFirstBlood(isset($teamJsonObj->firstBlood) ? $teamJsonObj->firstBlood : null)
                    ->setFirstDragon(isset($teamJsonObj->firstDragon) ? $teamJsonObj->firstDragon : null)
                    ->setFirstInhibitor(isset($teamJsonObj->firstInhibitor) ? $teamJsonObj->firstInhibitor : null)
                    ->setFirstTower(isset($teamJsonObj->firstTower) ? $teamJsonObj->firstTower : null)
                    ->setInhibitorKills(isset($teamJsonObj->inhibitorKills) ? $teamJsonObj->inhibitorKills : null)
                    ->setTeamId(isset($teamJsonObj->teamId) ? $teamJsonObj->teamId : null)
                    ->setTowerKills(isset($teamJsonObj->towerKills) ? $teamJsonObj->towerKills : null)
                    ->setVilemawKills(isset($teamJsonObj->vilemawKills) ? $teamJsonObj->vilemawKills : null)
                    ->setWinner(isset($teamJsonObj->winner) ? $teamJsonObj->winner : null);
                if (isset($teamJsonObj->bans) && is_array($teamJsonObj->bans)) {
                    foreach ($teamJsonObj->bans as $bannedChampionJsonObj) {
                        $bannedChampion = new BannedChampion();
                        $bannedChampion->setChampionId(isset($bannedChampionJsonObj->championId)
                            ? $bannedChampionJsonObj->championId : null)
                            ->setPickTurn(isset($bannedChampionJsonObj->pickTurn)
                                ? $bannedChampionJsonObj->pickTurn : null);
                        $team->addBannedChampion($bannedChampion);
                    }
                }
                $matchDetail->addTeam($team);
            }
        }

        if (isset($matchDetailsJsonObj->timeline)) {
            $timelineJsonObj = $matchDetailsJsonObj->timeline;
            $timeline = new Timeline();
            $timeline->setFrameInterval(isset($timelineJsonObj->frameInterval)
                ? $timelineJsonObj->frameInterval : null);
            if (isset($timelineJsonObj->frames) && is_array($timelineJsonObj->frames)) {
                foreach ($timelineJsonObj->frames as $frameJsonObj) {
                    $frame = new Frame();
                    $frame->setTimestamp(isset($frameJsonObj->timestamp) ? $frameJsonObj->timestamp : null);
                    if (isset($frameJsonObj->participantFrames) && is_array($frameJsonObj->participantFrames)) {
                        foreach ($frameJsonObj->participantFrames as $participantFrameJsonObj) {
                            $participantFrame = new ParticipantFrame();
                            $participantFrame->setCurrentGold(isset($participantFrameJsonObj->currentGold)
                                ? $participantFrameJsonObj->currentGold : null)
                                ->setDominionScore(isset($participantFrameJsonObj->dominionScore)
                                    ? $participantFrameJsonObj->dominionScore : null)
                                ->setJungleMinionsKilled(isset($participantFrameJsonObj->jungleMinionsKilled)
                                    ? $participantFrameJsonObj->jungleMinionsKilled : null)
                                ->setLevel(isset($participantFrameJsonObj->level)
                                    ? $participantFrameJsonObj->level : null)
                                ->setMinionsKilled(isset($participantFrameJsonObj->minionsKilled)
                                    ? $participantFrameJsonObj->minionsKilled : null)
                                ->setParticipantId(isset($participantFrameJsonObj->participantId)
                                    ? $participantFrameJsonObj->participantId : null)
                                ->setTeamScore(isset($participantFrameJsonObj->teamScore)
                                    ? $participantFrameJsonObj->teamScore : null)
                                ->setTotalGold(isset($participantFrameJsonObj->totalGold)
                                    ? $participantFrameJsonObj->totalGold : null)
                                ->setXp(isset($participantFrameJsonObj->xp)
                                    ? $participantFrameJsonObj->xp : null);
                            if (isset($participantFrameJsonObj->position)) {
                                $participantFrame->setPositionX(isset($participantFrameJsonObj->position->x)
                                    ? $participantFrameJsonObj->position->x : null)
                                    ->setPositionY(isset($participantFrameJsonObj->position->y)
                                        ? $participantFrameJsonObj->position->y : null);
                            }
                            $frame->addParticipantFrame($participantFrame);
                        }
                    }
                    if (isset($frameJsonObj->events) && is_array($frameJsonObj->events)) {
                        foreach ($frameJsonObj->events as $eventJsonObj) {
                            $event = new Event();
                            $event->setEventType(isset($eventJsonObj->eventType) ? $eventJsonObj->eventType : null)
                                ->setTimestamp(isset($eventJsonObj->timestamp) ? $eventJsonObj->timestamp : null);
                            if (isset($eventJsonObj->position)) {
                                $event->setPositionX(isset($eventJsonObj->position->x)
                                    ? $eventJsonObj->position->x : null)
                                    ->setPositionY(isset($eventJsonObj->position->y)
                                        ? $eventJsonObj->position->y : null);
                            }
                            unset($eventJsonObj->eventType, $eventJsonObj->timestamp, $eventJsonObj->position);
                            foreach ($eventJsonObj as $propertyName => $propertyValue) {
                                try {
                                    $setterName = 'set' . ucfirst($propertyName);
                                    $event->$setterName($propertyValue);
                                } catch (\BadMethodCallException $e) {
                                    dump($e);
                                }
                            }
                            $frame->addEvent($event);
                        }
                    }
                    $timeline->addFrame($frame);
                }
            }
            $matchDetail->setTimeline($timeline);
        }
        $this->entityManager->persist($matchDetail);
        $this->entityManager->flush();

        return $matchDetail;
    }
}
