<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shard
 *
 * @ORM\Table
 * @ORM\Entity
 */
class Shard
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="region_tag", type="string")
     */
    protected $regionTag;

    /**
     * @var array
     *
     * @ORM\Column(name="locales", type="simple_array")
     */
    protected $locales;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="string")
     */
    protected $hostname;


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Shard
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set regionTag
     *
     * @param string $regionTag
     *
     * @return Shard
     */
    public function setRegionTag($regionTag)
    {
        $this->regionTag = $regionTag;

        return $this;
    }

    /**
     * Get regionTag
     *
     * @return string
     */
    public function getRegionTag()
    {
        return $this->regionTag;
    }

    /**
     * Set locales
     *
     * @param array $locales
     *
     * @return Shard
     */
    public function setLocales($locales)
    {
        $this->locales = $locales;

        return $this;
    }

    /**
     * Get locales
     *
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shard
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     *
     * @return Shard
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }
}
