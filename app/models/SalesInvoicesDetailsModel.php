<?php

namespace APP\Models;

class SalesInvoicesDetailsModel extends AbstractModel
{
    public $Id;
    public $ProductId;
    public $ProductPrice;
    public $Quantity;
    public $InvoiceId;




    protected static $tableName = "sales_invoices_details";

    protected static array $tableSchema = [
        "Id"            => self::DATA_TYPE_INT,
        "ProductId"     => self::DATA_TYPE_INT,
        "ProductPrice"  => self::DATA_TYPE_DECIMAL,
        "Quantity"      => self::DATA_TYPE_INT,
        "InvoiceId"     => self::DATA_TYPE_INT,
    ];

    protected static string $primaryKey = "Id";

}