<?php

namespace APP\Models;

class UserPrivilegeModel extends AbstractModel
{
    public $privilegeId;
    public $privilege;

    protected static $tableName = "users_privileges";

    protected static array $tableSchema = [
        "Privilege"              => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "PrivilegeId";
}