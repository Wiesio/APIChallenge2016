<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ParticipantRepository")
 */
class Participant
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string Highest ranked tier achieved for the previous season, if any, otherwise null. Used to display border in game loading screen. (Legal values: CHALLENGER, MASTER, DIAMOND, PLATINUM, GOLD, SILVER, BRONZE, UNRANKED)
     *
     * @ORM\Column(name="highest_achieved_season_tier", type="enum_season_tier", nullable=true)
     */
    protected $highestAchievedSeasonTier;

    /**
     * @var int Participant ID
     *
     * @ORM\Column(name="participant_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $participantId;

    /**
     * @var int First summoner spell ID
     *
     * @ORM\Column(name="spell_1_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $spell1Id;

    /**
     * @var int Second summoner spell ID
     *
     * @ORM\Column(name="spell_2_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $spell2Id;

    /**
     * @var int Team ID
     *
     * @ORM\Column(name="team_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $teamId;

    /**
     * @var ArrayCollection[Mastery] List of mastery information
     *
     * @ORM\OneToMany(targetEntity="Mastery", mappedBy="participant", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $masteries;

    /**
     * @var MatchDetail Match details
     *
     * @ORM\ManyToOne(targetEntity="MatchDetail", inversedBy="participants", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $matchDetail;

    /**
     * @var ParticipantStats Participant statistics
     *
     * @ORM\OneToOne(targetEntity="ParticipantStats", mappedBy="participant", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participantStats;

    /**
     * @var ParticipantTimeline Participant timeline
     *
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", mappedBy="participant", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participantTimeline;

    /**
     * @var Player Participant identity
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="participants", cascade={"persist"})
     */
    protected $player;

    /**
     * @var Champion Champion used
     *
     * @ORM\ManyToOne(targetEntity="Champion", inversedBy="participants", cascade={"persist"})
     */
    protected $champion;

    /**
     * @var ArrayCollection[Rune] List of rune information
     *
     * @ORM\OneToMany(targetEntity="Rune", mappedBy="participant", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $runes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->masteries = new ArrayCollection();
        $this->runes = new ArrayCollection();
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
     * Get highestAchievedSeasonTier
     *
     * @return string
     */
    public function getHighestAchievedSeasonTier()
    {
        return $this->highestAchievedSeasonTier;
    }

    /**
     * Set highestAchievedSeasonTier
     *
     * @param string $highestAchievedSeasonTier
     * @return Participant
     */
    public function setHighestAchievedSeasonTier($highestAchievedSeasonTier)
    {
        $this->highestAchievedSeasonTier = $highestAchievedSeasonTier;

        return $this;
    }

    /**
     * Get participantId
     *
     * @return integer
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * Set participantId
     *
     * @param integer $participantId
     * @return Participant
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;

        return $this;
    }

    /**
     * Get spell1Id
     *
     * @return integer
     */
    public function getSpell1Id()
    {
        return $this->spell1Id;
    }

    /**
     * Set spell1Id
     *
     * @param integer $spell1Id
     * @return Participant
     */
    public function setSpell1Id($spell1Id)
    {
        $this->spell1Id = $spell1Id;

        return $this;
    }

    /**
     * Get spell2Id
     *
     * @return integer
     */
    public function getSpell2Id()
    {
        return $this->spell2Id;
    }

    /**
     * Set spell2Id
     *
     * @param integer $spell2Id
     * @return Participant
     */
    public function setSpell2Id($spell2Id)
    {
        $this->spell2Id = $spell2Id;

        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set teamId
     *
     * @param integer $teamId
     * @return Participant
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    /**
     * Add masteries
     *
     * @param Mastery $masteries
     * @return Participant
     */
    public function addMastery(Mastery $masteries)
    {
        $this->masteries[] = $masteries;
        $masteries->setParticipant($this);

        return $this;
    }

    /**
     * Remove masteries
     *
     * @param Mastery $masteries
     */
    public function removeMastery(Mastery $masteries)
    {
        $this->masteries->removeElement($masteries);
        $masteries->setParticipant(null);
    }

    /**
     * Get masteries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMasteries()
    {
        return $this->masteries;
    }

    /**
     * Get matchDetail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchDetail()
    {
        return $this->matchDetail;
    }

    /**
     * Set matchDetail
     *
     * @param MatchDetail $matchDetail
     * @return Participant
     */
    public function setMatchDetail(MatchDetail $matchDetail = null)
    {
        $this->matchDetail = $matchDetail;

        return $this;
    }

    /**
     * Get participantStats
     *
     * @return ParticipantStats
     */
    public function getParticipantStats()
    {
        return $this->participantStats;
    }

    /**
     * Set participantStats
     *
     * @param ParticipantStats $participantStats
     * @return Participant
     */
    public function setParticipantStats(ParticipantStats $participantStats = null)
    {
        if ($this->participantStats) {
            $this->participantStats->setParticipant(null);
        }
        $this->participantStats = $participantStats;
        if ($participantStats) {
            $participantStats->setParticipant($this);
        }

        return $this;
    }

    /**
     * Get participantTimeline
     *
     * @return ParticipantTimeline
     */
    public function getParticipantTimeline()
    {
        return $this->participantTimeline;
    }

    /**
     * Set participantTimeline
     *
     * @param ParticipantTimeline $participantTimeline
     * @return Participant
     */
    public function setParticipantTimeline(ParticipantTimeline $participantTimeline = null)
    {
        if ($this->participantTimeline) {
            $this->participantTimeline->setParticipant(null);
        }
        $this->participantTimeline = $participantTimeline;
        if ($participantTimeline) {
            $participantTimeline->setParticipant($this);
        }

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
     * Set player
     *
     * @param Player $player
     * @return Participant
     */
    public function setPlayer(Player $player = null)
    {
        $this->player = $player;

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

    /**
     * Set champion
     *
     * @param Champion $champion
     * @return Participant
     */
    public function setChampion(Champion $champion = null)
    {
        $this->champion = $champion;

        return $this;
    }
    
    /**
     * Add runes
     *
     * @param Rune $runes
     * @return Participant
     */
    public function addRune(Rune $runes)
    {
        $this->runes[] = $runes;
        $runes->setParticipant($this);

        return $this;
    }

    /**
     * Remove runes
     *
     * @param Rune $runes
     */
    public function removeRune(Rune $runes)
    {
        $this->runes->removeElement($runes);
        $runes->setParticipant(null);
    }

    /**
     * Get runes
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getRunes()
    {
        return $this->runes;
    }
}
