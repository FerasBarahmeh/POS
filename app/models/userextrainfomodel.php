<?php

namespace APP\Models;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\Lib\Database\DatabaseHandler;
use UserStatus;
use function APP\pr;

class UserExtraInfoModel extends AbstractModel
{
    use PublicHelper;
    use UserStatus;
    public $UserId;
    public $FirstName;
    public $LastName;
    public $Address;
    public $BOD;
    public $Image;

    protected static $tableName = "subset_information_users";

    protected static array $tableSchema = [
        "FirstName" => self::DATA_TYPE_STR,
        "LastName"  => self::DATA_TYPE_STR,
        "Address"   => self::DATA_TYPE_STR,
        "BOD"       => self::DATA_TYPE_DATE,
        "Image"     => self::DATA_TYPE_STR,
    ];


    protected static string $primaryKey = "UserId";
}
