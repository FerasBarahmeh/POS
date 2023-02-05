<?php

namespace APP\Models;

class UserModel extends AbstractModel
{
    public $userId;
    public $userName;
    public $password;
    public $email;
    public $subscriptionDate;
    public $lastLogin;
    public $phoneNumber;

    protected static $tableName = "users";

    protected static array $tableSchema = [
        "UserName"              => self::DATA_TYPE_STR,
        "Password"              => self::DATA_TYPE_STR,
        "Email"                 => self::DATA_TYPE_STR,
        "SubscriptionDate"      => self::DATA_TYPE_DATE,
        "LastLogin"             => self::DATA_TYPE_STR,
        "GroupId"               => self::DATA_TYPE_INT,
        "PhoneNumber"           => self::DATA_TYPE_STR,
    ];


    protected static string $primaryKey = "UserId";

}
