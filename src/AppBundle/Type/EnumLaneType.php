<?php
namespace AppBundle\Type;

class EnumLaneType extends EnumType
{
    protected $name = 'enum_lane';
    protected $values = array(
        'MID',
        'MIDDLE',
        'TOP',
        'JUNGLE',
        'BOT',
        'BOTTOM',
    );
}