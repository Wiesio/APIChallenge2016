<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssistedLaneDeathsPerMinDeltas
 *
 * @ORM\Entity
 */
class AssistedLaneDeathsPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="assistedLaneDeathsPerMinDeltas")
     */
    protected $participantTimeline;
}
