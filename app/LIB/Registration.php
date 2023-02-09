<?php

namespace APP\LIB;

class Registration
{
    private static $_instance;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance(): Registration
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }
}
