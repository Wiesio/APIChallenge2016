<?php
namespace AppBundle\Type;

class EnumEventTypeType extends EnumType
{
    protected $name = 'enum_event_type';
    protected $values = array(
        'ASCENDED_EVENT',
        'BUILDING_KILL',
        'CAPTURE_POINT',
        'CHAMPION_KILL',
        'ELITE_MONSTER_KILL',
        'ITEM_DESTROYED',
        'ITEM_PURCHASED',
        'ITEM_SOLD',
        'ITEM_UNDO',
        'PORO_KING_SUMMON',
        'SKILL_LEVEL_UP',
        'WARD_KILL',
        'WARD_PLACED',
    );
}