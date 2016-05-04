<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TowerKillsPerMinCounts
 *
 * @ORM\Entity
 */
class TowerKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="towerKillsPerMinCounts")
     */
    protected $participantTimeline;
}