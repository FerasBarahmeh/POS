<?php

namespace APP\Models;

use ArrayIterator;
use Exception;

class TransactionsPurchasesModel extends AbstractModel
{
    use TraitTransactionsModel;
    private SalesInvoicesModel $salesInvoicesModel;
    private SalesInvoicesDetailsModel $salesInvoicesDetailsModel;
    private SalesInvoicesReceiptsModel $salesInvoicesReceiptsModel;
    protected static string $primaryKey = "InvoiceId";

    public function __constructor()
    {
        $this->salesInvoicesModel           = new SalesInvoicesModel();
        $this->salesInvoicesDetailsModel    = new SalesInvoicesDetailsModel();
        $this->salesInvoicesReceiptsModel   = new SalesInvoicesReceiptsModel();
    }

    /**
     * To get all information you need to show invoice in transaction page
     * @param array|NULL $filters
     * @return false|ArrayIterator
     * @throws Exception
     */
    public function getInfoPurchasesInvoice(NULL | array $filters = null): false|\ArrayIterator
    {
        $sql = "
            SELECT 
                I.*, R.*, C.* 
            FROM 
                purchases_invoices AS I 
            INNER JOIN 
                    purchases_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    suppliers as C 
            ON 
                I.SupplierId = C.SupplierId
        ";

        if ($filters != null) {
            $this->addFilterToQuery($sql, $filters);
        }
        return $this->get($sql);
    }

    public static function getInvoice(int $id)
    {
        $sql = "
            SELECT 
                I.*, R.*, C.* 
            FROM 
                purchases_invoices AS I 
            INNER JOIN 
                    purchases_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    suppliers as C 
            ON 
                I.SupplierId = C.SupplierId
            WHERE I.". static::$primaryKey ." = {$id}
        ";

        return (new TransactionsPurchasesModel())->getRow($sql);
    }
    /**
     *
     * method to get all products in this invoice
     * @param int $id The invoice number containing the products
     * @return false|ArrayIterator false if not products else return products
     */
    public static function getProductsInvoice(int $id): false|ArrayIterator
    {

        $sql = "SELECT 
                    * 
                FROM 
                    products AS P 
                INNER JOIN 
                    purchases_invoices_details AS SID 
                ON 
                    P.ProductId = SID.ProductId 
                WHERE 
                    SID.InvoiceId = {$id}";
        return (new TransactionsPurchasesModel())->get($sql);
    }

    public static function lastInvoices(int $limit=5): false|ArrayIterator
    {
        $sql = "
            SELECT 
                I.*, R.*, C.* 
            FROM 
                purchases_invoices AS I 
            INNER JOIN 
                    purchases_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    suppliers as C 
            ON 
                I.SupplierId = C.SupplierId
            LIMIT {$limit}
        ";
        return (new TransactionsPurchasesModel())->get($sql);
    }
    public static function revenueToday()
    {
        $sql = "
            SELECT 
                SUM(PaymentAmount) AS revenue
            FROM 
                purchases_invoices_receipts
            WHERE
                DATE(created) = (SELECT CURRENT_DATE())
        ";
        return (new TransactionsSalesModel())->getRow($sql)->revenue;
    }
    public static function financialReceivablesToday()
    {
        $sql = "
            SELECT 
                SUM(PaymentLiteral) AS revenue
            FROM 
                purchases_invoices_receipts
            WHERE
                DATE(created) = (SELECT CURRENT_DATE())
        ";
        return (new TransactionsSalesModel())->getRow($sql)->revenue;
    }
}