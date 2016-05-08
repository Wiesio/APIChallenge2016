<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(indexes={
 *     @ORM\Index(name="summonerid_region_idx", columns={"summoner_id", "region"}),
 *     @ORM\Index(name="summonername_region_idx", columns={"summoner_name", "region"}),
 *     @ORM\Index(name="summonerlevel_revisiondate_region_idx", columns={"summoner_level", "revision_date", "region"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PlayerRepository")
 */
class Player
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
     * @var string Region ID
     *
     * @ORM\Column(name="region", type="string", nullable=true)
     */
    protected $region;

    /**
     * @var string Match history URI
     *
     * @ORM\Column(name="match_history_uri", type="string", nullable=true)
     */
    protected $matchHistoryUri;

    /**
     * @var integer Profile icon ID
     *
     * @ORM\Column(name="profile_icon", type="integer", nullable=true)
     */
    protected $profileIcon;

    /**
     * @var integer Summoner ID
     *
     * @ORM\Column(name="summoner_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $summonerId;

    /**
     * @var string Summoner name
     *
     * @ORM\Column(name="summoner_name", type="string", nullable=true)
     */
    protected $summonerName;

    /**
     * @var string Revision date
     *
     * @ORM\Column(name="revision_date", type="datetime", nullable=true)
     */
    protected $revisionDate;

    /**
     * @var integer Summoner level
     *
     * @ORM\Column(name="summoner_level", type="smallint", nullable=true)
     */
    protected $summonerLevel;

    /**
     * @var Collection|Participant[] Participant information
     *
     * @ORM\OneToMany(targetEntity="Participant", mappedBy="player", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participants;

    /**
     * @var Collection|ChampionMastery[]
     *
     * @ORM\OneToMany(targetEntity="ChampionMastery", mappedBy="player")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $championMasteries;

    /**
     * @var Collection|MatchReference[] Match Reference information
     *
     * @ORM\OneToMany(targetEntity="MatchReference", mappedBy="player", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $matchReferences;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->championMasteries = new ArrayCollection();
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
     * @return Player
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get matchHistoryUri
     *
     * @return string
     */
    public function getMatchHistoryUri()
    {
        return $this->matchHistoryUri;
    }

    /**
     * Set matchHistoryUri
     *
     * @param string $matchHistoryUri
     * @return Player
     */
    public function setMatchHistoryUri($matchHistoryUri)
    {
        $this->matchHistoryUri = $matchHistoryUri;

        return $this;
    }

    /**
     * Get profileIcon
     *
     * @return integer
     */
    public function getProfileIcon()
    {
        return $this->profileIcon;
    }

    /**
     * Set profileIcon
     *
     * @param integer $profileIcon
     * @return Player
     */
    public function setProfileIcon($profileIcon)
    {
        $this->profileIcon = $profileIcon;

        return $this;
    }

    /**
     * Get summonerId
     *
     * @return integer
     */
    public function getSummonerId()
    {
        return $this->summonerId;
    }

    /**
     * Set summonerId
     *
     * @param integer $summonerId
     * @return Player
     */
    public function setSummonerId($summonerId)
    {
        $this->summonerId = $summonerId;

        return $this;
    }

    /**
     * Get summonerName
     *
     * @return string
     */
    public function getSummonerName()
    {
        return $this->summonerName;
    }

    /**
     * Set summonerName
     *
     * @param string $summonerName
     * @return Player
     */
    public function setSummonerName($summonerName)
    {
        $this->summonerName = $summonerName;

        return $this;
    }

    /**
     * Get revisionDate
     *
     * @return \DateTime
     */
    public function getRevisionDate()
    {
        return $this->revisionDate;
    }

    /**
     * Set revisionDate
     *
     * @param \DateTime $revisionDate
     * @return Player
     */
    public function setRevisionDate(\DateTime $revisionDate = null)
    {
        $this->revisionDate = $revisionDate;

        return $this;
    }

    /**
     * Get summonerLevel
     *
     * @return integer
     */
    public function getSummonerLevel()
    {
        return $this->summonerLevel;
    }

    /**
     * Set summonerLevel
     *
     * @param integer $summonerLevel
     * @return Player
     */
    public function setSummonerLevel($summonerLevel)
    {
        $this->summonerLevel = $summonerLevel;

        return $this;
    }

    /**
     * Add participants
     *
     * @param Participant $participants
     * @return Player
     */
    public function addParticipant(Participant $participants)
    {
        $this->participants[] = $participants;
        $participants->setPlayer($this);

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
        $participants->setPlayer(null);
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
     * Add championMastery
     *
     * @param ChampionMastery $championMastery
     *
     * @return Player
     */
    public function addChampionMastery(ChampionMastery $championMastery)
    {
        $this->championMasteries[] = $championMastery;
        $championMastery->setPlayer($this);

        return $this;
    }

    /**
     * Remove championMastery
     *
     * @param ChampionMastery $championMastery
     */
    public function removeChampionMastery(ChampionMastery $championMastery)
    {
        $this->championMasteries->removeElement($championMastery);
        $championMastery->setPlayer(null);
    }

    /**
     * Get championMasteries
     *
     * @return Collection|ChampionMastery[]
     */
    public function getChampionMasteries()
    {
        return $this->championMasteries;
    }

    /**
     * Add matchReference
     *
     * @param MatchReference $matchReference
     *
     * @return Player
     */
    public function addMatchReference(MatchReference $matchReference)
    {
        $this->matchReferences[] = $matchReference;
        $matchReference->setPlayer($this);

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
        $matchReference->setPlayer(null);
    }

    /**
     * Get matchReferences
     *
     * @return Collection|MatchReference[]
     */
    public function getMatchReferences()
    {
        return $this->matchReferences;
    }
}
