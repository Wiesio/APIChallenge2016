<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InhibitorKillsPerMinCounts
 *
 * @ORM\Entity
 */
class InhibitorKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="inhibitorKillsPerMinCounts")
     */
    protected $participantTimeline;
}