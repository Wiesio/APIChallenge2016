<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantFrame
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ParticipantFrameRepository")
 */
class ParticipantFrame
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
     * @var integer Participant's current gold
     *
     * @ORM\Column(name="current_gold", type="integer", nullable=true)
     */
    protected $currentGold;

    /**
     * @var integer Dominion score of the participant
     *
     * @ORM\Column(name="dominion_score", type="integer", nullable=true)
     */
    protected $dominionScore;

    /**
     * @var integer Dominion score of the participant
     *
     * @ORM\Column(name="jungle_minions_killed", type="integer", nullable=true)
     */
    protected $jungleMinionsKilled;

    /**
     * @var integer Participant's current level
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    protected $level;

    /**
     * @var integer Number of minions killed by participant
     *
     * @ORM\Column(name="minions_killed", type="integer", nullable=true)
     */
    protected $minionsKilled;

    /**
     * @var integer Participant ID
     *
     * @ORM\Column(name="participant_id", type="integer", nullable=true)
     */
    protected $participantId;

    /**
     * @var integer Participant's position x
     *
     * @ORM\Column(name="position_x", type="integer", nullable=true)
     */
    protected $positionX;

    /**
     * @var integer Participant's position y
     *
     * @ORM\Column(name="position_y", type="integer", nullable=true)
     */
    protected $positionY;

    /**
     * @var integer Team score of the participant
     *
     * @ORM\Column(name="team_score", type="integer", nullable=true)
     */
    protected $teamScore;

    /**
     * @var integer Participant's total gold
     *
     * @ORM\Column(name="total_gold", type="integer", nullable=true)
     */
    protected $totalGold;

    /**
     * @var integer Experience earned by participant
     *
     * @ORM\Column(name="xp", type="integer", nullable=true)
     */
    protected $xp;

    /**
     * @var Frame Frame information
     *
     * @ORM\ManyToOne(targetEntity="Frame", inversedBy="participantFrames", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $frame;

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
     * Get currentGold
     *
     * @return integer
     */
    public function getCurrentGold()
    {
        return $this->currentGold;
    }

    /**
     * Set currentGold
     *
     * @param integer $currentGold
     * @return ParticipantFrame
     */
    public function setCurrentGold($currentGold)
    {
        $this->currentGold = $currentGold;

        return $this;
    }

    /**
     * Get dominionScore
     *
     * @return integer
     */
    public function getDominionScore()
    {
        return $this->dominionScore;
    }

    /**
     * Set dominionScore
     *
     * @param integer $dominionScore
     * @return ParticipantFrame
     */
    public function setDominionScore($dominionScore)
    {
        $this->dominionScore = $dominionScore;

        return $this;
    }

    /**
     * Get jungleMinionsKilled
     *
     * @return integer
     */
    public function getJungleMinionsKilled()
    {
        return $this->jungleMinionsKilled;
    }

    /**
     * Set jungleMinionsKilled
     *
     * @param integer $jungleMinionsKilled
     * @return ParticipantFrame
     */
    public function setJungleMinionsKilled($jungleMinionsKilled)
    {
        $this->jungleMinionsKilled = $jungleMinionsKilled;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return ParticipantFrame
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get minionsKilled
     *
     * @return integer
     */
    public function getMinionsKilled()
    {
        return $this->minionsKilled;
    }

    /**
     * Set minionsKilled
     *
     * @param integer $minionsKilled
     * @return ParticipantFrame
     */
    public function setMinionsKilled($minionsKilled)
    {
        $this->minionsKilled = $minionsKilled;

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
     * @return ParticipantFrame
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;

        return $this;
    }

    /**
     * Get positionX
     *
     * @return integer
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * Set positionX
     *
     * @param integer $positionX
     * @return ParticipantFrame
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;

        return $this;
    }

    /**
     * Get positionY
     *
     * @return integer
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * Set positionY
     *
     * @param integer $positionY
     * @return ParticipantFrame
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get teamScore
     *
     * @return integer
     */
    public function getTeamScore()
    {
        return $this->teamScore;
    }

    /**
     * Set teamScore
     *
     * @param integer $teamScore
     * @return ParticipantFrame
     */
    public function setTeamScore($teamScore)
    {
        $this->teamScore = $teamScore;

        return $this;
    }

    /**
     * Get totalGold
     *
     * @return integer
     */
    public function getTotalGold()
    {
        return $this->totalGold;
    }

    /**
     * Set totalGold
     *
     * @param integer $totalGold
     * @return ParticipantFrame
     */
    public function setTotalGold($totalGold)
    {
        $this->totalGold = $totalGold;

        return $this;
    }

    /**
     * Get xp
     *
     * @return integer
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Set xp
     *
     * @param integer $xp
     * @return ParticipantFrame
     */
    public function setXp($xp)
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get frame
     *
     * @return Frame
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set frame
     *
     * @param Frame $frame
     * @return ParticipantFrame
     */
    public function setFrame(Frame $frame = null)
    {
        $this->frame = $frame;

        return $this;
    }
}
