<?php
namespace AppBundle\Type;

class EnumWardTypeType extends EnumType
{
    protected $name = 'enum_ward_type';
    protected $values = array(
        'BLUE_TRINKET',
        'SIGHT_WARD',
        'TEEMO_MUSHROOM',
        'UNDEFINED',
        'VISION_WARD',
        'YELLOW_TRINKET',
        'YELLOW_TRINKET_UPGRADE',
    );
}