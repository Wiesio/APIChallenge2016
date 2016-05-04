<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Champion
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChampionMasteryRepository")
 */
class ChampionMastery
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
     * @var string Champion level for specified player and champion combination.
     *
     * @ORM\Column(name="champion_level", type="integer", nullable=true)
     */
    protected $championLevel;

    /**
     * @var string Total number of champion points for this player and champion combination - they are used to determine championLevel.
     *
     * @ORM\Column(name="champion_points", type="integer", nullable=true)
     */
    protected $championPoints;

    /**
     * @var string Number of points earned since current level has been achieved. Zero if player reached maximum champion level for this champion.
     *
     * @ORM\Column(name="champion_pointsSinceLastLevel", type="integer", nullable=true)
     */
    protected $championPointsSinceLastLevel;

    /**
     * @var string Number of points needed to achieve next level. Zero if player reached maximum champion level for this champion.
     *
     * @ORM\Column(name="champion_pointsUntilNextLevel", type="integer", nullable=true)
     */
    protected $championPointsUntilNextLevel;

    /**
     * @var boolean Is chest granted for this champion or not in current season.
     *
     * @ORM\Column(name="chest_granted", type="boolean", nullable=true)
     */
    protected $chestGranted;

    /**
     * @var string The highest grade of this champion of current season.
     *
     * @ORM\Column(name="highest_grade", type="string", nullable=true)
     */
    protected $highestGrade;

    /**
     * @var \DateTime Last time this champion was played by this player - in Unix milliseconds time format.
     *
     * @ORM\Column(name="last_play_time", type="datetime", nullable=true)
     */
    protected $lastPlayTime;

    /**
     * @var Champion Champion ID for this entry.
     *
     * @ORM\ManyToOne(targetEntity="Champion", inversedBy="championMasteries")
     */
    protected $champion;

    /**
     * @var Player Player ID for this entry.
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="championMasteries")
     */
    protected $player;

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
     * Set championLevel
     *
     * @param integer $championLevel
     *
     * @return ChampionMastery
     */
    public function setChampionLevel($championLevel)
    {
        $this->championLevel = $championLevel;

        return $this;
    }

    /**
     * Get championLevel
     *
     * @return integer
     */
    public function getChampionLevel()
    {
        return $this->championLevel;
    }

    /**
     * Set championPoints
     *
     * @param integer $championPoints
     *
     * @return ChampionMastery
     */
    public function setChampionPoints($championPoints)
    {
        $this->championPoints = $championPoints;

        return $this;
    }

    /**
     * Get championPoints
     *
     * @return integer
     */
    public function getChampionPoints()
    {
        return $this->championPoints;
    }

    /**
     * Set championPointsSinceLastLevel
     *
     * @param integer $championPointsSinceLastLevel
     *
     * @return ChampionMastery
     */
    public function setChampionPointsSinceLastLevel($championPointsSinceLastLevel)
    {
        $this->championPointsSinceLastLevel = $championPointsSinceLastLevel;

        return $this;
    }

    /**
     * Get championPointsSinceLastLevel
     *
     * @return integer
     */
    public function getChampionPointsSinceLastLevel()
    {
        return $this->championPointsSinceLastLevel;
    }

    /**
     * Set championPointsUntilNextLevel
     *
     * @param integer $championPointsUntilNextLevel
     *
     * @return ChampionMastery
     */
    public function setChampionPointsUntilNextLevel($championPointsUntilNextLevel)
    {
        $this->championPointsUntilNextLevel = $championPointsUntilNextLevel;

        return $this;
    }

    /**
     * Get championPointsUntilNextLevel
     *
     * @return integer
     */
    public function getChampionPointsUntilNextLevel()
    {
        return $this->championPointsUntilNextLevel;
    }

    /**
     * Set chestGranted
     *
     * @param boolean $chestGranted
     *
     * @return ChampionMastery
     */
    public function setChestGranted($chestGranted)
    {
        $this->chestGranted = $chestGranted;

        return $this;
    }

    /**
     * Get chestGranted
     *
     * @return boolean
     */
    public function getChestGranted()
    {
        return $this->chestGranted;
    }

    /**
     * Set highestGrade
     *
     * @param string $highestGrade
     *
     * @return ChampionMastery
     */
    public function setHighestGrade($highestGrade)
    {
        $this->highestGrade = $highestGrade;

        return $this;
    }

    /**
     * Get highestGrade
     *
     * @return string
     */
    public function getHighestGrade()
    {
        return $this->highestGrade;
    }

    /**
     * Set lastPlayTime
     *
     * @param \DateTime $lastPlayTime
     *
     * @return ChampionMastery
     */
    public function setLastPlayTime($lastPlayTime)
    {
        $this->lastPlayTime = $lastPlayTime;

        return $this;
    }

    /**
     * Get lastPlayTime
     *
     * @return \DateTime
     */
    public function getLastPlayTime()
    {
        return $this->lastPlayTime;
    }

    /**
     * Set champion
     *
     * @param Champion $champion
     *
     * @return ChampionMastery
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

    /**
     * Set player
     *
     * @param Player $player
     *
     * @return ChampionMastery
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
}
