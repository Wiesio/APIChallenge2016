<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ViableRole
 *
 * @ORM\Table(indexes={
 *     @ORM\Index(name="championkey_lane_role_idx", columns={"champion_key", "lane", "role"}),
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ViableRoleRepository")
 */
class ViableRole
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
     * @var string Champion key
     *
     * @ORM\Column(name="champion_key", type="string")
     */
    protected $key;

    /**
     * @var string Participant's lane (Legal values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM)
     *
     * @ORM\Column(name="lane", type="enum_lane")
     */
    protected $lane;

    /**
     * @var string Participant's role (Legal values: DUO, NONE, SOLO, DUO_CARRY, DUO_SUPPORT)
     *
     * @ORM\Column(name="role", type="enum_role")
     */
    protected $role;

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
     * Set key
     *
     * @param string $key
     *
     * @return ViableRole
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set lane
     *
     * @param string $lane
     *
     * @return ViableRole
     */
    public function setLane($lane)
    {
        $this->lane = $lane;

        return $this;
    }

    /**
     * Get lane
     *
     * @return string
     */
    public function getLane()
    {
        return $this->lane;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return ViableRole
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
