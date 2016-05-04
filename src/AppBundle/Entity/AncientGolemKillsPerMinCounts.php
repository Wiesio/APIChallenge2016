<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AncientGolemKillsPerMinCounts
 *
 * @ORM\Entity
 */
class AncientGolemKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="ancientGolemKillsPerMinCounts")
     */
    protected $participantTimeline;
}
