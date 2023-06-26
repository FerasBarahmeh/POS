<?php

namespace APP\Models;

use ArrayIterator;

class SettingsModel extends AbstractModel
{
    public $Language;
    public $Currency;

    protected static $tableName = "settings";

    protected static array $tableSchema = [
        "UserId"          => self::DATA_TYPE_INT,
        "Language"          => self::DATA_TYPE_STR,
        "Currency"          => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "UserId";

    /**
     * @version 1.0
     * @author Feras Barahemeh
     *
     * method to get setting by each user
     * @param $UserId int ID user  you want get settings
     * @return int|mixed
     */
    public function getSettings(int $UserId): mixed
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = " .  $UserId;

        return $this->getRow($sql);
    }
}
