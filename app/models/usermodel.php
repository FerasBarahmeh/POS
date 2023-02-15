<?php

namespace APP\Models;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\Lib\Database\DatabaseHandler;
use UserStatus;
use function APP\pr;

class UserModel extends AbstractModel
{
    use PublicHelper;
    use UserStatus;
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
        "SubscriptionDate"      => self::DATA_TYPE_STR,
        "LastLogin"             => self::DATA_TYPE_STR,
        "GroupId"               => self::DATA_TYPE_INT,
        "Status"                => self::DATA_TYPE_INT,
        "PhoneNumber"           => self::DATA_TYPE_STR,
    ];


    protected static string $primaryKey = "UserId";

    public function encryptionPassword($pass)
    {
        $this->Password = crypt($pass, MAIN_SALT);
    }

    public static function getUsers(UserModel $user): bool|\ArrayIterator
    {
        return (new UserModel)->get(
            "SELECT u.*, ug.GroupName FROM " . self::$tableName .
            " as u INNER JOIN users_groups as ug ON ug.GroupId = u.GroupId  WHERE UserId != " . $user->UserId
        );
    }
    public static function count($column, $value): false|\ArrayIterator
    {
        return (new UserModel)->get("SELECT " . $column . " FROM " .static::$tableName . " WHERE " . $column . " = '$value'");
    }

    private function ifUserRegistration($username, $password)
    {
        $password = crypt($password, MAIN_SALT);

        $sql = "
            SELECT 
                *
            FROM ".
                static::$tableName . "
            WHERE  
                (UserName = '" . $username ."' OR Email = '" . $username . "')
            AND 
                Password = '" . $password ."'
            ";
        return (new UserModel)->getRow($sql);
    }

    public static function authentication($username, $password, $session)
    {
        $user = (new UserModel)->ifUserRegistration($username, $password);
        if ($user === false || $user === 0) {
            return self::$UserNotRegistration;
        }
        if ($user) { // If user exist
            if ($user->Status == self::$UserDisable) {
                return  self::$UserDisable;
            } elseif ($user->Status == self::$UserValid) {
                $session->user = $user;
                $user->LastLogin = date("Y-m-d H:i:s");
                $user->save();
                return self::$UserValid;
            }
        }
    }
}
