<?php
namespace APP;


use APP\lib\FrontController;
use APP\LIB\Messenger;
use APP\LIB\SessionManager;
use APP\LIB\Template\Template;
use APP\LIB\Language;
use APP\LIB\Registration;
use APP\LIB\Authentication;


function pr($arr, $typePrint=1): void
{
    echo "<pre>";
    if ($typePrint)
        print_r($arr);
    else
        var_dump($arr);
    echo "</pre>";
}


! defined("DS") ? define("DS", DIRECTORY_SEPARATOR) : null;



// Requires File
require_once ".." . DS . "app" . DS . "config" . DS . "config.php";
require_once APP_PATH . DS . "LIB" . DS . "autoload.php";

// Session
$session = new SessionManager;
$session->start();

if (! isset($session->lang)) {
    $session->lang = APP_DEFAULT_LANGUAGE;
}

$templateParts = require_once ".." . DS . "app" . DS . "config" . DS . "templateconfig.php";

$template       = new Template($templateParts);
$languages      = new Language();

$message        = Messenger::getInstance($session);
$authenticated  = Authentication::getInstance($session);

$registry       = Registration::getInstance();

$registry->session  = $session;
$registry->language = $languages;
$registry->message  = $message;

// Inject authentication in front controller not registry because we will use in front controller just
$frontController = new FrontController($template, $registry, $authenticated);
$frontController->dispatch();

