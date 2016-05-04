<?php
namespace AppBundle\Type;

class EnumMatchModeType extends EnumType
{
    protected $name = 'enum_match_mode';
    protected $values = array(
        'CLASSIC',
        'ODIN',
        'ARAM',
        'TUTORIAL',
        'ONEFORALL',
        'ASCENSION',
        'FIRSTBLOOD',
        'KINGPORO',
    );
}