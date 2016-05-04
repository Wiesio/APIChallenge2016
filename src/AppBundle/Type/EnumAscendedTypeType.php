<?php

namespace AppBundle\Type;

class EnumAscendedTypeType extends EnumType
{
    protected $name = 'enum_ascended_type';
    protected $values = array(
        'CHAMPION_ASCENDED',
        'CLEAR_ASCENDED',
        'MINION_ASCENDED',
    );
}