<?php

namespace APP\Models;

class UserPrivilegeModel extends AbstractModel
{
    public  $PrivilegeId;
    public  $Privilege;
    public  $PrivilegeTitle;


    protected static $tableName = "users_privileges";

    protected static array $tableSchema = [
        "Privilege"              => self::DATA_TYPE_STR,
        "PrivilegeTitle"         => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "PrivilegeId";
}