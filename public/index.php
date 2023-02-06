<?php
namespace APP;


use APP\lib\FrontController;
use APP\LIB\SessionManager;
use APP\LIB\Template\Template;
use APP\LIB\Language;



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
if (! $session->ifValidFinger()) {
    $session->kill();
}
if (! isset($_SESSION["lang"])) {
    $_SESSION["lang"] = APP_DEFAULT_LANGUAGE;
}

$templateParts = require_once ".." . DS . "app" . DS . "config" . DS . "templateconfig.php";

$template   = new Template($templateParts);
$languages  = new Language();

$frontController = new FrontController($template, $languages);
$frontController->dispatch();

