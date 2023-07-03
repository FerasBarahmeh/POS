<?php

namespace APP\Models;

class SalesInvoicesModel extends AbstractModel
{
    public $InvoiceId;
    public $ClientId;
    public $PaymentType;
    public $PaymentStatus;
    public $Created;
    public $Discount;
    public $UserId;
    public $DiscountType;
    public $NumberProducts;
    public $TypeInvoice;


    protected static $tableName = "sales_invoices";

    protected static array $tableSchema = [
        "InvoiceId"          => self::DATA_TYPE_INT,
        "ClientId"          => self::DATA_TYPE_INT,
        "PaymentType"       => self::DATA_TYPE_INT,
        "PaymentStatus"     => self::DATA_TYPE_INT,
        "Created"           => self::DATA_TYPE_STR,
        "Discount"          => self::DATA_TYPE_DECIMAL,
        "UserId"            => self::DATA_TYPE_INT,
        "DiscountType"      => self::DATA_TYPE_STR,
        "NumberProducts"    => self::DATA_TYPE_INT,
        "TypeInvoice"    => self::DATA_TYPE_STR,
    ];

    protected static string $primaryKey = "InvoiceId";

}