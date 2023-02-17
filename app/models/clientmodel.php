<?php

namespace APP\Models;

class ClientModel extends AbstractModel
{
    public $ClientId;

    public $Name;
    public $PhoneNumber;

    public $Email;
    public $Address;

    protected static $tableName = "clients";

    protected static array $tableSchema = [
        "Name"          => self::DATA_TYPE_STR,
        "PhoneNumber"   => self::DATA_TYPE_STR,
        "Email"         => self::DATA_TYPE_STR,
        "Address"       => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "ClientId";

}
