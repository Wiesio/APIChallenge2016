<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WardsPerMinDeltas
 *
 * @ORM\Entity
 */
class WardsPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="wardsPerMinDeltas")
     */
    protected $participantTimeline;
}
