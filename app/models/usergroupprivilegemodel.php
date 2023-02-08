<?php

namespace APP\Models;

class UserGroupPrivilegeModel extends AbstractModel
{
    public $Id;
    public $GroupId;
    public $PrivilegeId;


    protected static $tableName = "users_groups_privileges";

    protected static array $tableSchema = [
        "GroupId" => self::DATA_TYPE_INT,
        "PrivilegeId" => self::DATA_TYPE_INT,
    ];

    protected static string $primaryKey = "Id";
}