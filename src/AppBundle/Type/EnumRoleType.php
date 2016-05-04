<?php
namespace AppBundle\Type;

class EnumRoleType extends EnumType
{
    protected $name = 'enum_role';
    protected $values = array(
        'DUO',
        'NONE',
        'SOLO',
        'DUO_CARRY',
        'DUO_SUPPORT',
    );
}