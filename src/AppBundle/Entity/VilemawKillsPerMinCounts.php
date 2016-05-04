<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VilemawKillsPerMinCounts
 *
 * @ORM\Entity
 */
class VilemawKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="vilemawKillsPerMinCounts")
     */
    protected $participantTimeline;
}
