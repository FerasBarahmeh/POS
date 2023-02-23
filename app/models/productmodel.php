<?php

namespace APP\Models;

class ProductModel extends AbstractModel
{
    public $ProductId;
    public $CategoryId;

    public $Name;
    public $Image;
    public $Quantity;
    public $BuyPrice;
    public $SellPrice;
    public $BarCode;
    public $Unit;
    public $Tax;
    public $Status;
    public $Description;
    public $Rating;

    protected static $tableName = "products";

    protected static array $tableSchema = [
        "CategoryId"    => self::DATA_TYPE_INT,
        "Name"          => self::DATA_TYPE_STR,
        "Image"         => self::DATA_TYPE_STR,
        "Quantity"      => self::DATA_TYPE_INT,
        "BuyPrice"      => self::DATA_TYPE_DECIMAL,
        "SellPrice"     => self::DATA_TYPE_DECIMAL,
        "BarCode"       => self::DATA_TYPE_STR,
        "Unit"          => self::DATA_TYPE_INT,
        "Tax"           => self::DATA_TYPE_DECIMAL,
        "Status"        => self::DATA_TYPE_INT,
        "Description"   => self::DATA_TYPE_STR,
        "Rating"        => self::DATA_TYPE_INT,
    ];

    protected static string $primaryKey = "ProductId";

    public static function getPrimaryKey(): string
    {
        return self::$primaryKey;
    }

    public static function getProducts():  bool|\ArrayIterator
    {
        $query = "
            SELECT 
                p.*, pc.`Name` AS `CategoryName`
            FROM 
                " . self::$tableName  . "
            AS
                p
            INNER JOIN
                ". ProductCategoriesModel::getTableName() . "
            AS
                pc
            ON
                p.CategoryId = pc.CategoryId            
        ";

        return (new ProductModel)->get($query);


    }
}
