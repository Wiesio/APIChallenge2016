<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TeamRepository")
 */
class Team
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
     * @var integer Number of times the team killed baron
     *
     * @ORM\Column(name="baron_kills", type="integer", nullable=true)
     */
    protected $baronKills;

    /**
     * @var integer If game was a dominion game, specifies the points the team had at game end, otherwise null
     *
     * @ORM\Column(name="dominion_victory_score", type="integer", nullable=true)
     */
    protected $dominionVictoryScore;

    /**
     * @var integer Number of times the team killed dragon
     *
     * @ORM\Column(name="dragon_kills", type="integer", nullable=true)
     */
    protected $dragonKills;

    /**
     * @var boolean Flag indicating whether or not the team got the first baron kill
     *
     * @ORM\Column(name="first_baron", type="boolean", nullable=true)
     */
    protected $firstBaron;

    /**
     * @var boolean Flag indicating whether or not the team got first blood
     *
     * @ORM\Column(name="first_blood", type="boolean", nullable=true)
     */
    protected $firstBlood;

    /**
     * @var boolean Flag indicating whether or not the team got the first dragon kill
     *
     * @ORM\Column(name="first_dragon", type="boolean", nullable=true)
     */
    protected $firstDragon;

    /**
     * @var boolean Flag indicating whether or not the team destroyed the first inhibitor
     *
     * @ORM\Column(name="first_inhibitor", type="boolean", nullable=true)
     */
    protected $firstInhibitor;

    /**
     * @var boolean Flag indicating whether or not the team destroyed the first tower
     *
     * @ORM\Column(name="first_tower", type="boolean", nullable=true)
     */
    protected $firstTower;

    /**
     * @var integer Number of inhibitors the team destroyed
     *
     * @ORM\Column(name="inhibitor_kills", type="integer", nullable=true)
     */
    protected $inhibitorKills;

    /**
     * @var integer Team ID
     *
     * @ORM\Column(name="team_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $teamId;

    /**
     * @var integer Number of towers the team destroyed
     *
     * @ORM\Column(name="tower_kills", type="integer", nullable=true)
     */
    protected $towerKills;

    /**
     * @var integer Number of times the team killed vilemaw
     *
     * @ORM\Column(name="vilemaw_kills", type="integer", nullable=true)
     */
    protected $vilemawKills;

    /**
     * @var boolean Flag indicating whether or not the team won
     *
     * @ORM\Column(name="winner", type="boolean", nullable=true)
     */
    protected $winner;

    /**
     * @var ArrayCollection[BannedChampion] If game was draft mode, contains banned champion data, otherwise null
     *
     * @ORM\OneToMany(targetEntity="BannedChampion", mappedBy="team", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $bannedChampions;

    /**
     * @var MatchDetail Match detail information
     *
     * @ORM\ManyToOne(targetEntity="MatchDetail", inversedBy="teams", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $matchDetail;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bannedChampions = new ArrayCollection();
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
     * Get baronKills
     *
     * @return integer
     */
    public function getBaronKills()
    {
        return $this->baronKills;
    }

    /**
     * Set baronKills
     *
     * @param integer $baronKills
     * @return Team
     */
    public function setBaronKills($baronKills)
    {
        $this->baronKills = $baronKills;

        return $this;
    }

    /**
     * Get dominionVictoryScore
     *
     * @return integer
     */
    public function getDominionVictoryScore()
    {
        return $this->dominionVictoryScore;
    }

    /**
     * Set dominionVictoryScore
     *
     * @param integer $dominionVictoryScore
     * @return Team
     */
    public function setDominionVictoryScore($dominionVictoryScore)
    {
        $this->dominionVictoryScore = $dominionVictoryScore;

        return $this;
    }

    /**
     * Get dragonKills
     *
     * @return integer
     */
    public function getDragonKills()
    {
        return $this->dragonKills;
    }

    /**
     * Set dragonKills
     *
     * @param integer $dragonKills
     * @return Team
     */
    public function setDragonKills($dragonKills)
    {
        $this->dragonKills = $dragonKills;

        return $this;
    }

    /**
     * Get firstBaron
     *
     * @return boolean
     */
    public function getFirstBaron()
    {
        return $this->firstBaron;
    }

    /**
     * Set firstBaron
     *
     * @param boolean $firstBaron
     * @return Team
     */
    public function setFirstBaron($firstBaron)
    {
        $this->firstBaron = $firstBaron;

        return $this;
    }

    /**
     * Get firstBlood
     *
     * @return boolean
     */
    public function getFirstBlood()
    {
        return $this->firstBlood;
    }

    /**
     * Set firstBlood
     *
     * @param boolean $firstBlood
     * @return Team
     */
    public function setFirstBlood($firstBlood)
    {
        $this->firstBlood = $firstBlood;

        return $this;
    }

    /**
     * Get firstDragon
     *
     * @return boolean
     */
    public function getFirstDragon()
    {
        return $this->firstDragon;
    }

    /**
     * Set firstDragon
     *
     * @param boolean $firstDragon
     * @return Team
     */
    public function setFirstDragon($firstDragon)
    {
        $this->firstDragon = $firstDragon;

        return $this;
    }

    /**
     * Get firstInhibitor
     *
     * @return boolean
     */
    public function getFirstInhibitor()
    {
        return $this->firstInhibitor;
    }

    /**
     * Set firstInhibitor
     *
     * @param boolean $firstInhibitor
     * @return Team
     */
    public function setFirstInhibitor($firstInhibitor)
    {
        $this->firstInhibitor = $firstInhibitor;

        return $this;
    }

    /**
     * Get firstTower
     *
     * @return boolean
     */
    public function getFirstTower()
    {
        return $this->firstTower;
    }

    /**
     * Set firstTower
     *
     * @param boolean $firstTower
     * @return Team
     */
    public function setFirstTower($firstTower)
    {
        $this->firstTower = $firstTower;

        return $this;
    }

    /**
     * Get inhibitorKills
     *
     * @return integer
     */
    public function getInhibitorKills()
    {
        return $this->inhibitorKills;
    }

    /**
     * Set inhibitorKills
     *
     * @param integer $inhibitorKills
     * @return Team
     */
    public function setInhibitorKills($inhibitorKills)
    {
        $this->inhibitorKills = $inhibitorKills;

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
     * @return Team
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    /**
     * Get towerKills
     *
     * @return integer
     */
    public function getTowerKills()
    {
        return $this->towerKills;
    }

    /**
     * Set towerKills
     *
     * @param integer $towerKills
     * @return Team
     */
    public function setTowerKills($towerKills)
    {
        $this->towerKills = $towerKills;

        return $this;
    }

    /**
     * Get vilemawKills
     *
     * @return integer
     */
    public function getVilemawKills()
    {
        return $this->vilemawKills;
    }

    /**
     * Set vilemawKills
     *
     * @param integer $vilemawKills
     * @return Team
     */
    public function setVilemawKills($vilemawKills)
    {
        $this->vilemawKills = $vilemawKills;

        return $this;
    }

    /**
     * Get winner
     *
     * @return boolean
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set winner
     *
     * @param boolean $winner
     * @return Team
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Add bannedChampions
     *
     * @param BannedChampion $bannedChampions
     * @return Team
     */
    public function addBannedChampion(BannedChampion $bannedChampions)
    {
        $this->bannedChampions[] = $bannedChampions;
        $bannedChampions->setTeam($this);

        return $this;
    }

    /**
     * Remove bannedChampions
     *
     * @param BannedChampion $bannedChampions
     */
    public function removeBannedChampion(BannedChampion $bannedChampions)
    {
        $this->bannedChampions->removeElement($bannedChampions);
        $bannedChampions->setTeam(null);
    }

    /**
     * Get bannedChampions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBannedChampions()
    {
        return $this->bannedChampions;
    }

    /**
     * Get matchDetail
     *
     * @return MatchDetail
     */
    public function getMatchDetail()
    {
        return $this->matchDetail;
    }

    /**
     * Set matchDetail
     *
     * @param MatchDetail $matchDetail
     * @return Team
     */
    public function setMatchDetail(MatchDetail $matchDetail = null)
    {
        $this->matchDetail = $matchDetail;

        return $this;
    }
}
