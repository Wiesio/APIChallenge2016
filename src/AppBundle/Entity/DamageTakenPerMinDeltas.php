<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DamageTakenPerMinDeltas
 *
 * @ORM\Entity
 */
class DamageTakenPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="damageTakenPerMinDeltas")
     */
    protected $participantTimeline;
}
