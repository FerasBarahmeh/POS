<?php

namespace APP\Models;

class ProductCategoriesModel extends AbstractModel
{
    public $CategoryId;

    public $Name;
    public $Image;

    protected static $tableName = "products_categories";

    protected static array $tableSchema = [
        "Name"  => self::DATA_TYPE_STR,
        "Image" => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "CategoryId";

}
