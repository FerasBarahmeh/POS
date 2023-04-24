<?php
namespace APP\Enums;
class StatusProduct extends AbstractionEnum
{
    public $available = 1;
    public $blocked = 2;
    public $expired = 3;
    public static mixed $default = 0;
}