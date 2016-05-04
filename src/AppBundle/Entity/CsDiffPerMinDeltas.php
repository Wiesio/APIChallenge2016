<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AncientGolemAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class CsDiffPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="csDiffPerMinDeltas")
     */
    protected $participantTimeline;
}
