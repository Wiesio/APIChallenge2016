<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mastery
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MasteryRepository")
 */
class Mastery
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
     * @var integer Mastery ID
     *
     * @ORM\Column(name="mastery_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $masteryId;

    /**
     * @var integer Mastery rank
     *
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    protected $rank;

    /**
     * @var Participant Participant information
     *
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="masteries", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participant;

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
     * Get masteryId
     *
     * @return integer
     */
    public function getMasteryId()
    {
        return $this->masteryId;
    }

    /**
     * Set masteryId
     *
     * @param integer $masteryId
     * @return Mastery
     */
    public function setMasteryId($masteryId)
    {
        $this->masteryId = $masteryId;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return Mastery
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get participant
     *
     * @return Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set participant
     *
     * @param Participant $participant
     * @return Mastery
     */
    public function setParticipant(Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }
}
