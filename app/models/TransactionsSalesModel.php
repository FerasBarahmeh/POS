<?php

namespace APP\Models;

use ArrayIterator;
use Exception;

class TransactionsSalesModel extends AbstractModel
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
    public function getInfoSalesInvoice(NULL | array $filters = null): false|\ArrayIterator
    {
        $sql = "
            SELECT 
                I.*, R.*, C.* 
            FROM 
                sales_invoices AS I 
            INNER JOIN 
                    sales_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    clients as C 
            ON 
                I.ClientId = C.ClientId
        ";

        if ($filters != null) {

            $this->addFilterToQuery($sql, $filters);
        }
        return $this->get($sql);
    }

    public static function getInvoice($id)
    {
        $sql = "
            SELECT 
               DISTINCT I.*, R.*, C.* 
            FROM 
                sales_invoices AS I 
            INNER JOIN 
                    sales_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    clients as C 
            ON
                I.ClientId = C.ClientId
            WHERE I." . static::$primaryKey . " = ". $id . "
        ";

        return (new TransactionsSalesModel)->getRow($sql);
        
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
                    sales_invoices_details AS SID 
                ON 
                    P.ProductId = SID.ProductId 
                WHERE 
                    SID.InvoiceId = {$id}";
        return (new TransactionsSalesModel())->get($sql);
    }

    /**
     * to get last invoices
     * @param int $limit number of last invoices default return last 5 invoice
     * @return false|ArrayIterator
     */
    public static function lastInvoice(int $limit=5): false|ArrayIterator
    {
        $sql = "
            SELECT 
               DISTINCT I.*, R.*, C.* 
            FROM 
                sales_invoices AS I 
            INNER JOIN 
                    sales_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            JOIN 
                    clients as C 
            ON
                I.ClientId = C.ClientId
            LIMIT {$limit}
        ";
        return (new TransactionsSalesModel())->get($sql);
    }

    /**
     * get sum revenue today
     * @return mixed
     */
    public static function revenueToday(): mixed
    {
        $sql = "
            SELECT 
                SUM(PaymentAmount) AS revenue
            FROM 
                sales_invoices_receipts
            WHERE
                DATE(created) = (SELECT CURRENT_DATE())
        ";
        return (new TransactionsSalesModel())->getRow($sql)->revenue;
    }

    /**
     * to get Financial Receivables Today
     * @return mixed
     */
    public static function financialReceivablesToday(): mixed
    {
        $sql = "
            SELECT 
                SUM(PaymentLiteral) AS revenue
            FROM 
                sales_invoices_receipts
            WHERE
                DATE(created) = (SELECT CURRENT_DATE())
        ";
        return (new TransactionsSalesModel())->getRow($sql)->revenue;
    }

}