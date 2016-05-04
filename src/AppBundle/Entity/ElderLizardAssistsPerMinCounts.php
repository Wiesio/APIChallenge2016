<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElderLizardAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class ElderLizardAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="elderLizardAssistsPerMinCounts")
     */
    protected $participantTimeline;
}