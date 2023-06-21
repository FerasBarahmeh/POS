<?php

namespace APP\Models;

class SettingsModel extends AbstractModel
{
    public $Language;

    protected static $tableName = "settings";

    protected static array $tableSchema = [
        "IdUser"          => self::DATA_TYPE_INT,
        "Language"          => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "IdUser";
}
