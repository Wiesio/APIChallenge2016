<?php
namespace AppBundle\Type;

class EnumPointCapturedType extends EnumType
{
    protected $name = 'enum_point_captured';
    protected $values = array(
        'POINT_A',
        'POINT_B',
        'POINT_C',
        'POINT_D',
        'POINT_E',
    );
}