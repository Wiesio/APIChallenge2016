<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DragonAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class DragonAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="dragonAssistsPerMinCounts")
     */
    protected $participantTimeline;
}
