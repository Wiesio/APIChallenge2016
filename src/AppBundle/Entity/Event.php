<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EventRepository")
 */
class Event
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
     * @var string The ascended type of the event. Only present if relevant. Note that CLEAR_ASCENDED refers to when a participants kills the ascended player. (Legal values: CHAMPION_ASCENDED, CLEAR_ASCENDED, MINION_ASCENDED)
     *
     * @ORM\Column(name="ascended_type", type="enum_ascended_type", nullable=true)
     */
    protected $ascendedType;

    /**
     * @var array The assisting participant IDs of the event. Only present if relevant.
     *
     * @ORM\Column(name="assisting_participant_ids", type="array", nullable=true)
     */
    protected $assistingParticipantIds;

    /**
     * @var string The building type of the event. Only present if relevant. (Legal values: INHIBITOR_BUILDING, TOWER_BUILDING)
     *
     * @ORM\Column(name="building_type", type="enum_building_type", nullable=true)
     */
    protected $buildingType;

    /**
     * @var integer The creator ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="creator_id", type="integer", nullable=true)
     */
    protected $creatorId;

    /**
     * @var string Event type. (Legal values: ASCENDED_EVENT, BUILDING_KILL, CAPTURE_POINT, CHAMPION_KILL, ELITE_MONSTER_KILL, ITEM_DESTROYED, ITEM_PURCHASED, ITEM_SOLD, ITEM_UNDO, PORO_KING_SUMMON, SKILL_LEVEL_UP, WARD_KILL, WARD_PLACED)
     *
     * @ORM\Column(name="event_type", type="enum_event_type", nullable=true)
     */
    protected $eventType;

    /**
     * @var integer The ending item ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="item_after", type="integer", nullable=true)
     */
    protected $itemAfter;

    /**
     * @var integer The starting item ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="item_before", type="integer", nullable=true)
     */
    protected $itemBefore;

    /**
     * @var integer The item ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="item_id", type="integer", nullable=true)
     */
    protected $itemId;

    /**
     * @var integer The killer ID of the event. Only present if relevant. Killer ID 0 indicates a minion.
     *
     * @ORM\Column(name="killer_id", type="integer", nullable=true)
     */
    protected $killerId;

    /**
     * @var string The lane type of the event. Only present if relevant. (Legal values: BOT_LANE, MID_LANE, TOP_LANE)
     *
     * @ORM\Column(name="lane_type", type="enum_lane_type", nullable=true)
     */
    protected $laneType;

    /**
     * @var string The level up type of the event. Only present if relevant. (Legal values: EVOLVE, NORMAL)
     *
     * @ORM\Column(name="level_up_type", type="enum_level_up_type", nullable=true)
     */
    protected $levelUpType;

    /**
     * @var string The monster type of the event. Only present if relevant. (Legal values: BARON_NASHOR, BLUE_GOLEM, DRAGON, RED_LIZARD, VILEMAW)
     *
     * @ORM\Column(name="monster_type", type="enum_monster_type", nullable=true)
     */
    protected $monsterType;

    /**
     * @var integer The participant ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="participant_id", type="integer", nullable=true)
     */
    protected $participantId;

    /**
     * @var string The point captured in the event. Only present if relevant. (Legal values: POINT_A, POINT_B, POINT_C, POINT_D, POINT_E)
     *
     * @ORM\Column(name="point_captured", type="enum_point_captured", nullable=true)
     */
    protected $pointCaptured;

    /**
     * @var integer The x position of the event. Only present if relevant.
     *
     * @ORM\Column(name="position_x", type="integer", nullable=true)
     */
    protected $positionX;

    /**
     * @var integer The y position of the event. Only present if relevant.
     *
     * @ORM\Column(name="position_y", type="integer", nullable=true)
     */
    protected $positionY;

    /**
     * @var integer The skill slot of the event. Only present if relevant.
     *
     * @ORM\Column(name="skill_slot", type="integer", nullable=true)
     */
    protected $skillSlot;

    /**
     * @var integer The team ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="team_id", type="integer", nullable=true)
     */
    protected $teamId;

    /**
     * @var integer Represents how many milliseconds into the game the event occurred.
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=true)
     */
    protected $timestamp;

    /**
     * @var string The tower type of the event. Only present if relevant. (Legal values: BASE_TURRET, FOUNTAIN_TURRET, INNER_TURRET, NEXUS_TURRET, OUTER_TURRET, UNDEFINED_TURRET)
     *
     * @ORM\Column(name="tower_type", type="enum_tower_type", nullable=true)
     */
    protected $towerType;

    /**
     * @var integer The victim ID of the event. Only present if relevant.
     *
     * @ORM\Column(name="victim_id", type="integer", nullable=true)
     */
    protected $victimId;

    /**
     * @var string The ward type of the event. Only present if relevant. (Legal values: SIGHT_WARD, TEEMO_MUSHROOM, UNDEFINED, VISION_WARD, YELLOW_TRINKET, YELLOW_TRINKET_UPGRADE)
     *
     * @ORM\Column(name="ward_type", type="enum_ward_type", nullable=true)
     */
    protected $wardType;

    /**
     * @var Frame Frame information
     *
     * @ORM\ManyToOne(targetEntity="Frame", inversedBy="events", cascade={"persist"})
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
     * Get ascendedType
     *
     * @return string
     */
    public function getAscendedType()
    {
        return $this->ascendedType;
    }

    /**
     * Set ascendedType
     *
     * @param string $ascendedType
     * @return Event
     */
    public function setAscendedType($ascendedType)
    {
        $this->ascendedType = $ascendedType;

        return $this;
    }

    /**
     * Get assistingParticipantIds
     *
     * @return array
     */
    public function getAssistingParticipantIds()
    {
        return $this->assistingParticipantIds;
    }

    /**
     * Set assistingParticipantIds
     *
     * @param array $assistingParticipantIds
     * @return Event
     */
    public function setAssistingParticipantIds($assistingParticipantIds)
    {
        $this->assistingParticipantIds = $assistingParticipantIds;

        return $this;
    }

    /**
     * Get buildingType
     *
     * @return string
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * Set buildingType
     *
     * @param string $buildingType
     * @return Event
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

    /**
     * Get creatorId
     *
     * @return integer
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set creatorId
     *
     * @param integer $creatorId
     * @return Event
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set eventType
     *
     * @param string $eventType
     * @return Event
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get itemAfter
     *
     * @return integer
     */
    public function getItemAfter()
    {
        return $this->itemAfter;
    }

    /**
     * Set itemAfter
     *
     * @param integer $itemAfter
     * @return Event
     */
    public function setItemAfter($itemAfter)
    {
        $this->itemAfter = $itemAfter;

        return $this;
    }

    /**
     * Get itemBefore
     *
     * @return integer
     */
    public function getItemBefore()
    {
        return $this->itemBefore;
    }

    /**
     * Set itemBefore
     *
     * @param integer $itemBefore
     * @return Event
     */
    public function setItemBefore($itemBefore)
    {
        $this->itemBefore = $itemBefore;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set itemId
     *
     * @param integer $itemId
     * @return Event
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get killerId
     *
     * @return integer
     */
    public function getKillerId()
    {
        return $this->killerId;
    }

    /**
     * Set killerId
     *
     * @param integer $killerId
     * @return Event
     */
    public function setKillerId($killerId)
    {
        $this->killerId = $killerId;

        return $this;
    }

    /**
     * Get laneType
     *
     * @return string
     */
    public function getLaneType()
    {
        return $this->laneType;
    }

    /**
     * Set laneType
     *
     * @param string $laneType
     * @return Event
     */
    public function setLaneType($laneType)
    {
        $this->laneType = $laneType;

        return $this;
    }

    /**
     * Get levelUpType
     *
     * @return string
     */
    public function getLevelUpType()
    {
        return $this->levelUpType;
    }

    /**
     * Set levelUpType
     *
     * @param string $levelUpType
     * @return Event
     */
    public function setLevelUpType($levelUpType)
    {
        $this->levelUpType = $levelUpType;

        return $this;
    }

    /**
     * Get monsterType
     *
     * @return string
     */
    public function getMonsterType()
    {
        return $this->monsterType;
    }

    /**
     * Set monsterType
     *
     * @param string $monsterType
     * @return Event
     */
    public function setMonsterType($monsterType)
    {
        $this->monsterType = $monsterType;

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
     * @return Event
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;

        return $this;
    }

    /**
     * Get pointCaptured
     *
     * @return string
     */
    public function getPointCaptured()
    {
        return $this->pointCaptured;
    }

    /**
     * Set pointCaptured
     *
     * @param string $pointCaptured
     * @return Event
     */
    public function setPointCaptured($pointCaptured)
    {
        $this->pointCaptured = $pointCaptured;

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
     * @return Event
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
     * @return Event
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get skillSlot
     *
     * @return integer
     */
    public function getSkillSlot()
    {
        return $this->skillSlot;
    }

    /**
     * Set skillSlot
     *
     * @param integer $skillSlot
     * @return Event
     */
    public function setSkillSlot($skillSlot)
    {
        $this->skillSlot = $skillSlot;

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
     * @return Event
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Event
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get towerType
     *
     * @return string
     */
    public function getTowerType()
    {
        return $this->towerType;
    }

    /**
     * Set towerType
     *
     * @param string $towerType
     * @return Event
     */
    public function setTowerType($towerType)
    {
        $this->towerType = $towerType;

        return $this;
    }

    /**
     * Get victimId
     *
     * @return integer
     */
    public function getVictimId()
    {
        return $this->victimId;
    }

    /**
     * Set victimId
     *
     * @param integer $victimId
     * @return Event
     */
    public function setVictimId($victimId)
    {
        $this->victimId = $victimId;

        return $this;
    }

    /**
     * Get wardType
     *
     * @return string
     */
    public function getWardType()
    {
        return $this->wardType;
    }

    /**
     * Set wardType
     *
     * @param string $wardType
     * @return Event
     */
    public function setWardType($wardType)
    {
        $this->wardType = $wardType;

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
     * @return Event
     */
    public function setFrame(Frame $frame = null)
    {
        $this->frame = $frame;

        return $this;
    }
}
