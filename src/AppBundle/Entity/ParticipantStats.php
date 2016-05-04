<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantStats
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ParticipantStatsRepository")
 */
class ParticipantStats
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
     * @var integer Number of assists
     *
     * @ORM\Column(name="assists", type="integer", nullable=true)
     */
    protected $assists;

    /**
     * @var integer Champion level achieved
     *
     * @ORM\Column(name="champ_level", type="integer", nullable=true)
     */
    protected $champLevel;

    /**
     * @var integer If game was a dominion game, player's combat score, otherwise 0
     *
     * @ORM\Column(name="combat_player_score", type="integer", nullable=true)
     */
    protected $combatPlayerScore;

    /**
     * @var integer Number of deaths
     *
     * @ORM\Column(name="deaths", type="integer", nullable=true)
     */
    protected $deaths;

    /**
     * @var integer Number of double kills
     *
     * @ORM\Column(name="double_kills", type="integer", nullable=true)
     */
    protected $doubleKills;

    /**
     * @var boolean Flag indicating if participant got an assist on first blood
     *
     * @ORM\Column(name="first_blood_assist", type="boolean", nullable=true)
     */
    protected $firstBloodAssist;

    /**
     * @var boolean Flag indicating if participant got first blood
     *
     * @ORM\Column(name="first_blood_kill", type="boolean", nullable=true)
     */
    protected $firstBloodKill;

    /**
     * @var boolean Flag indicating if participant got an assist on the first inhibitor
     *
     * @ORM\Column(name="first_inhibitor_assist", type="boolean", nullable=true)
     */
    protected $firstInhibitorAssist;

    /**
     * @var boolean Flag indicating if participant destroyed the first inhibitor
     *
     * @ORM\Column(name="first_inhibitor_kill", type="boolean", nullable=true)
     */
    protected $firstInhibitorKill;

    /**
     * @var boolean Flag indicating if participant got an assist on the first tower
     *
     * @ORM\Column(name="first_tower_assist", type="boolean", nullable=true)
     */
    protected $firstTowerAssist;

    /**
     * @var boolean Flag indicating if participant destroyed the first tower
     *
     * @ORM\Column(name="first_tower_kill", type="boolean", nullable=true)
     */
    protected $firstTowerKill;

    /**
     * @var integer Gold earned
     *
     * @ORM\Column(name="gold_earned", type="integer", nullable=true)
     */
    protected $goldEarned;

    /**
     * @var integer Gold spent
     *
     * @ORM\Column(name="gold_spent", type="integer", nullable=true)
     */
    protected $goldSpent;

    /**
     * @var integer Number of inhibitor kills
     *
     * @ORM\Column(name="inhibitor_kills", type="integer", nullable=true)
     */
    protected $inhibitorKills;

    /**
     * @var integer First item ID
     *
     * @ORM\Column(name="item0", type="integer", nullable=true)
     */
    protected $item0;

    /**
     * @var integer Second item ID
     *
     * @ORM\Column(name="item1", type="integer", nullable=true)
     */
    protected $item1;

    /**
     * @var integer Third item ID
     *
     * @ORM\Column(name="item2", type="integer", nullable=true)
     */
    protected $item2;

    /**
     * @var integer Fourth item ID
     *
     * @ORM\Column(name="item3", type="integer", nullable=true)
     */
    protected $item3;

    /**
     * @var integer Fifth item ID
     *
     * @ORM\Column(name="item4", type="integer", nullable=true)
     */
    protected $item4;

    /**
     * @var integer Sixth item ID
     *
     * @ORM\Column(name="item5", type="integer", nullable=true)
     */
    protected $item5;

    /**
     * @var integer Seventh item ID
     *
     * @ORM\Column(name="item6", type="integer", nullable=true)
     */
    protected $item6;

    /**
     * @var integer Number of killing sprees
     *
     * @ORM\Column(name="killing_sprees", type="integer", nullable=true)
     */
    protected $killingSprees;

    /**
     * @var integer Number of kills
     *
     * @ORM\Column(name="kills", type="integer", nullable=true)
     */
    protected $kills;

    /**
     * @var integer Largest critical strike
     *
     * @ORM\Column(name="largest_critical_strike", type="integer", nullable=true)
     */
    protected $largestCriticalStrike;

    /**
     * @var integer Largest killing spree
     *
     * @ORM\Column(name="largest_killing_spree", type="integer", nullable=true)
     */
    protected $largestKillingSpree;

    /**
     * @var integer Largest multi kill
     *
     * @ORM\Column(name="largest_multi_kill", type="integer", nullable=true)
     */
    protected $largestMultiKill;

    /**
     * @var integer Magical damage dealt
     *
     * @ORM\Column(name="magic_damage_dealt", type="integer", nullable=true)
     */
    protected $magicDamageDealt;

    /**
     * @var integer Magical damage dealt to champions
     *
     * @ORM\Column(name="magic_damage_dealt_to_champions", type="integer", nullable=true)
     */
    protected $magicDamageDealtToChampions;

    /**
     * @var integer Magic damage taken
     *
     * @ORM\Column(name="magic_damage_taken", type="integer", nullable=true)
     */
    protected $magicDamageTaken;

    /**
     * @var integer Minions killed
     *
     * @ORM\Column(name="minions_killed", type="integer", nullable=true)
     */
    protected $minionsKilled;

    /**
     * @var integer Neutral minions killed
     *
     * @ORM\Column(name="neutral_minions_killed", type="integer", nullable=true)
     */
    protected $neutralMinionsKilled;

    /**
     * @var integer Neutral jungle minions killed in the enemy team's jungle
     *
     * @ORM\Column(name="neutral_minions_killed_enemy_jungle", type="integer", nullable=true)
     */
    protected $neutralMinionsKilledEnemyJungle;

    /**
     * @var integer Neutral jungle minions killed in your team's jungle
     *
     * @ORM\Column(name="neutral_minions_killed_team_jungle", type="integer", nullable=true)
     */
    protected $neutralMinionsKilledTeamJungle;

    /**
     * @var integer If game was a dominion game, number of node captures
     *
     * @ORM\Column(name="node_capture", type="integer", nullable=true)
     */
    protected $nodeCapture;

    /**
     * @var integer If game was a dominion game, number of node capture assists
     *
     * @ORM\Column(name="node_capture_assist", type="integer", nullable=true)
     */
    protected $nodeCaptureAssist;

    /**
     * @var integer If game was a dominion game, number of node neutralizations
     *
     * @ORM\Column(name="node_neutralize", type="integer", nullable=true)
     */
    protected $nodeNeutralize;

    /**
     * @var integer If game was a dominion game, number of node neutralization assists
     *
     * @ORM\Column(name="node_neutralize_assist", type="integer", nullable=true)
     */
    protected $nodeNeutralizeAssist;

    /**
     * @var integer If game was a dominion game, player's objectives score, otherwise 0
     *
     * @ORM\Column(name="objective_player_score", type="integer", nullable=true)
     */
    protected $objectivePlayerScore;

    /**
     * @var integer Number of penta kills
     *
     * @ORM\Column(name="penta_kills", type="integer", nullable=true)
     */
    protected $pentaKills;

    /**
     * @var integer Physical damage dealt
     *
     * @ORM\Column(name="physical_damage_dealt", type="integer", nullable=true)
     */
    protected $physicalDamageDealt;

    /**
     * @var integer Physical damage dealt to champions
     *
     * @ORM\Column(name="physical_damage_dealt_to_champions", type="integer", nullable=true)
     */
    protected $physicalDamageDealtToChampions;

    /**
     * @var integer Physical damage taken
     *
     * @ORM\Column(name="physical_damage_taken", type="integer", nullable=true)
     */
    protected $physicalDamageTaken;

    /**
     * @var integer Number of quadra kills
     *
     * @ORM\Column(name="quadra_kills", type="integer", nullable=true)
     */
    protected $quadraKills;

    /**
     * @var integer Sight wards purchased
     *
     * @ORM\Column(name="sight_wards_bought_in_game", type="integer", nullable=true)
     */
    protected $sightWardsBoughtInGame;

    /**
     * @var integer If game was a dominion game, number of completed team objectives (i.e., quests)
     *
     * @ORM\Column(name="team_objective", type="integer", nullable=true)
     */
    protected $teamObjective;

    /**
     * @var integer Total damage dealt
     *
     * @ORM\Column(name="total_damage_dealt", type="integer", nullable=true)
     */
    protected $totalDamageDealt;

    /**
     * @var integer Total damage dealt to champions
     *
     * @ORM\Column(name="total_damage_dealt_to_champions", type="integer", nullable=true)
     */
    protected $totalDamageDealtToChampions;

    /**
     * @var integer Total damage taken
     *
     * @ORM\Column(name="total_damage_taken", type="integer", nullable=true)
     */
    protected $totalDamageTaken;

    /**
     * @var integer Total heal amount
     *
     * @ORM\Column(name="total_heal", type="integer", nullable=true)
     */
    protected $totalHeal;

    /**
     * @var integer If game was a dominion game, player's total score, otherwise 0
     *
     * @ORM\Column(name="total_player_score", type="integer", nullable=true)
     */
    protected $totalPlayerScore;

    /**
     * @var integer If game was a dominion game, team rank of the player's total score (e.g., 1-5)
     *
     * @ORM\Column(name="total_score_rank", type="integer", nullable=true)
     */
    protected $totalScoreRank;

    /**
     * @var integer Total dealt crowd control time
     *
     * @ORM\Column(name="total_time_crowd_control_dealt", type="integer", nullable=true)
     */
    protected $totalTimeCrowdControlDealt;

    /**
     * @var integer Total units healed
     *
     * @ORM\Column(name="total_units_healed", type="integer", nullable=true)
     */
    protected $totalUnitsHealed;

    /**
     * @var integer Number of tower kills
     *
     * @ORM\Column(name="tower_kills", type="integer", nullable=true)
     */
    protected $towerKills;

    /**
     * @var integer Number of triple kills
     *
     * @ORM\Column(name="triple_kills", type="integer", nullable=true)
     */
    protected $tripleKills;

    /**
     * @var integer True damage dealt
     *
     * @ORM\Column(name="true_damage_dealt", type="integer", nullable=true)
     */
    protected $trueDamageDealt;

    /**
     * @var integer True damage dealt to champions
     *
     * @ORM\Column(name="true_damage_dealt_to_champions", type="integer", nullable=true)
     */
    protected $trueDamageDealtToChampions;

    /**
     * @var integer True damage taken
     *
     * @ORM\Column(name="true_damage_taken", type="integer", nullable=true)
     */
    protected $trueDamageTaken;

    /**
     * @var integer Number of unreal kills
     *
     * @ORM\Column(name="unreal_kills", type="integer", nullable=true)
     */
    protected $unrealKills;

    /**
     * @var integer Vision wards purchased
     *
     * @ORM\Column(name="vision_wards_bought_in_game", type="integer", nullable=true)
     */
    protected $visionWardsBoughtInGame;

    /**
     * @var integer Number of wards killed
     *
     * @ORM\Column(name="wards_killed", type="integer", nullable=true)
     */
    protected $wardsKilled;

    /**
     * @var integer Number of wards placed
     *
     * @ORM\Column(name="wards_placed", type="integer", nullable=true)
     */
    protected $wardsPlaced;

    /**
     * @var boolean Flag indicating whether or not the participant won
     *
     * @ORM\Column(name="winner", type="boolean", nullable=true)
     */
    protected $winner;

    /**
     * @var Participant Participant information
     *
     * @ORM\OneToOne(targetEntity="Participant", inversedBy="participantStats", cascade={"persist"})
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Get assists
     *
     * @return integer
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     * @return ParticipantStats
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get champLevel
     *
     * @return integer
     */
    public function getChampLevel()
    {
        return $this->champLevel;
    }

    /**
     * Set champLevel
     *
     * @param integer $champLevel
     * @return ParticipantStats
     */
    public function setChampLevel($champLevel)
    {
        $this->champLevel = $champLevel;

        return $this;
    }

    /**
     * Get combatPlayerScore
     *
     * @return integer
     */
    public function getCombatPlayerScore()
    {
        return $this->combatPlayerScore;
    }

    /**
     * Set combatPlayerScore
     *
     * @param integer $combatPlayerScore
     * @return ParticipantStats
     */
    public function setCombatPlayerScore($combatPlayerScore)
    {
        $this->combatPlayerScore = $combatPlayerScore;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return integer
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     * @return ParticipantStats
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get doubleKills
     *
     * @return integer
     */
    public function getDoubleKills()
    {
        return $this->doubleKills;
    }

    /**
     * Set doubleKills
     *
     * @param integer $doubleKills
     * @return ParticipantStats
     */
    public function setDoubleKills($doubleKills)
    {
        $this->doubleKills = $doubleKills;

        return $this;
    }

    /**
     * Get firstBloodAssist
     *
     * @return boolean
     */
    public function getFirstBloodAssist()
    {
        return $this->firstBloodAssist;
    }

    /**
     * Set firstBloodAssist
     *
     * @param boolean $firstBloodAssist
     * @return ParticipantStats
     */
    public function setFirstBloodAssist($firstBloodAssist)
    {
        $this->firstBloodAssist = $firstBloodAssist;

        return $this;
    }

    /**
     * Get firstBloodKill
     *
     * @return boolean
     */
    public function getFirstBloodKill()
    {
        return $this->firstBloodKill;
    }

    /**
     * Set firstBloodKill
     *
     * @param boolean $firstBloodKill
     * @return ParticipantStats
     */
    public function setFirstBloodKill($firstBloodKill)
    {
        $this->firstBloodKill = $firstBloodKill;

        return $this;
    }

    /**
     * Get firstInhibitorAssist
     *
     * @return boolean
     */
    public function getFirstInhibitorAssist()
    {
        return $this->firstInhibitorAssist;
    }

    /**
     * Set firstInhibitorAssist
     *
     * @param boolean $firstInhibitorAssist
     * @return ParticipantStats
     */
    public function setFirstInhibitorAssist($firstInhibitorAssist)
    {
        $this->firstInhibitorAssist = $firstInhibitorAssist;

        return $this;
    }

    /**
     * Get firstInhibitorKill
     *
     * @return boolean
     */
    public function getFirstInhibitorKill()
    {
        return $this->firstInhibitorKill;
    }

    /**
     * Set firstInhibitorKill
     *
     * @param boolean $firstInhibitorKill
     * @return ParticipantStats
     */
    public function setFirstInhibitorKill($firstInhibitorKill)
    {
        $this->firstInhibitorKill = $firstInhibitorKill;

        return $this;
    }

    /**
     * Get firstTowerAssist
     *
     * @return boolean
     */
    public function getFirstTowerAssist()
    {
        return $this->firstTowerAssist;
    }

    /**
     * Set firstTowerAssist
     *
     * @param boolean $firstTowerAssist
     * @return ParticipantStats
     */
    public function setFirstTowerAssist($firstTowerAssist)
    {
        $this->firstTowerAssist = $firstTowerAssist;

        return $this;
    }

    /**
     * Get firstTowerKill
     *
     * @return boolean
     */
    public function getFirstTowerKill()
    {
        return $this->firstTowerKill;
    }

    /**
     * Set firstTowerKill
     *
     * @param boolean $firstTowerKill
     * @return ParticipantStats
     */
    public function setFirstTowerKill($firstTowerKill)
    {
        $this->firstTowerKill = $firstTowerKill;

        return $this;
    }

    /**
     * Get goldEarned
     *
     * @return integer
     */
    public function getGoldEarned()
    {
        return $this->goldEarned;
    }

    /**
     * Set goldEarned
     *
     * @param integer $goldEarned
     * @return ParticipantStats
     */
    public function setGoldEarned($goldEarned)
    {
        $this->goldEarned = $goldEarned;

        return $this;
    }

    /**
     * Get goldSpent
     *
     * @return integer
     */
    public function getGoldSpent()
    {
        return $this->goldSpent;
    }

    /**
     * Set goldSpent
     *
     * @param integer $goldSpent
     * @return ParticipantStats
     */
    public function setGoldSpent($goldSpent)
    {
        $this->goldSpent = $goldSpent;

        return $this;
    }

    /**
     * Get inhibitorKills
     *
     * @return integer
     */
    public function getInhibitorKills()
    {
        return $this->inhibitorKills;
    }

    /**
     * Set inhibitorKills
     *
     * @param integer $inhibitorKills
     * @return ParticipantStats
     */
    public function setInhibitorKills($inhibitorKills)
    {
        $this->inhibitorKills = $inhibitorKills;

        return $this;
    }

    /**
     * Get item0
     *
     * @return integer
     */
    public function getItem0()
    {
        return $this->item0;
    }

    /**
     * Set item0
     *
     * @param integer $item0
     * @return ParticipantStats
     */
    public function setItem0($item0)
    {
        $this->item0 = $item0;

        return $this;
    }

    /**
     * Get item1
     *
     * @return integer
     */
    public function getItem1()
    {
        return $this->item1;
    }

    /**
     * Set item1
     *
     * @param integer $item1
     * @return ParticipantStats
     */
    public function setItem1($item1)
    {
        $this->item1 = $item1;

        return $this;
    }

    /**
     * Get item2
     *
     * @return integer
     */
    public function getItem2()
    {
        return $this->item2;
    }

    /**
     * Set item2
     *
     * @param integer $item2
     * @return ParticipantStats
     */
    public function setItem2($item2)
    {
        $this->item2 = $item2;

        return $this;
    }

    /**
     * Get item3
     *
     * @return integer
     */
    public function getItem3()
    {
        return $this->item3;
    }

    /**
     * Set item3
     *
     * @param integer $item3
     * @return ParticipantStats
     */
    public function setItem3($item3)
    {
        $this->item3 = $item3;

        return $this;
    }

    /**
     * Get item4
     *
     * @return integer
     */
    public function getItem4()
    {
        return $this->item4;
    }

    /**
     * Set item4
     *
     * @param integer $item4
     * @return ParticipantStats
     */
    public function setItem4($item4)
    {
        $this->item4 = $item4;

        return $this;
    }

    /**
     * Get item5
     *
     * @return integer
     */
    public function getItem5()
    {
        return $this->item5;
    }

    /**
     * Set item5
     *
     * @param integer $item5
     * @return ParticipantStats
     */
    public function setItem5($item5)
    {
        $this->item5 = $item5;

        return $this;
    }

    /**
     * Get item6
     *
     * @return integer
     */
    public function getItem6()
    {
        return $this->item6;
    }

    /**
     * Set item6
     *
     * @param integer $item6
     * @return ParticipantStats
     */
    public function setItem6($item6)
    {
        $this->item6 = $item6;

        return $this;
    }

    /**
     * Get killingSprees
     *
     * @return integer
     */
    public function getKillingSprees()
    {
        return $this->killingSprees;
    }

    /**
     * Set killingSprees
     *
     * @param integer $killingSprees
     * @return ParticipantStats
     */
    public function setKillingSprees($killingSprees)
    {
        $this->killingSprees = $killingSprees;

        return $this;
    }

    /**
     * Get kills
     *
     * @return integer
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     * @return ParticipantStats
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get largestCriticalStrike
     *
     * @return integer
     */
    public function getLargestCriticalStrike()
    {
        return $this->largestCriticalStrike;
    }

    /**
     * Set largestCriticalStrike
     *
     * @param integer $largestCriticalStrike
     * @return ParticipantStats
     */
    public function setLargestCriticalStrike($largestCriticalStrike)
    {
        $this->largestCriticalStrike = $largestCriticalStrike;

        return $this;
    }

    /**
     * Get largestKillingSpree
     *
     * @return integer
     */
    public function getLargestKillingSpree()
    {
        return $this->largestKillingSpree;
    }

    /**
     * Set largestKillingSpree
     *
     * @param integer $largestKillingSpree
     * @return ParticipantStats
     */
    public function setLargestKillingSpree($largestKillingSpree)
    {
        $this->largestKillingSpree = $largestKillingSpree;

        return $this;
    }

    /**
     * Get largestMultiKill
     *
     * @return integer
     */
    public function getLargestMultiKill()
    {
        return $this->largestMultiKill;
    }

    /**
     * Set largestMultiKill
     *
     * @param integer $largestMultiKill
     * @return ParticipantStats
     */
    public function setLargestMultiKill($largestMultiKill)
    {
        $this->largestMultiKill = $largestMultiKill;

        return $this;
    }

    /**
     * Get magicDamageDealt
     *
     * @return integer
     */
    public function getMagicDamageDealt()
    {
        return $this->magicDamageDealt;
    }

    /**
     * Set magicDamageDealt
     *
     * @param integer $magicDamageDealt
     * @return ParticipantStats
     */
    public function setMagicDamageDealt($magicDamageDealt)
    {
        $this->magicDamageDealt = $magicDamageDealt;

        return $this;
    }

    /**
     * Get magicDamageDealtToChampions
     *
     * @return integer
     */
    public function getMagicDamageDealtToChampions()
    {
        return $this->magicDamageDealtToChampions;
    }

    /**
     * Set magicDamageDealtToChampions
     *
     * @param integer $magicDamageDealtToChampions
     * @return ParticipantStats
     */
    public function setMagicDamageDealtToChampions($magicDamageDealtToChampions)
    {
        $this->magicDamageDealtToChampions = $magicDamageDealtToChampions;

        return $this;
    }

    /**
     * Get magicDamageTaken
     *
     * @return integer
     */
    public function getMagicDamageTaken()
    {
        return $this->magicDamageTaken;
    }

    /**
     * Set magicDamageTaken
     *
     * @param integer $magicDamageTaken
     * @return ParticipantStats
     */
    public function setMagicDamageTaken($magicDamageTaken)
    {
        $this->magicDamageTaken = $magicDamageTaken;

        return $this;
    }

    /**
     * Get minionsKilled
     *
     * @return integer
     */
    public function getMinionsKilled()
    {
        return $this->minionsKilled;
    }

    /**
     * Set minionsKilled
     *
     * @param integer $minionsKilled
     * @return ParticipantStats
     */
    public function setMinionsKilled($minionsKilled)
    {
        $this->minionsKilled = $minionsKilled;

        return $this;
    }

    /**
     * Get neutralMinionsKilled
     *
     * @return integer
     */
    public function getNeutralMinionsKilled()
    {
        return $this->neutralMinionsKilled;
    }

    /**
     * Set neutralMinionsKilled
     *
     * @param integer $neutralMinionsKilled
     * @return ParticipantStats
     */
    public function setNeutralMinionsKilled($neutralMinionsKilled)
    {
        $this->neutralMinionsKilled = $neutralMinionsKilled;

        return $this;
    }

    /**
     * Get neutralMinionsKilledEnemyJungle
     *
     * @return integer
     */
    public function getNeutralMinionsKilledEnemyJungle()
    {
        return $this->neutralMinionsKilledEnemyJungle;
    }

    /**
     * Set neutralMinionsKilledEnemyJungle
     *
     * @param integer $neutralMinionsKilledEnemyJungle
     * @return ParticipantStats
     */
    public function setNeutralMinionsKilledEnemyJungle($neutralMinionsKilledEnemyJungle)
    {
        $this->neutralMinionsKilledEnemyJungle = $neutralMinionsKilledEnemyJungle;

        return $this;
    }

    /**
     * Get neutralMinionsKilledTeamJungle
     *
     * @return integer
     */
    public function getNeutralMinionsKilledTeamJungle()
    {
        return $this->neutralMinionsKilledTeamJungle;
    }

    /**
     * Set neutralMinionsKilledTeamJungle
     *
     * @param integer $neutralMinionsKilledTeamJungle
     * @return ParticipantStats
     */
    public function setNeutralMinionsKilledTeamJungle($neutralMinionsKilledTeamJungle)
    {
        $this->neutralMinionsKilledTeamJungle = $neutralMinionsKilledTeamJungle;

        return $this;
    }

    /**
     * Get nodeCapture
     *
     * @return integer
     */
    public function getNodeCapture()
    {
        return $this->nodeCapture;
    }

    /**
     * Set nodeCapture
     *
     * @param integer $nodeCapture
     * @return ParticipantStats
     */
    public function setNodeCapture($nodeCapture)
    {
        $this->nodeCapture = $nodeCapture;

        return $this;
    }

    /**
     * Get nodeCaptureAssist
     *
     * @return integer
     */
    public function getNodeCaptureAssist()
    {
        return $this->nodeCaptureAssist;
    }

    /**
     * Set nodeCaptureAssist
     *
     * @param integer $nodeCaptureAssist
     * @return ParticipantStats
     */
    public function setNodeCaptureAssist($nodeCaptureAssist)
    {
        $this->nodeCaptureAssist = $nodeCaptureAssist;

        return $this;
    }

    /**
     * Get nodeNeutralize
     *
     * @return integer
     */
    public function getNodeNeutralize()
    {
        return $this->nodeNeutralize;
    }

    /**
     * Set nodeNeutralize
     *
     * @param integer $nodeNeutralize
     * @return ParticipantStats
     */
    public function setNodeNeutralize($nodeNeutralize)
    {
        $this->nodeNeutralize = $nodeNeutralize;

        return $this;
    }

    /**
     * Get nodeNeutralizeAssist
     *
     * @return integer
     */
    public function getNodeNeutralizeAssist()
    {
        return $this->nodeNeutralizeAssist;
    }

    /**
     * Set nodeNeutralizeAssist
     *
     * @param integer $nodeNeutralizeAssist
     * @return ParticipantStats
     */
    public function setNodeNeutralizeAssist($nodeNeutralizeAssist)
    {
        $this->nodeNeutralizeAssist = $nodeNeutralizeAssist;

        return $this;
    }

    /**
     * Get objectivePlayerScore
     *
     * @return integer
     */
    public function getObjectivePlayerScore()
    {
        return $this->objectivePlayerScore;
    }

    /**
     * Set objectivePlayerScore
     *
     * @param integer $objectivePlayerScore
     * @return ParticipantStats
     */
    public function setObjectivePlayerScore($objectivePlayerScore)
    {
        $this->objectivePlayerScore = $objectivePlayerScore;

        return $this;
    }

    /**
     * Get pentaKills
     *
     * @return integer
     */
    public function getPentaKills()
    {
        return $this->pentaKills;
    }

    /**
     * Set pentaKills
     *
     * @param integer $pentaKills
     * @return ParticipantStats
     */
    public function setPentaKills($pentaKills)
    {
        $this->pentaKills = $pentaKills;

        return $this;
    }

    /**
     * Get physicalDamageDealt
     *
     * @return integer
     */
    public function getPhysicalDamageDealt()
    {
        return $this->physicalDamageDealt;
    }

    /**
     * Set physicalDamageDealt
     *
     * @param integer $physicalDamageDealt
     * @return ParticipantStats
     */
    public function setPhysicalDamageDealt($physicalDamageDealt)
    {
        $this->physicalDamageDealt = $physicalDamageDealt;

        return $this;
    }

    /**
     * Get physicalDamageDealtToChampions
     *
     * @return integer
     */
    public function getPhysicalDamageDealtToChampions()
    {
        return $this->physicalDamageDealtToChampions;
    }

    /**
     * Set physicalDamageDealtToChampions
     *
     * @param integer $physicalDamageDealtToChampions
     * @return ParticipantStats
     */
    public function setPhysicalDamageDealtToChampions($physicalDamageDealtToChampions)
    {
        $this->physicalDamageDealtToChampions = $physicalDamageDealtToChampions;

        return $this;
    }

    /**
     * Get physicalDamageTaken
     *
     * @return integer
     */
    public function getPhysicalDamageTaken()
    {
        return $this->physicalDamageTaken;
    }

    /**
     * Set physicalDamageTaken
     *
     * @param integer $physicalDamageTaken
     * @return ParticipantStats
     */
    public function setPhysicalDamageTaken($physicalDamageTaken)
    {
        $this->physicalDamageTaken = $physicalDamageTaken;

        return $this;
    }

    /**
     * Get quadraKills
     *
     * @return integer
     */
    public function getQuadraKills()
    {
        return $this->quadraKills;
    }

    /**
     * Set quadraKills
     *
     * @param integer $quadraKills
     * @return ParticipantStats
     */
    public function setQuadraKills($quadraKills)
    {
        $this->quadraKills = $quadraKills;

        return $this;
    }

    /**
     * Get sightWardsBoughtInGame
     *
     * @return integer
     */
    public function getSightWardsBoughtInGame()
    {
        return $this->sightWardsBoughtInGame;
    }

    /**
     * Set sightWardsBoughtInGame
     *
     * @param integer $sightWardsBoughtInGame
     * @return ParticipantStats
     */
    public function setSightWardsBoughtInGame($sightWardsBoughtInGame)
    {
        $this->sightWardsBoughtInGame = $sightWardsBoughtInGame;

        return $this;
    }

    /**
     * Get teamObjective
     *
     * @return integer
     */
    public function getTeamObjective()
    {
        return $this->teamObjective;
    }

    /**
     * Set teamObjective
     *
     * @param integer $teamObjective
     * @return ParticipantStats
     */
    public function setTeamObjective($teamObjective)
    {
        $this->teamObjective = $teamObjective;

        return $this;
    }

    /**
     * Get totalDamageDealt
     *
     * @return integer
     */
    public function getTotalDamageDealt()
    {
        return $this->totalDamageDealt;
    }

    /**
     * Set totalDamageDealt
     *
     * @param integer $totalDamageDealt
     * @return ParticipantStats
     */
    public function setTotalDamageDealt($totalDamageDealt)
    {
        $this->totalDamageDealt = $totalDamageDealt;

        return $this;
    }

    /**
     * Get totalDamageDealtToChampions
     *
     * @return integer
     */
    public function getTotalDamageDealtToChampions()
    {
        return $this->totalDamageDealtToChampions;
    }

    /**
     * Set totalDamageDealtToChampions
     *
     * @param integer $totalDamageDealtToChampions
     * @return ParticipantStats
     */
    public function setTotalDamageDealtToChampions($totalDamageDealtToChampions)
    {
        $this->totalDamageDealtToChampions = $totalDamageDealtToChampions;

        return $this;
    }

    /**
     * Get totalDamageTaken
     *
     * @return integer
     */
    public function getTotalDamageTaken()
    {
        return $this->totalDamageTaken;
    }

    /**
     * Set totalDamageTaken
     *
     * @param integer $totalDamageTaken
     * @return ParticipantStats
     */
    public function setTotalDamageTaken($totalDamageTaken)
    {
        $this->totalDamageTaken = $totalDamageTaken;

        return $this;
    }

    /**
     * Get totalHeal
     *
     * @return integer
     */
    public function getTotalHeal()
    {
        return $this->totalHeal;
    }

    /**
     * Set totalHeal
     *
     * @param integer $totalHeal
     * @return ParticipantStats
     */
    public function setTotalHeal($totalHeal)
    {
        $this->totalHeal = $totalHeal;

        return $this;
    }

    /**
     * Get totalPlayerScore
     *
     * @return integer
     */
    public function getTotalPlayerScore()
    {
        return $this->totalPlayerScore;
    }

    /**
     * Set totalPlayerScore
     *
     * @param integer $totalPlayerScore
     * @return ParticipantStats
     */
    public function setTotalPlayerScore($totalPlayerScore)
    {
        $this->totalPlayerScore = $totalPlayerScore;

        return $this;
    }

    /**
     * Get totalScoreRank
     *
     * @return integer
     */
    public function getTotalScoreRank()
    {
        return $this->totalScoreRank;
    }

    /**
     * Set totalScoreRank
     *
     * @param integer $totalScoreRank
     * @return ParticipantStats
     */
    public function setTotalScoreRank($totalScoreRank)
    {
        $this->totalScoreRank = $totalScoreRank;

        return $this;
    }

    /**
     * Get totalTimeCrowdControlDealt
     *
     * @return integer
     */
    public function getTotalTimeCrowdControlDealt()
    {
        return $this->totalTimeCrowdControlDealt;
    }

    /**
     * Set totalTimeCrowdControlDealt
     *
     * @param integer $totalTimeCrowdControlDealt
     * @return ParticipantStats
     */
    public function setTotalTimeCrowdControlDealt($totalTimeCrowdControlDealt)
    {
        $this->totalTimeCrowdControlDealt = $totalTimeCrowdControlDealt;

        return $this;
    }

    /**
     * Get totalUnitsHealed
     *
     * @return integer
     */
    public function getTotalUnitsHealed()
    {
        return $this->totalUnitsHealed;
    }

    /**
     * Set totalUnitsHealed
     *
     * @param integer $totalUnitsHealed
     * @return ParticipantStats
     */
    public function setTotalUnitsHealed($totalUnitsHealed)
    {
        $this->totalUnitsHealed = $totalUnitsHealed;

        return $this;
    }

    /**
     * Get towerKills
     *
     * @return integer
     */
    public function getTowerKills()
    {
        return $this->towerKills;
    }

    /**
     * Set towerKills
     *
     * @param integer $towerKills
     * @return ParticipantStats
     */
    public function setTowerKills($towerKills)
    {
        $this->towerKills = $towerKills;

        return $this;
    }

    /**
     * Get tripleKills
     *
     * @return integer
     */
    public function getTripleKills()
    {
        return $this->tripleKills;
    }

    /**
     * Set tripleKills
     *
     * @param integer $tripleKills
     * @return ParticipantStats
     */
    public function setTripleKills($tripleKills)
    {
        $this->tripleKills = $tripleKills;

        return $this;
    }

    /**
     * Get trueDamageDealt
     *
     * @return integer
     */
    public function getTrueDamageDealt()
    {
        return $this->trueDamageDealt;
    }

    /**
     * Set trueDamageDealt
     *
     * @param integer $trueDamageDealt
     * @return ParticipantStats
     */
    public function setTrueDamageDealt($trueDamageDealt)
    {
        $this->trueDamageDealt = $trueDamageDealt;

        return $this;
    }

    /**
     * Get trueDamageDealtToChampions
     *
     * @return integer
     */
    public function getTrueDamageDealtToChampions()
    {
        return $this->trueDamageDealtToChampions;
    }

    /**
     * Set trueDamageDealtToChampions
     *
     * @param integer $trueDamageDealtToChampions
     * @return ParticipantStats
     */
    public function setTrueDamageDealtToChampions($trueDamageDealtToChampions)
    {
        $this->trueDamageDealtToChampions = $trueDamageDealtToChampions;

        return $this;
    }

    /**
     * Get trueDamageTaken
     *
     * @return integer
     */
    public function getTrueDamageTaken()
    {
        return $this->trueDamageTaken;
    }

    /**
     * Set trueDamageTaken
     *
     * @param integer $trueDamageTaken
     * @return ParticipantStats
     */
    public function setTrueDamageTaken($trueDamageTaken)
    {
        $this->trueDamageTaken = $trueDamageTaken;

        return $this;
    }

    /**
     * Get unrealKills
     *
     * @return integer
     */
    public function getUnrealKills()
    {
        return $this->unrealKills;
    }

    /**
     * Set unrealKills
     *
     * @param integer $unrealKills
     * @return ParticipantStats
     */
    public function setUnrealKills($unrealKills)
    {
        $this->unrealKills = $unrealKills;

        return $this;
    }

    /**
     * Get visionWardsBoughtInGame
     *
     * @return integer
     */
    public function getVisionWardsBoughtInGame()
    {
        return $this->visionWardsBoughtInGame;
    }

    /**
     * Set visionWardsBoughtInGame
     *
     * @param integer $visionWardsBoughtInGame
     * @return ParticipantStats
     */
    public function setVisionWardsBoughtInGame($visionWardsBoughtInGame)
    {
        $this->visionWardsBoughtInGame = $visionWardsBoughtInGame;

        return $this;
    }

    /**
     * Get wardsKilled
     *
     * @return integer
     */
    public function getWardsKilled()
    {
        return $this->wardsKilled;
    }

    /**
     * Set wardsKilled
     *
     * @param integer $wardsKilled
     * @return ParticipantStats
     */
    public function setWardsKilled($wardsKilled)
    {
        $this->wardsKilled = $wardsKilled;

        return $this;
    }

    /**
     * Get wardsPlaced
     *
     * @return integer
     */
    public function getWardsPlaced()
    {
        return $this->wardsPlaced;
    }

    /**
     * Set wardsPlaced
     *
     * @param integer $wardsPlaced
     * @return ParticipantStats
     */
    public function setWardsPlaced($wardsPlaced)
    {
        $this->wardsPlaced = $wardsPlaced;

        return $this;
    }

    /**
     * Get winner
     *
     * @return boolean
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set winner
     *
     * @param boolean $winner
     * @return ParticipantStats
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

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
     * @return ParticipantStats
     */
    public function setParticipant(Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }
}
