<?php

namespace APP\Enums;

class Units extends AbstractionEnum
{
    public int $kilo        = 1;
    public int $meter       = 2;
    public int $box         = 3;
    public int $cardboard   = 4;
    public int $piece       = 5;
    public static mixed $default = 5;
}
