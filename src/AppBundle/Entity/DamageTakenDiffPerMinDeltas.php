<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DamageTakenDiffPerMinDeltas
 *
 * @ORM\Entity
 */
class DamageTakenDiffPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="damageTakenDiffPerMinDeltas")
     */
    protected $participantTimeline;
}
