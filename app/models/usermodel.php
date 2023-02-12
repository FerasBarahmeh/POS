<?php

namespace APP\Models;

class UserModel extends AbstractModel
{
    public $UserId;
    public $UserName;
    public $Password;
    public $Email;
    public $SubscriptionDate;
    public $LastLogin;
    public $PhoneNumber;
    public $GroupId;
    public $Status;

    protected static $tableName = "users";

    protected static array $tableSchema = [
        "UserName"              => self::DATA_TYPE_STR,
        "Password"              => self::DATA_TYPE_STR,
        "Email"                 => self::DATA_TYPE_STR,
        "SubscriptionDate"      => self::DATA_TYPE_DATE,
        "LastLogin"             => self::DATA_TYPE_STR,
        "GroupId"               => self::DATA_TYPE_INT,
        "Status"                => self::DATA_TYPE_INT,
        "PhoneNumber"           => self::DATA_TYPE_STR,
    ];


    protected static string $primaryKey = "UserId";

}
