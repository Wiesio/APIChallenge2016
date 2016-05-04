<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GoldPerMinDeltas
 *
 * @ORM\Entity
 */
class GoldPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="goldPerMinDeltas")
     */
    protected $participantTimeline;
}