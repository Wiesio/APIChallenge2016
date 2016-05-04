<?php
namespace AppBundle\Type;

class EnumSeasonTierType extends EnumType
{
    protected $name = 'enum_season_tier';
    protected $values = array(
        'CHALLENGER',
        'MASTER',
        'DIAMOND',
        'PLATINUM',
        'GOLD',
        'SILVER',
        'BRONZE',
        'UNRANKED',
    );
}