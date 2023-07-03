<?php

namespace APP\Models;

use AllowDynamicProperties;

#[AllowDynamicProperties] class PurchasesInvoicesModel extends AbstractModel
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


    protected static $tableName = "purchases_invoices";

    protected static array $tableSchema = [
        "SupplierId"          => self::DATA_TYPE_INT,
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