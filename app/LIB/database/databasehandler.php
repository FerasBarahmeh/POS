<?php
namespace APP\Lib\Database;

abstract class DatabaseHandler
{
    const DATABASE_DRIVER_POD       = \TypeDriver::pdo;
    const DATABASE_DRIVER_MYSQLI    = \TypeDriver::mysql;

    private function __construct() {}

    abstract protected static function init();

    abstract protected static function getInstance();

    public static function factory():  PDODatabaseHandler | MySQLiDatabaseHandler
    {
        $driver = DATABASE_CONN_DRIVER;
        if ($driver == self::DATABASE_DRIVER_POD) {
            return PDODatabaseHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return MySQLiDatabaseHandler::getInstance();
        }
        return PDODatabaseHandler::getInstance();
    }

    public static function lastInsertID()
    {
        $stmt = self::factory()->prepare("SELECT LAST_INSERT_ID()");
        $stmt->execute();
        return $stmt->fetch()[0];
    }
}