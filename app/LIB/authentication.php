<?php

namespace APP\LIB;

use function APP\pr;

class Authentication
{
    private static $_instance;
    private $_session;
    private function __construct($_session)
    {
        $this->_session = $_session;
    }
    public function __clone(){}

    public static function getInstance($session): Authentication
    {
        if (self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function isAuthenticated(): bool
    {
        return isset($this->_session->user);
    }
}