<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreepsPerMinDeltas
 *
 * @ORM\Entity
 */
class CreepsPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="creepsPerMinDeltas")
     */
    protected $participantTimeline;
}
