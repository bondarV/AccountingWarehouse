<?php

namespace App\Enums;

enum MovementType: string
{
    case OUT = 'out';
    case RELOCATE = 'relocate';
    case ADJUST = 'adjust';
}
