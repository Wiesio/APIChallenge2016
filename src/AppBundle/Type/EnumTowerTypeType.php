<?php
namespace AppBundle\Type;

class EnumTowerTypeType extends EnumType
{
    protected $name = 'enum_tower_type';
    protected $values = array(
        'BASE_TURRET',
        'FOUNTAIN_TURRET',
        'INNER_TURRET',
        'NEXUS_TURRET',
        'OUTER_TURRET',
        'UNDEFINED_TURRET',
    );
}