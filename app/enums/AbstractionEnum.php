<?php

namespace APP\Enums;

/**
 * @property mixed $default
 */
class AbstractionEnum
{
    private static mixed $default;

    public function getDefault()
    {
        return static::$default;
    }
}
