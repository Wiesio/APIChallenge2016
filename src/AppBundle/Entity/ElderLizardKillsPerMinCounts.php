<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElderLizardAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class ElderLizardKillsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="elderLizardKillsPerMinCounts")
     */
    protected $participantTimeline;
}