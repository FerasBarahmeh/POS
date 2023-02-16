<?php

namespace APP\Models;

class SupplierModel extends AbstractModel
{
    public $SupplierId;

    public $Name;
    public $PhoneNumber;

    public $Email;
    public $Address;

    protected static $tableName = "suppliers";

    protected static array $tableSchema = [
        "Name"          => self::DATA_TYPE_STR,
        "PhoneNumber"   => self::DATA_TYPE_STR,
        "Email"         => self::DATA_TYPE_STR,
        "Address"       => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "SupplierId";

}
