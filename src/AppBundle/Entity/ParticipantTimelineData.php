<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantTimelineData
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(type="string", name="type")
 * @ORM\DiscriminatorMap({
 * "AncientGolemAssistsPerMinCounts" = "AncientGolemAssistsPerMinCounts",
 * "AncientGolemKillsPerMinCounts" = "AncientGolemKillsPerMinCounts",
 * "AssistedLaneDeathsPerMinDeltas" = "AssistedLaneDeathsPerMinDeltas",
 * "AssistedLaneKillsPerMinDeltas" = "AssistedLaneKillsPerMinDeltas",
 * "BaronAssistsPerMinCounts" = "BaronAssistsPerMinCounts",
 * "BaronKillsPerMinCounts" = "BaronKillsPerMinCounts",
 * "CreepsPerMinDeltas" = "CreepsPerMinDeltas",
 * "CsDiffPerMinDeltas" = "CsDiffPerMinDeltas",
 * "DamageTakenDiffPerMinDeltas" = "DamageTakenDiffPerMinDeltas",
 * "DamageTakenPerMinDeltas" = "DamageTakenPerMinDeltas",
 * "DragonAssistsPerMinCounts" = "DragonAssistsPerMinCounts",
 * "DragonKillsPerMinCounts" = "DragonKillsPerMinCounts",
 * "ElderLizardAssistsPerMinCounts" = "ElderLizardAssistsPerMinCounts",
 * "ElderLizardKillsPerMinCounts" = "ElderLizardKillsPerMinCounts",
 * "GoldPerMinDeltas" = "GoldPerMinDeltas",
 * "InhibitorAssistsPerMinCounts" = "InhibitorAssistsPerMinCounts",
 * "InhibitorKillsPerMinCounts" = "InhibitorKillsPerMinCounts",
 * "TowerAssistsPerMinCounts" = "TowerAssistsPerMinCounts",
 * "TowerKillsPerMinCounts" = "TowerKillsPerMinCounts",
 * "TowerKillsPerMinDeltas" = "TowerKillsPerMinDeltas",
 * "VilemawAssistsPerMinCounts" = "VilemawAssistsPerMinCounts",
 * "VilemawKillsPerMinCounts" = "VilemawKillsPerMinCounts",
 * "WardsPerMinDeltas" = "WardsPerMinDeltas",
 * "XpDiffPerMinDeltas" = "XpDiffPerMinDeltas",
 * "XpPerMinDeltas" = "XpPerMinDeltas",
 * })
 */
abstract class ParticipantTimelineData
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
     * @var double Value per minute from the beginning of the game to 10 min
     *
     * @ORM\Column(name="zero_to_ten", type="float", nullable=true)
     */
    protected $zeroToTen;

    /**
     * @var double Value per minute from 10 min to 20 min
     *
     * @ORM\Column(name="ten_to_twenty", type="float", nullable=true)
     */
    protected $tenToTwenty;

    /**
     * @var double Value per minute from 20 min to 30 min
     *
     * @ORM\Column(name="twenty_to_thirty", type="float", nullable=true)
     */
    protected $twentyToThirty;

    /**
     * @var double Value per minute from 30 min to the end of the game
     *
     * @ORM\Column(name="thirty_to_end", type="float", nullable=true)
     */
    protected $thirtyToEnd;

    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participantTimeline;

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
     * Get zeroToTen
     *
     * @return float
     */
    public function getZeroToTen()
    {
        return $this->zeroToTen;
    }

    /**
     * Set zeroToTen
     *
     * @param float $zeroToTen
     * @return ParticipantTimelineData
     */
    public function setZeroToTen($zeroToTen)
    {
        $this->zeroToTen = $zeroToTen;

        return $this;
    }

    /**
     * Get tenToTwenty
     *
     * @return float
     */
    public function getTenToTwenty()
    {
        return $this->tenToTwenty;
    }

    /**
     * Set tenToTwenty
     *
     * @param float $tenToTwenty
     * @return ParticipantTimelineData
     */
    public function setTenToTwenty($tenToTwenty)
    {
        $this->tenToTwenty = $tenToTwenty;

        return $this;
    }

    /**
     * Get twentyToThirty
     *
     * @return float
     */
    public function getTwentyToThirty()
    {
        return $this->twentyToThirty;
    }

    /**
     * Set twentyToThirty
     *
     * @param float $twentyToThirty
     * @return ParticipantTimelineData
     */
    public function setTwentyToThirty($twentyToThirty)
    {
        $this->twentyToThirty = $twentyToThirty;

        return $this;
    }

    /**
     * Get thirtyToEnd
     *
     * @return float
     */
    public function getThirtyToEnd()
    {
        return $this->thirtyToEnd;
    }

    /**
     * Set thirtyToEnd
     *
     * @param float $thirtyToEnd
     * @return ParticipantTimelineData
     */
    public function setThirtyToEnd($thirtyToEnd)
    {
        $this->thirtyToEnd = $thirtyToEnd;

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
     * @return ParticipantTimelineData
     */
    public function setParticipantTimeline(ParticipantTimeline $participantTimeline = null)
    {
        $this->participantTimeline = $participantTimeline;

        return $this;
    }
}
