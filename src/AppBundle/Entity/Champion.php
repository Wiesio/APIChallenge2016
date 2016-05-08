<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Champion
 *
 * @ORM\Table(indexes={
 *     @ORM\Index(name="championkey_region_idx", columns={"champion_key", "region"}),
 *     @ORM\Index(name="name_region_idx", columns={"name", "region"}),
 *     @ORM\Index(name="championid_region_idx", columns={"champion_id", "region"}),
 *     @ORM\Index(name="region_idx", columns={"region"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChampionRepository")
 */
class Champion
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
     * @var integer Champion ID
     *
     * @ORM\Column(name="champion_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    protected $championId;

    /**
     * @var string Region ID
     *
     * @ORM\Column(name="region", type="string", nullable=true)
     */
    protected $region;

    /**
     * @var boolean Indicates if the champion is active.
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active;

    /**
     * @var boolean Bot enabled flag (for custom games).
     *
     * @ORM\Column(name="bot_enabled", type="boolean", nullable=true)
     */
    protected $botEnabled;

    /**
     * @var boolean Bot Match Made enabled flag (for Co-op vs. AI games).
     *
     * @ORM\Column(name="bot_mm_enabled", type="boolean", nullable=true)
     */
    protected $botMmEnabled;

    /**
     * @var boolean Indicates if the champion is free to play. Free to play champions are rotated periodically.
     *
     * @ORM\Column(name="free_to_play", type="boolean", nullable=true)
     */
    protected $freeToPlay;

    /**
     * @var boolean Ranked play enabled flag.
     *
     * @ORM\Column(name="ranked_play_enabled", type="boolean", nullable=true)
     */
    protected $rankedPlayEnabled;

    /**
     * @var string Champion name
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string Champion title
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string Champion key
     *
     * @ORM\Column(name="champion_key", type="string", nullable=true)
     */
    protected $key;

    /**
     * @var object Champion image data as JSON string
     *
     * @ORM\Column(name="image", type="json_array", nullable=true)
     */
    protected $image;

    /**
     * @var Collection|ChampionMastery[]
     *
     * @ORM\OneToMany(targetEntity="ChampionMastery", mappedBy="champion")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $championMasteries;

    /**
     * @var Collection|MatchReference[] Match Reference information
     *
     * @ORM\OneToMany(targetEntity="MatchReference", mappedBy="champion", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $matchReferences;

    /**
     * @var Collection|Participant[] Participant information
     *
     * @ORM\OneToMany(targetEntity="Participant", mappedBy="champion", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $participants;

    /**
     * @var Collection|BannedChampion[] Champion Ban information
     *
     * @ORM\OneToMany(targetEntity="BannedChampion", mappedBy="champion", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $bannedChampions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->championMasteries = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->bannedChampions = new ArrayCollection();
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
     * Get championId
     *
     * @return integer
     */
    public function getChampionId()
    {
        return $this->championId;
    }

    /**
     * Set championId
     *
     * @param integer $championId
     * @return Champion
     */
    public function setChampionId($championId)
    {
        $this->championId = $championId;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Champion
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Champion
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set botEnabled
     *
     * @param boolean $botEnabled
     *
     * @return Champion
     */
    public function setBotEnabled($botEnabled)
    {
        $this->botEnabled = $botEnabled;

        return $this;
    }

    /**
     * Get botEnabled
     *
     * @return boolean
     */
    public function getBotEnabled()
    {
        return $this->botEnabled;
    }

    /**
     * Set botMmEnabled
     *
     * @param boolean $botMmEnabled
     *
     * @return Champion
     */
    public function setBotMmEnabled($botMmEnabled)
    {
        $this->botMmEnabled = $botMmEnabled;

        return $this;
    }

    /**
     * Get botMmEnabled
     *
     * @return boolean
     */
    public function getBotMmEnabled()
    {
        return $this->botMmEnabled;
    }

    /**
     * Set freeToPlay
     *
     * @param boolean $freeToPlay
     *
     * @return Champion
     */
    public function setFreeToPlay($freeToPlay)
    {
        $this->freeToPlay = $freeToPlay;

        return $this;
    }

    /**
     * Get freeToPlay
     *
     * @return boolean
     */
    public function getFreeToPlay()
    {
        return $this->freeToPlay;
    }

    /**
     * Set rankedPlayEnabled
     *
     * @param boolean $rankedPlayEnabled
     *
     * @return Champion
     */
    public function setRankedPlayEnabled($rankedPlayEnabled)
    {
        $this->rankedPlayEnabled = $rankedPlayEnabled;

        return $this;
    }

    /**
     * Get rankedPlayEnabled
     *
     * @return boolean
     */
    public function getRankedPlayEnabled()
    {
        return $this->rankedPlayEnabled;
    }

    /**
     * Add championMastery
     *
     * @param ChampionMastery $championMastery
     *
     * @return Champion
     */
    public function addChampionMastery(ChampionMastery $championMastery)
    {
        $this->championMasteries[] = $championMastery;
        $championMastery->setChampion($this);

        return $this;
    }

    /**
     * Remove championMastery
     *
     * @param ChampionMastery $championMastery
     */
    public function removeChampionMastery(ChampionMastery $championMastery)
    {
        $this->championMasteries->removeElement($championMastery);
        $championMastery->setChampion(null);
    }

    /**
     * Get championMasteries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChampionMasteries()
    {
        return $this->championMasteries;
    }

    /**
     * Add matchReference
     *
     * @param MatchReference $matchReference
     *
     * @return Champion
     */
    public function addMatchReference(MatchReference $matchReference)
    {
        $this->matchReferences[] = $matchReference;
        $matchReference->setChampion($this);

        return $this;
    }

    /**
     * Remove matchReference
     *
     * @param MatchReference $matchReference
     */
    public function removeMatchReference(MatchReference $matchReference)
    {
        $this->matchReferences->removeElement($matchReference);
        $matchReference->setChampion(null);
    }

    /**
     * Get matchReferences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchReferences()
    {
        return $this->matchReferences;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Champion
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
     * Set title
     *
     * @param string $title
     *
     * @return Champion
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return Champion
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
     * Set image
     *
     * @param object $image
     *
     * @return Champion
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return object
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\Participant $participant
     *
     * @return Champion
     */
    public function addParticipant(\AppBundle\Entity\Participant $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\Participant $participant
     */
    public function removeParticipant(\AppBundle\Entity\Participant $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Add bannedChampion
     *
     * @param \AppBundle\Entity\BannedChampion $bannedChampion
     *
     * @return Champion
     */
    public function addBannedChampion(\AppBundle\Entity\BannedChampion $bannedChampion)
    {
        $this->bannedChampions[] = $bannedChampion;

        return $this;
    }

    /**
     * Remove bannedChampion
     *
     * @param \AppBundle\Entity\BannedChampion $bannedChampion
     */
    public function removeBannedChampion(\AppBundle\Entity\BannedChampion $bannedChampion)
    {
        $this->bannedChampions->removeElement($bannedChampion);
    }

    /**
     * Get bannedChampions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBannedChampions()
    {
        return $this->bannedChampions;
    }
}
