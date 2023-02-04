<?php
namespace APP\Lib\Database;
use PDO; use PDOException;
class MySQLiDatabaseHandler extends DatabaseHandler
{
    private static $_handler;

    private function __construct(){
        self::init();
    }

    protected static function init()
    {
        try {
            self::$_handler = new PDO(
                'mysql://hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME,
                DATABASE_USER_NAME, DATABASE_PASSWORD
            );
        } catch (PDOException $e) {

        }
    }

    public static function getInstance(): MySQLiDatabaseHandler
    {
        if(self::$_handler === null) {
            self::$_handler = new self();
        }
        return self::$_handler;
    }
}