<?php
namespace AppBundle\Type;

class EnumMonsterTypeType extends EnumType
{
    protected $name = 'enum_monster_type';
    protected $values = array(
        'BARON_NASHOR',
        'BLUE_GOLEM',
        'DRAGON',
        'RED_LIZARD',
        'RIFTHERALD',
        'VILEMAW',
    );
}