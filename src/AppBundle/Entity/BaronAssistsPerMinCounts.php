<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaronAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class BaronAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="baronAssistsPerMinCounts")
     */
    protected $participantTimeline;
}
