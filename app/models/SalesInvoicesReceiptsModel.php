<?php

namespace APP\Models;

class SalesInvoicesReceiptsModel extends AbstractModel
{
    public $ReceiptId;
    public $InvoiceId;
    public $PaymentType;
    public $PaymentAmount;
    public $PaymentLiteral;
    public $BankAccountNumber;
    public $BankName;
    public $CheckNumber;
    public $TransferredTo;
    public $created;
    public $UserId;




    protected static $tableName = "sales_invoices_receipts";

    protected static array $tableSchema = [
        "ReceiptId"            => self::DATA_TYPE_INT,
        "InvoiceId"     => self::DATA_TYPE_INT,
        "PaymentType"  => self::DATA_TYPE_INT,
        "PaymentAmount"      => self::DATA_TYPE_DECIMAL,
        "PaymentLiteral"     => self::DATA_TYPE_DECIMAL,
        "BankAccountNumber"     => self::DATA_TYPE_STR,
        "BankName"     => self::DATA_TYPE_STR,
        "CheckNumber"     => self::DATA_TYPE_STR,
        "TransferredTo"     => self::DATA_TYPE_STR,
        "created"     => self::DATA_TYPE_STR,
        "UserId"     => self::DATA_TYPE_INT,
    ];

    protected static string $primaryKey = "ReceiptId";

}