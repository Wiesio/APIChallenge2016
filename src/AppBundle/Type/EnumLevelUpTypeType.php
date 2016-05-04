<?php
namespace AppBundle\Type;

class EnumLevelUpTypeType extends EnumType
{
    protected $name = 'enum_level_up_type';
    protected $values = array(
        'EVOLVE',
        'NORMAL',
    );
}