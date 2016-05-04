<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VilemawAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class VilemawAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="vilemawAssistsPerMinCounts")
     */
    protected $participantTimeline;
}