<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rune
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RuneRepository")
 */
class Rune
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
     * @var integer Rune rank
     *
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    protected $rank;

    /**
     * @var integer Rune ID
     *
     * @ORM\Column(name="rune_id", type="integer", nullable=true)
     */
    protected $runeId;

    /**
     * @var Participant Participant information
     *
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="runes", cascade={"persist"})
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
     * @return Rune
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get runeId
     *
     * @return integer
     */
    public function getRuneId()
    {
        return $this->runeId;
    }

    /**
     * Set runeId
     *
     * @param integer $runeId
     * @return Rune
     */
    public function setRuneId($runeId)
    {
        $this->runeId = $runeId;

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
     * @return Rune
     */
    public function setParticipant(Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }
}
