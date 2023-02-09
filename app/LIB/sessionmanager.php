<?php
namespace APP\LIB;


use ReturnTypeWillChange;
use function APP\pr;

class SessionManager extends \SessionHandler
{
    private string $sessionName = SESSION_NAME;
    private int $sessionMaxLiveTime = SESSION_MAX_LIVE_TIME;
    private bool $sessionSSL = false;
    private bool $sessionHTTPOnly = true;
    private string $sessionPath = '/';
    private string $sessionDomain = SESSION_DOMAIN;
    private string $sessionSavePath = SESSION_SAVE_PATH;

    private string $sessionCipherAlgo = "aes-128-cbc";
    private string $sessionCipherKey = 'WYCRYPT0K3Y@2016';

    private int $timeLiveSession = 1;

    public function __construct()
    {
        ini_set("session.use_cookies", 1);
        ini_set("session.use_only_cookies", 1);
        ini_set("session.use_trans_sid", 0);
        ini_set("session.save_handler", "files");

        session_name($this->sessionName);
        session_save_path($this->sessionSavePath);

        session_set_cookie_params(
            $this->sessionMaxLiveTime,
            $this->sessionPath,
            $this->sessionDomain,
            $this->sessionSSL,
            $this->sessionHTTPOnly
        );
    }

    public function __get($key)
    {
        return false !== $_SESSION[$key] ? $_SESSION[$key] : false;
    }
    public function __set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function __unset(string $nameSession): void
    {
        unset($_SESSION[$nameSession]);
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]);
    }
    #[ReturnTypeWillChange] public function read($id): false|string
    {
        return openssl_decrypt(parent::read($id), $this->sessionCipherAlgo, $this->sessionCipherKey);
    }

    #[ReturnTypeWillChange] public function write($id, $data): bool
    {
        return parent::write($id, openssl_encrypt($data, $this->sessionCipherAlgo, $this->sessionCipherKey));
    }
    private function setSessionStartTime()
    {
        if(! isset($this->sessionStartTime)) {
            $this->sessionStartTime = time();
        }
    }
    private function regenerateSessionFile(): bool
    {
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }
    private function generateFingerKey()
    {
        $userAgent  = $_SERVER["HTTP_USER_AGENT"];
        $id         = session_id();
        $this->key  = openssl_random_pseudo_bytes(16);
        $this->fingerKey = md5($userAgent . $this->key . $id);
    }
    private function ifSessionValid(): void
    {
        $currentTime = time() - $this->sessionStartTime;
        if ($currentTime > ($this->timeLiveSession * 60) ) {
            // Regenerate Session
            $this->regenerateSessionFile();
            // Regenerate Finger Key
            $this->generateFingerKey();
        }
    }
    public function kill()
    {
        // session_unset delete variables in session
        // session destroy delete session don't approaches in session variables
        session_unset();
        setcookie(
            $this->sessionName, '', time() - 1000,
            $this->sessionPath, $this->sessionDomain,
            $this->sessionSSL, $this->sessionHTTPOnly
        );
        session_destroy();
    }
    public function ifValidFinger(): bool
    {
        if (! isset($this->fingerKey)) {
            $this->generateFingerKey();
        }

        $finger = md5($_SERVER["HTTP_USER_AGENT"] . $this->key . session_id());

        if ($finger === $this->fingerKey) {
            return true;
        }

        return false;

    }
    public function start(): bool
    {
        if (session_id() == null) {
            if (session_start()) {
                $this->setSessionStartTime();
                $this->ifSessionValid();
            }
        }
        return false;
    }
}