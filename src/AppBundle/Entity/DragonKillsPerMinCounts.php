<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DragonKillsPerMinCounts
 *
 * @ORM\Entity
 */
class DragonKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="dragonKillsPerMinCounts")
     */
    protected $participantTimeline;
}