<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchReference
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MatchReferenceRepository")
 */
class MatchReference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer ID of the match
     *
     * @ORM\Column(name="match_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $matchId;

    /**
     * @var \DateTime Match finish time.
     *
     * @ORM\Column(name="match_finish", type="datetime", nullable=true)
     */
    protected $matchFinish;

    /**
     * @var string Legal values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM
     *
     * @ORM\Column(name="lane", type="enum_lane", nullable=true)
     */
    protected $lane;

    /**
     * @var string Platform ID of the match
     *
     * @ORM\Column(name="platform_id", type="string", nullable=true)
     */
    protected $platformId;

    /**
     * @var string Match queue type (Legal values: CUSTOM, NORMAL_5x5_BLIND, RANKED_SOLO_5x5, RANKED_PREMADE_5x5, BOT_5x5, NORMAL_3x3, RANKED_PREMADE_3x3, NORMAL_5x5_DRAFT, ODIN_5x5_BLIND, ODIN_5x5_DRAFT, BOT_ODIN_5x5, BOT_5x5_INTRO, BOT_5x5_BEGINNER, BOT_5x5_INTERMEDIATE, RANKED_TEAM_3x3, RANKED_TEAM_5x5, BOT_TT_3x3, GROUP_FINDER_5x5, ARAM_5x5, ONEFORALL_5x5, FIRSTBLOOD_1x1, FIRSTBLOOD_2x2, SR_6x6, URF_5x5, ONEFORALL_MIRRORMODE_5x5, BOT_URF_5x5, NIGHTMARE_BOT_5x5_RANK1, NIGHTMARE_BOT_5x5_RANK2, NIGHTMARE_BOT_5x5_RANK5, ASCENSION_5x5, HEXAKILL, BILGEWATER_ARAM_5x5, KING_PORO_5x5, COUNTER_PICK, BILGEWATER_5x5)
     *
     * @ORM\Column(name="queue_type", type="enum_queue_type", nullable=true)
     */
    protected $queueType;

    /**
     * @var string Region where the match was played
     *
     * @ORM\Column(name="region", type="string", nullable=true)
     */
    protected $region;

    /**
     * @var string Legal values: DUO, NONE, SOLO, DUO_CARRY, DUO_SUPPORT
     *
     * @ORM\Column(name="role", type="enum_role", nullable=true)
     */
    protected $role;

    /**
     * @var string Season match was played (Legal values: PRESEASON3, SEASON3, PRESEASON2014, SEASON2014, PRESEASON2015, SEASON2015, PRESEASON2016, SEASON2016)
     *
     * @ORM\Column(name="season", type="string", nullable=true)
     */
    protected $season;

    /**
     * @var MatchDetail
     *
     * @ORM\ManyToOne(targetEntity="MatchDetail", inversedBy="matchReferences")
     */
    protected $matchDetail;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="matchReferences")
     */
    protected $player;

    /**
     * @var Champion
     *
     * @ORM\ManyToOne(targetEntity="Champion", inversedBy="matchReferences")
     */
    protected $champion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get platformId
     *
     * @return string
     */
    public function getPlatformId()
    {
        return $this->platformId;
    }

    /**
     * Set platformId
     *
     * @param string $platformId
     * @return MatchReference
     */
    public function setPlatformId($platformId)
    {
        $this->platformId = $platformId;

        return $this;
    }

    /**
     * Get queueType
     *
     * @return string
     */
    public function getQueueType()
    {
        return $this->queueType;
    }

    /**
     * Set queueType
     *
     * @param string $queueType
     * @return MatchReference
     */
    public function setQueueType($queueType)
    {
        $this->queueType = $queueType;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return MatchReference
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get season
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set season
     *
     * @param string $season
     * @return MatchReference
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Set matchCreation
     *
     * @param \DateTime $matchFinish
     * @return MatchReference
     */
    public function setMatchFinish($matchFinish)
    {
        $this->matchFinish = $matchFinish;

        return $this;
    }

    /**
     * Get matchCreation
     *
     * @return \DateTime
     */
    public function getMatchFinish()
    {
        return $this->matchFinish;
    }

    /**
     * Set matchId
     *
     * @param integer $matchId
     * @return MatchReference
     */
    public function setMatchId($matchId)
    {
        $this->matchId = $matchId;

        return $this;
    }

    /**
     * Get matchId
     *
     * @return integer
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * Set lane
     *
     * @param string $lane
     *
     * @return MatchReference
     */
    public function setLane($lane)
    {
        $this->lane = $lane;

        return $this;
    }

    /**
     * Get lane
     *
     * @return string
     */
    public function getLane()
    {
        return $this->lane;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return MatchReference
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set matchReference
     *
     * @param MatchDetail $matchDetail
     *
     * @return MatchReference
     */
    public function setMatchDetail(MatchDetail $matchDetail = null)
    {
        $this->matchDetail = $matchDetail;

        return $this;
    }

    /**
     * Get matchReference
     *
     * @return MatchDetail
     */
    public function getMatchDetail()
    {
        return $this->matchDetail;
    }

    /**
     * Set player
     *
     * @param Player $player
     *
     * @return MatchReference
     */
    public function setPlayer(Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set champion
     *
     * @param Champion $champion
     *
     * @return MatchReference
     */
    public function setChampion(Champion $champion = null)
    {
        $this->champion = $champion;

        return $this;
    }

    /**
     * Get champion
     *
     * @return Champion
     */
    public function getChampion()
    {
        return $this->champion;
    }
}
