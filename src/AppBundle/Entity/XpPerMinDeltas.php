<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XpPerMinDeltas
 *
 * @ORM\Entity
 */
class XpPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="xpPerMinDeltas")
     */
    protected $participantTimeline;
}