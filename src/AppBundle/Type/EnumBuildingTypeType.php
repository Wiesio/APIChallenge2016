<?php
namespace AppBundle\Type;

class EnumBuildingTypeType extends EnumType
{
    protected $name = 'enum_building_type';
    protected $values = array(
        'INHIBITOR_BUILDING',
        'TOWER_BUILDING',
    );
}