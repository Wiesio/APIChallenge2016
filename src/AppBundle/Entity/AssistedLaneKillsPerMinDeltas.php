<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AncientGolemAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class AssistedLaneKillsPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="assistedLaneKillsPerMinDeltas")
     */
    protected $participantTimeline;
}
