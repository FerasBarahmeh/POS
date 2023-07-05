<?php

namespace APP\Models;

use APP\Helpers\PublicHelper\PublicHelper;
use ArrayIterator;

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

    /**
     * method to get products
     * @param array $ordered array contain ordered by and type order
     * @return bool|ArrayIterator
     * @version 1.1
     * @author Feras Barahmeh
     */
    public static function getProducts(array $ordered=[]):  bool|\ArrayIterator
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
        if ($ordered) {
            foreach ($ordered as $by => $type)
            $query .= " ORDER BY $by $type ";
        }

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

    /**
     * to get the best product selling
     * @param string $property name column you want returned
     * @param bool $fetchAll if you need all property return set true default return Name
     * @return mixed return just property if fetchAll true else return all property
     */
    public static function bestSellingProductLastMonth(string $property="Name", bool $fetchAll=false): mixed
    {
        $sql = "
        SELECT 
            COUNT(P.ProductId) AS repeated, P.{$property}, P.Description
        FROM 
            products AS P
        INNER JOIN 
            sales_invoices_details SID ON P.ProductId = SID.ProductId 
        GROUP BY 
            P.ProductId
        ORDER BY
            repeated DESC
        LIMIT 1;";
        if ($fetchAll) {
            return (new ProductModel())->getRow($sql);
        } else {
            $res = (new ProductModel())->getRow($sql);
            if ($res == null && ! isset($res->$property)) {
                return null;
            }
            return $res->$property;
//            return (new ProductModel())->getRow($sql)->$property;
        }
    }

    /**
     * get best-selling product in previous month if current month jun the previous month December
     * @param string $property property you want returned
     * @param bool $fetchAll  if you want return all property or just $property selected
     * @return int|mixed return just property if fetchAll true else return all property
     */
    public static function bestSellingProductsInMonth(string $property="Name", bool $fetchAll=false): mixed
    {
        $sql = "
        SELECT 
            COUNT(P.ProductId) AS repeated, P.{$property}, P.Description
        FROM 
            products AS P
        INNER JOIN 
            sales_invoices_details SID ON P.ProductId = SID.ProductId
        JOIN 
            sales_invoices AS SI
        WHERE 
            SI.Created BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND DATE_FORMAT(NOW() ,'%Y-%m-01')
        GROUP BY 
            P.ProductId
        ORDER BY 
            repeated DESC
        LIMIT 1;";
        if ($fetchAll) {
            return (new ProductModel())->getRow($sql);
        } else {
            $res = (new ProductModel())->getRow($sql);
            if ($res == null && ! isset($res->$property)) {
                return null;
            }
            return $res->$property;
//            return (new ProductModel())->getRow($sql)->$property;
        }
    }

    /**
     * to get the best product selling
     * @param string $property name column you want returned
     * @param bool $fetchAll if you need all property return set true default return Name
     * @return mixed return just property if fetchAll true else return all property
     */
    public static function bestSellingProductLastYear(string $property="Name", bool $fetchAll=false): mixed
    {
        $sql = "
        SELECT 
            COUNT(P.ProductId) AS repeated, P.{$property}, P.Description
        FROM 
            products AS P
        INNER JOIN 
            sales_invoices_details SID ON P.ProductId = SID.ProductId 
        JOIN 
            sales_invoices AS SI
        GROUP BY 
            P.ProductId
        ORDER BY
            repeated DESC
        LIMIT 1;";
        if ($fetchAll) {
            return (new ProductModel())->getRow($sql);
        } else {
            return (new ProductModel())->getRow($sql)->$property;
        }
    }

    /**
     * get best-selling product in previous month if current month jun the previous month December
     * @param string $property property you want returned
     * @param bool $fetchAll  if you want return all property or just $property selected
     * @return int|mixed return just property if fetchAll true else return all property
     */
    public static function bestSellingProductsInYear(string $property="Name", bool $fetchAll=false): mixed
    {
        $sql = "
        SELECT 
            COUNT(P.ProductId) AS repeated, P.{$property}, P.Description
        FROM 
            products AS P
        INNER JOIN 
            sales_invoices_details SID ON P.ProductId = SID.ProductId
        JOIN 
            sales_invoices AS SI
        WHERE 
            SI.Created BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 YEAR, '%Y-01-01') AND DATE_FORMAT(NOW() ,'%Y-01-01')
        GROUP BY 
            P.ProductId
        ORDER BY 
            repeated DESC
        LIMIT 1;";
        if ($fetchAll) {
            return (new ProductModel())->getRow($sql);
        } else {
            return (new ProductModel())->getRow($sql)->$property;
        }
    }


}
