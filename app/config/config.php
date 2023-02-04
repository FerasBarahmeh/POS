<?php


// APP Data Types

enum TypeDriver : int {
    case pdo = 1;
    case mysql = 2;
}
// Template

const NAME_TEMPLATE_BLOCK_KEY = "template";
const NAME_TEMPLATE_HEADER_RESOURCES = "header_resources";
const NAME_TEMPLATE_FOOTER_RESOURCES = "footer_resources";
const NAME_VIEW_TEMPLATE_KEY = ":view";

! defined("DS") ? define("DS", DIRECTORY_SEPARATOR) : null;


// Start Global Paths Constants
define("APP_PATH", realpath(dirname(__FILE__, 2)));
const TEMPLATE_PATH = APP_PATH . DS . 'template' . DS;

const CSS = DS . "css" . DS;

const JS  = DS . "js" . DS;
const IMG = DS . "images" . DS;

// End Paths Constants

const VIEWS_PATH = APP_PATH . DS . "views" . DS;

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define ('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'store');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', TypeDriver::pdo);

// Start Languages Paths
const APP_DEFAULT_LANGUAGE = "en";

const LANGUAGES_PATH = APP_PATH . DS . "languages" . DS;


// Session Configuration
const SESSION_SAVE_PATH = APP_PATH . DS . ".." . DS . "sessions";
const SESSION_NAME = "E_STORE";
const SESSION_DOMAIN = ".estore.local";
const SESSION_MAX_LIVE_TIME = 0;
