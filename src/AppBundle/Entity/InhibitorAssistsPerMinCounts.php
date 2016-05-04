<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InhibitorAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class InhibitorAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="inhibitorAssistsPerMinCounts")
     */
    protected $participantTimeline;
}