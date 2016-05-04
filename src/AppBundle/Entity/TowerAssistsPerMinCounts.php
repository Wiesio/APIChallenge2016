<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TowerAssistsPerMinCounts
 *
 * @ORM\Entity
 */
class TowerAssistsPerMinCounts extends ParticipantTimelineData
{
    /**
     * @var ParticipantTimeline Participant timeline information
     * @ORM\OneToOne(targetEntity="ParticipantTimeline", inversedBy="towerAssistsPerMinCounts")
     */
    protected $participantTimeline;
}