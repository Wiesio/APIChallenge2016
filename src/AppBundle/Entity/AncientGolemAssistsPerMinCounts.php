<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AncientGolemAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class AncientGolemAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="ancientGolemAssistsPerMinCounts")
     *
     */
    protected $participantTimeline;
}
