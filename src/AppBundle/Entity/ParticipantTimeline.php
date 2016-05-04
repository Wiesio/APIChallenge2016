<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantTimeline
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ParticipantTimelineRepository")
 */
class ParticipantTimeline
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
     * @var string Participant's lane (Legal values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM)
     *
     * @ORM\Column(name="lane", type="enum_lane", nullable=true)
     */
    protected $lane;

    /**
     * @var string Participant's role (Legal values: DUO, NONE, SOLO, DUO_CARRY, DUO_SUPPORT)
     *
     * @ORM\Column(name="role", type="enum_role", nullable=true)
     */
    protected $role;

    /**
     * @var AncientGolemAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="AncientGolemAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $ancientGolemAssistsPerMinCounts;

    /**
     * @var AncientGolemKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="AncientGolemKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $ancientGolemKillsPerMinCounts;

    /**
     * @var AssistedLaneDeathsPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="AssistedLaneDeathsPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $assistedLaneDeathsPerMinDeltas;

    /**
     * @var AssistedLaneKillsPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="AssistedLaneKillsPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $assistedLaneKillsPerMinDeltas;

    /**
     * @var BaronAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="BaronAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $baronAssistsPerMinCounts;

    /**
     * @var BaronKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="BaronKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $baronKillsPerMinCounts;

    /**
     * @var CreepsPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="CreepsPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $creepsPerMinDeltas;

    /**
     * @var CsDiffPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="CsDiffPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $csDiffPerMinDeltas;

    /**
     * @var DamageTakenDiffPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="DamageTakenDiffPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $damageTakenDiffPerMinDeltas;

    /**
     * @var DamageTakenPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="DamageTakenPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $damageTakenPerMinDeltas;

    /**
     * @var DragonAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="DragonAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $dragonAssistsPerMinCounts;

    /**
     * @var DragonKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="DragonKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $dragonKillsPerMinCounts;

    /**
     * @var ElderLizardAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="ElderLizardAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $elderLizardAssistsPerMinCounts;

    /**
     * @var ElderLizardKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="ElderLizardKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $elderLizardKillsPerMinCounts;

    /**
     * @var GoldPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="GoldPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $goldPerMinDeltas;

    /**
     * @var InhibitorAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="InhibitorAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $inhibitorAssistsPerMinCounts;

    /**
     * @var InhibitorKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="InhibitorKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $inhibitorKillsPerMinCounts;

    /**
     * @var TowerAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="TowerAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $towerAssistsPerMinCounts;

    /**
     * @var TowerKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="TowerKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $towerKillsPerMinCounts;

    /**
     * @var TowerKillsPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="TowerKillsPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $towerKillsPerMinDeltas;

    /**
     * @var VilemawAssistsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="VilemawAssistsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $vilemawAssistsPerMinCounts;

    /**
     * @var VilemawKillsPerMinCounts Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="VilemawKillsPerMinCounts", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $vilemawKillsPerMinCounts;

    /**
     * @var WardsPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="WardsPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $wardsPerMinDeltas;

    /**
     * @var XpDiffPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="XpDiffPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $xpDiffPerMinDeltas;

    /**
     * @var XpPerMinDeltas Ancient golem assists per minute timeline counts
     *
     * @ORM\OneToOne(targetEntity="XpPerMinDeltas", mappedBy="participantTimeline", cascade={"all"})
     */
    protected $xpPerMinDeltas;

    /**
     * @var Participant Participant information
     *
     * @ORM\OneToOne(targetEntity="Participant", inversedBy="participantTimeline")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participant;

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
     * Get lane
     *
     * @return string
     */
    public function getLane()
    {
        return $this->lane;
    }

    /**
     * Set lane
     *
     * @param string $lane
     * @return ParticipantTimeline
     */
    public function setLane($lane)
    {
        $this->lane = $lane;

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
     * Set role
     *
     * @param string $role
     * @return ParticipantTimeline
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get ancientGolemAssistsPerMinCounts
     *
     * @return AncientGolemAssistsPerMinCounts
     */
    public function getAncientGolemAssistsPerMinCounts()
    {
        return $this->ancientGolemAssistsPerMinCounts;
    }

    /**
     * Set ancientGolemAssistsPerMinCounts
     *
     * @param AncientGolemAssistsPerMinCounts $ancientGolemAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setAncientGolemAssistsPerMinCounts(AncientGolemAssistsPerMinCounts $ancientGolemAssistsPerMinCounts = null)
    {
        if ($this->ancientGolemAssistsPerMinCounts) {
            $this->ancientGolemAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->ancientGolemAssistsPerMinCounts = $ancientGolemAssistsPerMinCounts;
        if ($ancientGolemAssistsPerMinCounts) {
            $ancientGolemAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get ancientGolemKillsPerMinCounts
     *
     * @return AncientGolemKillsPerMinCounts
     */
    public function getAncientGolemKillsPerMinCounts()
    {
        return $this->ancientGolemKillsPerMinCounts;
    }

    /**
     * Set ancientGolemKillsPerMinCounts
     *
     * @param AncientGolemKillsPerMinCounts $ancientGolemKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setAncientGolemKillsPerMinCounts(AncientGolemKillsPerMinCounts $ancientGolemKillsPerMinCounts = null)
    {
        if ($this->ancientGolemKillsPerMinCounts) {
            $this->ancientGolemKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->ancientGolemKillsPerMinCounts = $ancientGolemKillsPerMinCounts;
        if ($ancientGolemKillsPerMinCounts) {
            $ancientGolemKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get assistedLaneDeathsPerMinDeltas
     *
     * @return AssistedLaneDeathsPerMinDeltas
     */
    public function getAssistedLaneDeathsPerMinDeltas()
    {
        return $this->assistedLaneDeathsPerMinDeltas;
    }

    /**
     * Set assistedLaneDeathsPerMinDeltas
     *
     * @param AssistedLaneDeathsPerMinDeltas $assistedLaneDeathsPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setAssistedLaneDeathsPerMinDeltas(AssistedLaneDeathsPerMinDeltas $assistedLaneDeathsPerMinDeltas = null)
    {
        if ($this->assistedLaneDeathsPerMinDeltas) {
            $this->assistedLaneDeathsPerMinDeltas->setParticipantTimeline(null);
        }
        $this->assistedLaneDeathsPerMinDeltas = $assistedLaneDeathsPerMinDeltas;
        if ($assistedLaneDeathsPerMinDeltas) {
            $assistedLaneDeathsPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get assistedLaneKillsPerMinDeltas
     *
     * @return AssistedLaneKillsPerMinDeltas
     */
    public function getAssistedLaneKillsPerMinDeltas()
    {
        return $this->assistedLaneKillsPerMinDeltas;
    }

    /**
     * Set assistedLaneKillsPerMinDeltas
     *
     * @param AssistedLaneKillsPerMinDeltas $assistedLaneKillsPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setAssistedLaneKillsPerMinDeltas(AssistedLaneKillsPerMinDeltas $assistedLaneKillsPerMinDeltas = null)
    {
        if ($this->assistedLaneKillsPerMinDeltas) {
            $this->assistedLaneKillsPerMinDeltas->setParticipantTimeline(null);
        }
        $this->assistedLaneKillsPerMinDeltas = $assistedLaneKillsPerMinDeltas;
        if ($assistedLaneKillsPerMinDeltas) {
            $assistedLaneKillsPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get baronAssistsPerMinCounts
     *
     * @return BaronAssistsPerMinCounts
     */
    public function getBaronAssistsPerMinCounts()
    {
        return $this->baronAssistsPerMinCounts;
    }

    /**
     * Set baronAssistsPerMinCounts
     *
     * @param BaronAssistsPerMinCounts $baronAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setBaronAssistsPerMinCounts(BaronAssistsPerMinCounts $baronAssistsPerMinCounts = null)
    {
        if ($this->baronAssistsPerMinCounts) {
            $this->baronAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->baronAssistsPerMinCounts = $baronAssistsPerMinCounts;
        if ($baronAssistsPerMinCounts) {
            $baronAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get baronKillsPerMinCounts
     *
     * @return BaronKillsPerMinCounts
     */
    public function getBaronKillsPerMinCounts()
    {
        return $this->baronKillsPerMinCounts;
    }

    /**
     * Set baronKillsPerMinCounts
     *
     * @param BaronKillsPerMinCounts $baronKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setBaronKillsPerMinCounts(BaronKillsPerMinCounts $baronKillsPerMinCounts = null)
    {
        if ($this->baronKillsPerMinCounts) {
            $this->baronKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->baronKillsPerMinCounts = $baronKillsPerMinCounts;
        if ($baronKillsPerMinCounts) {
            $baronKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get creepsPerMinDeltas
     *
     * @return CreepsPerMinDeltas
     */
    public function getCreepsPerMinDeltas()
    {
        return $this->creepsPerMinDeltas;
    }

    /**
     * Set creepsPerMinDeltas
     *
     * @param CreepsPerMinDeltas $creepsPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setCreepsPerMinDeltas(CreepsPerMinDeltas $creepsPerMinDeltas = null)
    {
        if ($this->creepsPerMinDeltas) {
            $this->creepsPerMinDeltas->setParticipantTimeline(null);
        }
        $this->creepsPerMinDeltas = $creepsPerMinDeltas;
        if ($creepsPerMinDeltas) {
            $creepsPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get csDiffPerMinDeltas
     *
     * @return CsDiffPerMinDeltas
     */
    public function getCsDiffPerMinDeltas()
    {
        return $this->csDiffPerMinDeltas;
    }

    /**
     * Set csDiffPerMinDeltas
     *
     * @param CsDiffPerMinDeltas $csDiffPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setCsDiffPerMinDeltas(CsDiffPerMinDeltas $csDiffPerMinDeltas = null)
    {
        if ($this->csDiffPerMinDeltas) {
            $this->csDiffPerMinDeltas->setParticipantTimeline(null);
        }
        $this->csDiffPerMinDeltas = $csDiffPerMinDeltas;
        if ($csDiffPerMinDeltas) {
            $csDiffPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get damageTakenDiffPerMinDeltas
     *
     * @return DamageTakenDiffPerMinDeltas
     */
    public function getDamageTakenDiffPerMinDeltas()
    {
        return $this->damageTakenDiffPerMinDeltas;
    }

    /**
     * Set damageTakenDiffPerMinDeltas
     *
     * @param DamageTakenDiffPerMinDeltas $damageTakenDiffPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setDamageTakenDiffPerMinDeltas(DamageTakenDiffPerMinDeltas $damageTakenDiffPerMinDeltas = null)
    {
        if ($this->damageTakenDiffPerMinDeltas) {
            $this->damageTakenDiffPerMinDeltas->setParticipantTimeline(null);
        }
        $this->damageTakenDiffPerMinDeltas = $damageTakenDiffPerMinDeltas;
        if ($damageTakenDiffPerMinDeltas) {
            $damageTakenDiffPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get damageTakenPerMinDeltas
     *
     * @return DamageTakenPerMinDeltas
     */
    public function getDamageTakenPerMinDeltas()
    {
        return $this->damageTakenPerMinDeltas;
    }

    /**
     * Set damageTakenPerMinDeltas
     *
     * @param DamageTakenPerMinDeltas $damageTakenPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setDamageTakenPerMinDeltas(DamageTakenPerMinDeltas $damageTakenPerMinDeltas = null)
    {
        if ($this->damageTakenPerMinDeltas) {
            $this->damageTakenPerMinDeltas->setParticipantTimeline(null);
        }
        $this->damageTakenPerMinDeltas = $damageTakenPerMinDeltas;
        if ($damageTakenPerMinDeltas) {
            $damageTakenPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get dragonAssistsPerMinCounts
     *
     * @return DragonAssistsPerMinCounts
     */
    public function getDragonAssistsPerMinCounts()
    {
        return $this->dragonAssistsPerMinCounts;
    }

    /**
     * Set dragonAssistsPerMinCounts
     *
     * @param DragonAssistsPerMinCounts $dragonAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setDragonAssistsPerMinCounts(DragonAssistsPerMinCounts $dragonAssistsPerMinCounts = null)
    {
        if ($this->dragonAssistsPerMinCounts) {
            $this->dragonAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->dragonAssistsPerMinCounts = $dragonAssistsPerMinCounts;
        if ($dragonAssistsPerMinCounts) {
            $dragonAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get dragonKillsPerMinCounts
     *
     * @return DragonKillsPerMinCounts
     */
    public function getDragonKillsPerMinCounts()
    {
        return $this->dragonKillsPerMinCounts;
    }

    /**
     * Set dragonKillsPerMinCounts
     *
     * @param DragonKillsPerMinCounts $dragonKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setDragonKillsPerMinCounts(DragonKillsPerMinCounts $dragonKillsPerMinCounts = null)
    {
        if ($this->dragonKillsPerMinCounts) {
            $this->dragonKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->dragonKillsPerMinCounts = $dragonKillsPerMinCounts;
        if ($dragonKillsPerMinCounts) {
            $dragonKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get elderLizardAssistsPerMinCounts
     *
     * @return ElderLizardAssistsPerMinCounts
     */
    public function getElderLizardAssistsPerMinCounts()
    {
        return $this->elderLizardAssistsPerMinCounts;
    }

    /**
     * Set elderLizardAssistsPerMinCounts
     *
     * @param ElderLizardAssistsPerMinCounts $elderLizardAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setElderLizardAssistsPerMinCounts(ElderLizardAssistsPerMinCounts $elderLizardAssistsPerMinCounts = null)
    {
        if ($this->elderLizardAssistsPerMinCounts) {
            $this->elderLizardAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->elderLizardAssistsPerMinCounts = $elderLizardAssistsPerMinCounts;
        if ($elderLizardAssistsPerMinCounts) {
            $elderLizardAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get elderLizardKillsPerMinCounts
     *
     * @return ElderLizardKillsPerMinCounts
     */
    public function getElderLizardKillsPerMinCounts()
    {
        return $this->elderLizardKillsPerMinCounts;
    }

    /**
     * Set elderLizardKillsPerMinCounts
     *
     * @param ElderLizardKillsPerMinCounts $elderLizardKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setElderLizardKillsPerMinCounts(ElderLizardKillsPerMinCounts $elderLizardKillsPerMinCounts = null)
    {
        if ($this->elderLizardKillsPerMinCounts) {
            $this->elderLizardKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->elderLizardKillsPerMinCounts = $elderLizardKillsPerMinCounts;
        if ($elderLizardKillsPerMinCounts) {
            $elderLizardKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get goldPerMinDeltas
     *
     * @return GoldPerMinDeltas
     */
    public function getGoldPerMinDeltas()
    {
        return $this->goldPerMinDeltas;
    }

    /**
     * Set goldPerMinDeltas
     *
     * @param GoldPerMinDeltas $goldPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setGoldPerMinDeltas(GoldPerMinDeltas $goldPerMinDeltas = null)
    {
        if ($this->goldPerMinDeltas) {
            $this->goldPerMinDeltas->setParticipantTimeline(null);
        }
        $this->goldPerMinDeltas = $goldPerMinDeltas;
        if ($goldPerMinDeltas) {
            $goldPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get inhibitorAssistsPerMinCounts
     *
     * @return InhibitorAssistsPerMinCounts
     */
    public function getInhibitorAssistsPerMinCounts()
    {
        return $this->inhibitorAssistsPerMinCounts;
    }

    /**
     * Set inhibitorAssistsPerMinCounts
     *
     * @param InhibitorAssistsPerMinCounts $inhibitorAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setInhibitorAssistsPerMinCounts(InhibitorAssistsPerMinCounts $inhibitorAssistsPerMinCounts = null)
    {
        if ($this->inhibitorAssistsPerMinCounts) {
            $this->inhibitorAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->inhibitorAssistsPerMinCounts = $inhibitorAssistsPerMinCounts;
        if ($inhibitorAssistsPerMinCounts) {
            $inhibitorAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get inhibitorKillsPerMinCounts
     *
     * @return InhibitorKillsPerMinCounts
     */
    public function getInhibitorKillsPerMinCounts()
    {
        return $this->inhibitorKillsPerMinCounts;
    }

    /**
     * Set inhibitorKillsPerMinCounts
     *
     * @param InhibitorKillsPerMinCounts $inhibitorKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setInhibitorKillsPerMinCounts(InhibitorKillsPerMinCounts $inhibitorKillsPerMinCounts = null)
    {
        if ($this->inhibitorKillsPerMinCounts) {
            $this->inhibitorKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->inhibitorKillsPerMinCounts = $inhibitorKillsPerMinCounts;
        if ($inhibitorKillsPerMinCounts) {
            $inhibitorKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get towerAssistsPerMinCounts
     *
     * @return TowerAssistsPerMinCounts
     */
    public function getTowerAssistsPerMinCounts()
    {
        return $this->towerAssistsPerMinCounts;
    }

    /**
     * Set towerAssistsPerMinCounts
     *
     * @param TowerAssistsPerMinCounts $towerAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setTowerAssistsPerMinCounts(TowerAssistsPerMinCounts $towerAssistsPerMinCounts = null)
    {
        if ($this->towerAssistsPerMinCounts) {
            $this->towerAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->towerAssistsPerMinCounts = $towerAssistsPerMinCounts;
        if ($towerAssistsPerMinCounts) {
            $towerAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get towerKillsPerMinCounts
     *
     * @return TowerKillsPerMinCounts
     */
    public function getTowerKillsPerMinCounts()
    {
        return $this->towerKillsPerMinCounts;
    }

    /**
     * Set towerKillsPerMinCounts
     *
     * @param TowerKillsPerMinCounts $towerKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setTowerKillsPerMinCounts(TowerKillsPerMinCounts $towerKillsPerMinCounts = null)
    {
        if ($this->towerKillsPerMinCounts) {
            $this->towerKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->towerKillsPerMinCounts = $towerKillsPerMinCounts;
        if ($towerKillsPerMinCounts) {
            $towerKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get towerKillsPerMinDeltas
     *
     * @return TowerKillsPerMinDeltas
     */
    public function getTowerKillsPerMinDeltas()
    {
        return $this->towerKillsPerMinDeltas;
    }

    /**
     * Set towerKillsPerMinDeltas
     *
     * @param TowerKillsPerMinDeltas $towerKillsPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setTowerKillsPerMinDeltas(TowerKillsPerMinDeltas $towerKillsPerMinDeltas = null)
    {
        if ($this->towerKillsPerMinDeltas) {
            $this->towerKillsPerMinDeltas->setParticipantTimeline(null);
        }
        $this->towerKillsPerMinDeltas = $towerKillsPerMinDeltas;
        if ($towerKillsPerMinDeltas) {
            $towerKillsPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get vilemawAssistsPerMinCounts
     *
     * @return VilemawAssistsPerMinCounts
     */
    public function getVilemawAssistsPerMinCounts()
    {
        return $this->vilemawAssistsPerMinCounts;
    }

    /**
     * Set vilemawAssistsPerMinCounts
     *
     * @param VilemawAssistsPerMinCounts $vilemawAssistsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setVilemawAssistsPerMinCounts(VilemawAssistsPerMinCounts $vilemawAssistsPerMinCounts = null)
    {
        if ($this->vilemawAssistsPerMinCounts) {
            $this->vilemawAssistsPerMinCounts->setParticipantTimeline(null);
        }
        $this->vilemawAssistsPerMinCounts = $vilemawAssistsPerMinCounts;
        if ($vilemawAssistsPerMinCounts) {
            $vilemawAssistsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get vilemawKillsPerMinCounts
     *
     * @return VilemawKillsPerMinCounts
     */
    public function getVilemawKillsPerMinCounts()
    {
        return $this->vilemawKillsPerMinCounts;
    }

    /**
     * Set vilemawKillsPerMinCounts
     *
     * @param VilemawKillsPerMinCounts $vilemawKillsPerMinCounts
     * @return ParticipantTimeline
     */
    public function setVilemawKillsPerMinCounts(VilemawKillsPerMinCounts $vilemawKillsPerMinCounts = null)
    {
        if ($this->vilemawKillsPerMinCounts) {
            $this->vilemawKillsPerMinCounts->setParticipantTimeline(null);
        }
        $this->vilemawKillsPerMinCounts = $vilemawKillsPerMinCounts;
        if ($vilemawKillsPerMinCounts) {
            $vilemawKillsPerMinCounts->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get wardsPerMinDeltas
     *
     * @return WardsPerMinDeltas
     */
    public function getWardsPerMinDeltas()
    {
        return $this->wardsPerMinDeltas;
    }

    /**
     * Set wardsPerMinDeltas
     *
     * @param WardsPerMinDeltas $wardsPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setWardsPerMinDeltas(WardsPerMinDeltas $wardsPerMinDeltas = null)
    {
        if ($this->wardsPerMinDeltas) {
            $this->wardsPerMinDeltas->setParticipantTimeline(null);
        }
        $this->wardsPerMinDeltas = $wardsPerMinDeltas;
        if ($wardsPerMinDeltas) {
            $wardsPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get xpDiffPerMinDeltas
     *
     * @return XpDiffPerMinDeltas
     */
    public function getXpDiffPerMinDeltas()
    {
        return $this->xpDiffPerMinDeltas;
    }

    /**
     * Set xpDiffPerMinDeltas
     *
     * @param XpDiffPerMinDeltas $xpDiffPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setXpDiffPerMinDeltas(XpDiffPerMinDeltas $xpDiffPerMinDeltas = null)
    {
        if ($this->xpDiffPerMinDeltas) {
            $this->xpDiffPerMinDeltas->setParticipantTimeline(null);
        }
        $this->xpDiffPerMinDeltas = $xpDiffPerMinDeltas;
        if ($xpDiffPerMinDeltas) {
            $xpDiffPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get xpPerMinDeltas
     *
     * @return XpPerMinDeltas
     */
    public function getXpPerMinDeltas()
    {
        return $this->xpPerMinDeltas;
    }

    /**
     * Set xpPerMinDeltas
     *
     * @param XpPerMinDeltas $xpPerMinDeltas
     * @return ParticipantTimeline
     */
    public function setXpPerMinDeltas(XpPerMinDeltas $xpPerMinDeltas = null)
    {
        if ($this->xpPerMinDeltas) {
            $this->xpPerMinDeltas->setParticipantTimeline(null);
        }
        $this->xpPerMinDeltas = $xpPerMinDeltas;
        if ($xpPerMinDeltas) {
            $xpPerMinDeltas->setParticipantTimeline($this);
        }

        return $this;
    }

    /**
     * Get participant
     *
     * @return Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set participant
     *
     * @param Participant $participant
     * @return ParticipantTimeline
     */
    public function setParticipant(Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }
}
