<?php

namespace APP\LIB;

use function APP\pr;

class Authentication
{
    private static $_instance;
    private array $_authorizedURLs = [
        "/index/default",
        "/language/default",
        "/authentication/logout",
        "/denyauthorizeaccess/default",
        "/notfound/notfound",
    ];
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

    /**
     * @param string $controller name controller you go it
     * @param $action $the view you want render
     *
     * @return bool false if user can't access page or controller and true other ways
     * **@version 1.3
     * This method to check if user has authorized access in page
     * if url (controller / action) in $_authorizedURLs array (this array has urls can each user go to it)
     * Or url (controller / action) in privileges user (get it from db)
     * Or url be ajax url
     *
     * @author Feras Barahmeh
     */
    public function authorizedAccess(string $controller, $action): bool
    {
        $url = '/' . $controller . '/' . $action;
        if (in_array($url, $this->_authorizedURLs)
            || in_array($url, $this->_session->user->privileges)
            || str_contains($url, "Ajax")) {
            return true;
        }
        return false;
    }
}