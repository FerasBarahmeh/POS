<?php

namespace APP\Models;

class UserGroupModel extends AbstractModel
{
    public $groupId;
    public $groupName;

    protected static $tableName = "users";

    protected static array $tableSchema = [
        "GroupName"              => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "GroupId";
}