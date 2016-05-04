<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaronKillsPerMinCounts
 *
 * @ORM\Entity
 */
class BaronKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="baronKillsPerMinCounts")
     */
    protected $participantTimeline;
}
