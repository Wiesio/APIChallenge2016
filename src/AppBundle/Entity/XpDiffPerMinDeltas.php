<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XpDiffPerMinDeltas
 *
 * @ORM\Entity
 */
class XpDiffPerMinDeltas extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="xpDiffPerMinDeltas")
     */
    protected $participantTimeline;
}