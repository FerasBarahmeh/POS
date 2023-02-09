<?php

namespace APP\LIB;

use function APP\pr;

class Messenger
{
    const MESSAGE_SUCCESS   = 1;
    const MESSAGE_DANGER    = 2;
    const MESSAGE_WARING    = 3;
    const MESSAGE_POPUP     = 4;
    const MESSAGE_INFO      = 5;
    private static $_instance;
    private SessionManager $_session;

    private $_messages;
    private function __construct($session) {
        $this->_session = $session;
    }

    private function __clone() {}

    public static function getInstance( SessionManager $session): Messenger
    {
        if (self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    private function messagesExist(): bool
    {
        return isset($this->_session->message);
    }

    private function setClassStyle($number): string
    {
        if ($number === self::MESSAGE_SUCCESS)  return "success";
        if ($number === self::MESSAGE_DANGER)   return "danger";
        if ($number === self::MESSAGE_WARING)   return "waring";
        if ($number === self::MESSAGE_INFO)     return "info";
        return '';
    }
    public function addMessage($mss, $type = self::MESSAGE_SUCCESS): void
    {
        if (! $this->messagesExist()) {
            $this->_session->message = [];
        }

        $temp = $this->_session->message;
        $temp[] = [$mss, $this->setClassStyle($type)];

        $this->_session->message = $temp;
        unset($temp);
    }

    public function getMessage()
    {
        if ($this->messagesExist()) {
            $this->_messages = $this->_session->message;
            unset($this->_session->message);
            return $this->_messages;
        }
        return [];
    }

}