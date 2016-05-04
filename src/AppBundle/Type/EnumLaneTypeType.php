<?php
namespace AppBundle\Type;

class EnumLaneTypeType extends EnumType
{
    protected $name = 'enum_lane_type';
    protected $values = array(
        'MID_LANE',
        'TOP_LANE',
        'BOT_LANE',
    );
}