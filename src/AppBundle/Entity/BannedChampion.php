<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannedChampion
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BannedChampionRepository")
 */
class BannedChampion
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
     * @var integer Turn during which the champion was banned
     *
     * @ORM\Column(name="pick_turn", type="integer", nullable=true)
     */
    protected $pickTurn;

    /**
     * @var Team Team information
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="bannedChampions", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $team;

    /**
     * @var Champion Champion information
     *
     * @ORM\ManyToOne(targetEntity="Champion", inversedBy="bannedChampions", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $champion;

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
     * Get pickTurn
     *
     * @return integer
     */
    public function getPickTurn()
    {
        return $this->pickTurn;
    }

    /**
     * Set pickTurn
     *
     * @param integer $pickTurn
     * @return BannedChampion
     */
    public function setPickTurn($pickTurn)
    {
        $this->pickTurn = $pickTurn;

        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set team
     *
     * @param Team $team
     * @return BannedChampion
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get champion
     *
     * @return Champion
     */
    public function getChampion()
    {
        return $this->champion;
    }

    /**
     * Set champion
     *
     * @param Champion $champion
     * @return BannedChampion
     */
    public function setChampion(Champion $champion = null)
    {
        $this->champion = $champion;

        return $this;
    }
}
