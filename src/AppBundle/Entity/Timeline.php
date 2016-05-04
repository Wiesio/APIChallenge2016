<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Timeline
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TimelineRepository")
 */
class Timeline
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
     * @var integer Time between each returned frame in milliseconds.
     *
     * @ORM\Column(name="frame_interval", type="integer", nullable=true)
     */
    protected $frameInterval;

    /**
     * @var ArrayCollection[Frame] List of timeline frames for the game.
     *
     * @ORM\OneToMany(targetEntity="Frame", mappedBy="timeline", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $frames;

    /**
     * @var MatchDetail Match detail information
     *
     * @ORM\OneToOne(targetEntity="MatchDetail", inversedBy="timeline", cascade={"persist"})
     * @ORM\JoinColumn(name="match_detail_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $matchDetail;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->frames = new ArrayCollection();
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
     * Get frameInterval
     *
     * @return integer
     */
    public function getFrameInterval()
    {
        return $this->frameInterval;
    }

    /**
     * Set frameInterval
     *
     * @param integer $frameInterval
     * @return Timeline
     */
    public function setFrameInterval($frameInterval)
    {
        $this->frameInterval = $frameInterval;

        return $this;
    }

    /**
     * Add frames
     *
     * @param Frame $frames
     * @return Timeline
     */
    public function addFrame(Frame $frames)
    {
        $this->frames[] = $frames;
        $frames->setTimeline($this);

        return $this;
    }

    /**
     * Remove frames
     *
     * @param Frame $frames
     */
    public function removeFrame(Frame $frames)
    {
        $this->frames->removeElement($frames);
        $frames->setTimeline(null);
    }

    /**
     * Get frames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrames()
    {
        return $this->frames;
    }

    /**
     * Get matchDetail
     *
     * @return MatchDetail
     */
    public function getMatchDetail()
    {
        return $this->matchDetail;
    }

    /**
     * Set matchDetail
     *
     * @param MatchDetail $matchDetail
     * @return Timeline
     */
    public function setMatchDetail(MatchDetail $matchDetail = null)
    {
        $this->matchDetail = $matchDetail;

        return $this;
    }
}
