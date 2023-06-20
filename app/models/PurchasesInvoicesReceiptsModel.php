<?php

namespace APP\Models;

use ArrayIterator;

class PurchasesInvoicesReceiptsModel extends AbstractModel
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




    protected static $tableName = "purchases_invoices_receipts";

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

    /**
     * @param int $idSupplier id client you want to find total reserved
     * @return false|ArrayIterator
     */
    public static function getTotalReceivedFromSupplier(int $idSupplier): false|\ArrayIterator
    {
        $sql = "
                SELECT 
                    SUM(R.PaymentAmount)  AS totalReceived
                FROM 
                    ". static::$tableName ." AS R 
                INNER JOIN 
                    purchases_invoices AS I 
                ON 
                    R.InvoiceId = I.InvoiceId 
                WHERE
                    I.SupplierId = " . $idSupplier;

        return (new PurchasesInvoicesReceiptsModel())->get($sql);
    }

    /**
     * @param int $idSupplier id client you want to find Literal
     * @return false|ArrayIterator
     */
    public static function getLiteralForSupplier(int $idSupplier): false|\ArrayIterator
    {
        $sql = "
            SELECT 
                SUM(R.PaymentLiteral) AS Literal 
            FROM 
                ". static::$tableName ." AS R 
            JOIN 
                purchases_invoices AS I 
            ON 
                I.InvoiceId = R.InvoiceId 
            WHERE I.SupplierId = " . $idSupplier;

        return (new PurchasesInvoicesReceiptsModel())->get($sql);
    }

}