<?php

namespace APP\Models;

use APP\Helpers\PublicHelper\PublicHelper;

class ProductModel extends AbstractModel
{
    use PublicHelper;
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

    private function ifEqualArray(array $iterOne, array $iterTow): bool | int
    {
        $countOne = 0;
        $countTow = 0;

        while (! $iterOne[$countOne] || $iterTow[$countTow]) {
            $countOne++;
            $countTow++;
        }
        if ($countOne == $countTow) {
            return $countOne;
        } else {
            return false;
        }
    }
    public function getRequestedProducts(array $products): false|\ArrayIterator
    {
        $query = "SELECT 
                ProductId, Name, Quantity
            FROM
                products
            WHERE
                
        ";
        foreach ($products as $id => $quantityChoose) {
            $query .= " (ProductId = " . $id . " AND Quantity <= " . $quantityChoose . ") OR ";
        }

        $this->removeLastWord($query);
        $query .= " ORDER BY ProductId";

        return (new ProductModel())->get($query);
    }

    public static function discountProductsQty(int $id, int $qty)
    {
        $sql = "UPDATE " . static::$tableName . " SET  Quantity = Quantity - " . $qty . " WHERE  ProductId = " . $id;
        return (new ProductModel())->executeQuery($sql);
    }
    public static function increaseProductsQty(int $id, int $qty)
    {
        $sql = "UPDATE " . static::$tableName . " SET  Quantity = Quantity + " . $qty . " WHERE  ProductId = " . $id;
        return (new ProductModel())->executeQuery($sql);
    }

    public static function bestSellingProducts(string $property="Name")
    {
        $sql = "
        SELECT 
            COUNT(P.ProductId) AS repeated, P.Name
        FROM 
            products AS P
        INNER JOIN 
            sales_invoices_details SID ON P.ProductId = SID.ProductId 
        GROUP BY 
            P.ProductId
        ORDER BY 
            repeated DESC
        LIMIT 1;";
        return (new ProductModel())->getRow($sql)->$property;
    }
}
