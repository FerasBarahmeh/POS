<?php
namespace APP\LIP;


class  AutoLoad {
    public static function autoLoad($className)
    {
        $className = str_replace("APP", '', $className);
        $className = strtolower($className) . ".php" ;

        if (file_exists(APP_PATH . $className)) {
            require_once APP_PATH . $className;
        }
    }
}

spl_autoload_register( __NAMESPACE__ . "\AutoLoad::autoLoad");