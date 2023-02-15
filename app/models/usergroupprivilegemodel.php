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

    public static function getPrivilegesByGroup($groupId): array
    {
        $query =
            "SELECT 
                ugp.*, up.Privilege
            FROM
                " . self::$tableName . "
            AS
                ugp
            INNER JOIN
                users_privileges
            AS 
                up
            ON
                up.PrivilegeId = ugp.PrivilegeId
            WHERE 
                ugp.GroupId = " . $groupId . "
        ";

        $privilegesUrls =  (new UserGroupPrivilegeModel)->get($query);
        $urls = [];
        foreach ($privilegesUrls as $privilegesUrl) {
            $urls[] = $privilegesUrl->Privilege;
        }
        return $urls;
    }
}