<?php
namespace AppBundle\Type;

class EnumMatchTypeType extends EnumType
{
    protected $name = 'enum_match_type';
    protected $values = array(
        'CUSTOM_GAME',
        'MATCHED_GAME',
        'TUTORIAL_GAME',
    );
}