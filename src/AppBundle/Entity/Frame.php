<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Frame
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\FrameRepository")
 */
class Frame
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=true)
     */
    protected $timestamp;

    /**
     * @var Timeline Timeline information
     *
     * @ORM\ManyToOne(targetEntity="Timeline", inversedBy="frames", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $timeline;

    /**
     * @var ArrayCollection[Event] List of events for this frame
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="frame", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $events;

    /**
     * @var ArrayCollection[ParticipantFrame] Map of each participant ID to the participant's information for the frame
     *
     * @ORM\OneToMany(targetEntity="ParticipantFrame", mappedBy="frame", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participantFrames;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->participantFrames = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Frame
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timeline
     *
     * @return Timeline
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * Set timeline
     *
     * @param Timeline $timeline
     * @return Frame
     */
    public function setTimeline(Timeline $timeline = null)
    {
        $this->timeline = $timeline;

        return $this;
    }

    /**
     * Add events
     *
     * @param Event $events
     * @return Frame
     */
    public function addEvent(Event $events)
    {
        $this->events[] = $events;
        $events->setFrame($this);

        return $this;
    }

    /**
     * Remove events
     *
     * @param Event $events
     */
    public function removeEvent(Event $events)
    {
        $this->events->removeElement($events);
        $events->setFrame(null);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add participantFrames
     *
     * @param ParticipantFrame $participantFrames
     * @return Frame
     */
    public function addParticipantFrame(ParticipantFrame $participantFrames)
    {
        $this->participantFrames[] = $participantFrames;
        $participantFrames->setFrame($this);

        return $this;
    }

    /**
     * Remove participantFrames
     *
     * @param ParticipantFrame $participantFrames
     */
    public function removeParticipantFrame(ParticipantFrame $participantFrames)
    {
        $this->participantFrames->removeElement($participantFrames);
        $participantFrames->setFrame(null);
    }

    /**
     * Get participantFrames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipantFrames()
    {
        return $this->participantFrames;
    }
}
