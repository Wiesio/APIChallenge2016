<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TowerKillsPerMinDeltas
 *
 * @ORM\Entity
 */
class TowerKillsPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="towerKillsPerMinDeltas")
     */
    protected $participantTimeline;
}