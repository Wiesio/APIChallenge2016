<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MatchDetail
 *
 * @ORM\Table(indexes={
 *     @ORM\Index(name="matchid_region_idx", columns={"match_id", "region"}),
 *     @ORM\Index(name="matchcreation_idx", columns={"match_creation"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MatchDetailRepository")
 */
class MatchDetail
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
     * @var \DateTime Match creation time. Designates when the team select lobby is created and/or the match is made through match making, not when the game actually starts.
     *
     * @ORM\Column(name="match_creation", type="datetime", nullable=true)
     */
    protected $matchCreation;

    /**
     * @var integer Match duration
     *
     * @ORM\Column(name="match_duration", type="integer", nullable=true)
     */
    protected $matchDuration;

    /**
     * @var integer ID of the match
     *
     * @ORM\Column(name="match_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $matchId;

    /**
     * @var string Match mode (Legal values: CLASSIC, ODIN, ARAM, TUTORIAL, ONEFORALL, ASCENSION, FIRSTBLOOD, KINGPORO)
     *
     * @ORM\Column(name="match_mode", type="enum_match_mode", nullable=true)
     */
    protected $matchMode;

    /**
     * @var string Match type (Legal values: CUSTOM_GAME, MATCHED_GAME, TUTORIAL_GAME)
     *
     * @ORM\Column(name="match_type", type="enum_match_type", nullable=true)
     */
    protected $matchType;

    /**
     * @var string Match version
     *
     * @ORM\Column(name="match_version", type="string", nullable=true)
     */
    protected $matchVersion;

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
     * @var string Season match was played (Legal values: PRESEASON3, SEASON3, PRESEASON2014, SEASON2014, PRESEASON2015, SEASON2015)
     *
     * @ORM\Column(name="season", type="string", nullable=true)
     */
    protected $season;

    /**
     * @var Collection|Participant[] Participant information
     *
     * @ORM\OneToMany(targetEntity="Participant", mappedBy="matchDetail", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participants;

    /**
     * @var Collection|Team[] Team information
     *
     * @ORM\OneToMany(targetEntity="Team", mappedBy="matchDetail", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $teams;

    /**
     * @var Timeline Match timeline data (not included by default)
     *
     * @ORM\OneToOne(targetEntity="Timeline", mappedBy="matchDetail")
     */
    protected $timeline;

    /**
     * @var Collection|MatchReference[] Match Reference information
     *
     * @ORM\OneToMany(targetEntity="MatchReference", mappedBy="matchDetail", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $matchReferences;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->matchReferences = new ArrayCollection();
    }

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
     * Get matchMode
     *
     * @return string
     */
    public function getMatchMode()
    {
        return $this->matchMode;
    }

    /**
     * Set matchMode
     *
     * @param string $matchMode
     * @return MatchDetail
     */
    public function setMatchMode($matchMode)
    {
        $this->matchMode = $matchMode;

        return $this;
    }

    /**
     * Get matchVersion
     *
     * @return string
     */
    public function getMatchVersion()
    {
        return $this->matchVersion;
    }

    /**
     * Set matchVersion
     *
     * @param string $matchVersion
     * @return MatchDetail
     */
    public function setMatchVersion($matchVersion)
    {
        $this->matchVersion = $matchVersion;

        return $this;
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
     * @return MatchDetail
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
     * @return MatchDetail
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
     * @return MatchDetail
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
     * @return MatchDetail
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Add participants
     *
     * @param Participant $participants
     * @return MatchDetail
     */
    public function addParticipant(Participant $participants)
    {
        $this->participants[] = $participants;
        $participants->setMatchDetail($this);

        return $this;
    }

    /**
     * Remove participants
     *
     * @param Participant $participants
     */
    public function removeParticipant(Participant $participants)
    {
        $this->participants->removeElement($participants);
        $participants->setMatchDetail(null);
    }

    /**
     * Get participants
     *
     * @return Collection|Participant[]
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Add teams
     *
     * @param Team $teams
     * @return MatchDetail
     */
    public function addTeam(Team $teams)
    {
        $this->teams[] = $teams;
        $teams->setMatchDetail($this);

        return $this;
    }

    /**
     * Remove teams
     *
     * @param Team $teams
     */
    public function removeTeam(Team $teams)
    {
        $this->teams->removeElement($teams);
        $teams->setMatchDetail(null);
    }

    /**
     * Get teams
     *
     * @return Collection|Team[]
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Get timeline
     *
     * @return Timeline
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * Set timeline
     *
     * @param Timeline $timeline
     * @return MatchDetail
     */
    public function setTimeline(Timeline $timeline = null)
    {
        if ($this->timeline) {
            $this->timeline->setMatchDetail(null);
        }
        $this->timeline = $timeline;
        if ($timeline) {
            $timeline->setMatchDetail($this);
        }

        return $this;
    }

    /**
     * Set matchCreation
     *
     * @param \DateTime $matchCreation
     * @return MatchDetail
     */
    public function setMatchCreation($matchCreation)
    {
        $this->matchCreation = $matchCreation;

        return $this;
    }

    /**
     * Get matchCreation
     *
     * @return \DateTime
     */
    public function getMatchCreation()
    {
        return $this->matchCreation;
    }

    /**
     * Set matchDuration
     *
     * @param integer $matchDuration
     * @return MatchDetail
     */
    public function setMatchDuration($matchDuration)
    {
        $this->matchDuration = $matchDuration;

        return $this;
    }

    /**
     * Get matchDuration
     *
     * @return integer
     */
    public function getMatchDuration()
    {
        return $this->matchDuration;
    }

    /**
     * Set matchId
     *
     * @param integer $matchId
     * @return MatchDetail
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
     * Set matchType
     *
     * @param string $matchType
     * @return MatchDetail
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;

        return $this;
    }

    /**
     * Get matchType
     *
     * @return string
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * Add matchReference
     *
     * @param MatchReference $matchReference
     *
     * @return MatchDetail
     */
    public function addMatchReference(MatchReference $matchReference)
    {
        $this->matchReferences[] = $matchReference;
        $matchReference->setMatchDetail($this);

        return $this;
    }

    /**
     * Remove matchReference
     *
     * @param MatchReference $matchReference
     */
    public function removeMatchReference(MatchReference $matchReference)
    {
        $this->matchReferences->removeElement($matchReference);
        $matchReference->setMatchDetail(null);
    }

    /**
     * Get matchReferences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchReferences()
    {
        return $this->matchReferences;
    }
}
