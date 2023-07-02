<?php

namespace APP\Models;

use ArrayIterator;

class ReportsModel extends AbstractModel
{
    /**
     * to get payment amount for each month in year sales
     * @version 1.0
     * @author Feras Barahmeh
     * @return false|ArrayIterator
     */
    public static function getStatisticsSalesMonthly(): false|ArrayIterator
    {
        $sql = "
            SELECT 
                YEAR(I.Created) as year, 
                MONTH(I.Created) as month, 
                COUNT(I.InvoiceId) as invoiceCount, 
                SUM(R.PaymentAmount) as amount 
            FROM 
                sales_invoices AS I 
            INNER JOIN 
                sales_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            GROUP BY 
                YEAR(I.Created), MONTH(I.Created) 
            ORDER BY 
                YEAR(I.Created), MONTH(I.Created);
        ";
        return (new ReportsModel())->get($sql);
    }
    /**
     * to get payment amount purchases for each month in year
     * @version 1.0
     * @author Feras Barahmeh
     * @return false|ArrayIterator
     */
    public static function getStatisticsPurchasesMonthly(): false|ArrayIterator
    {
        $sql = "
            SELECT 
                YEAR(I.Created) as year, 
                MONTH(I.Created) as month, 
                COUNT(I.InvoiceId) as invoiceCount, 
                SUM(R.PaymentAmount) as amount 
            FROM 
                purchases_invoices AS I 
            INNER JOIN 
                purchases_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            GROUP BY 
                YEAR(I.Created), MONTH(I.Created) 
            ORDER BY 
                YEAR(I.Created), MONTH(I.Created);
        ";
        return (new ReportsModel())->get($sql);
    }

    /**
     * to get payment amount for each year
     * @version 1.0
     * @author Feras Barahmeh
     * @return false|ArrayIterator
     */
    public static function getStatisticsSalesYearly(): false|ArrayIterator
    {
        $sql = "
            SELECT 
                YEAR(I.Created) as year, 
                COUNT(I.InvoiceId) as invoiceCount, 
                SUM(R.PaymentAmount) as amount 
            FROM 
                sales_invoices AS I 
            INNER JOIN 
                sales_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            GROUP BY 
                YEAR(I.Created)
            ORDER BY 
                YEAR(I.Created)
        ";
        return (new ReportsModel())->get($sql);
    }
    /**
     * to get payment amount purchases for this year
     * @version 1.0
     * @author Feras Barahmeh
     * @return false|ArrayIterator
     */
    public static function getStatisticsPurchasesYearly(): false|ArrayIterator
    {
        $sql = "
            SELECT 
                YEAR(I.Created) as year, 
                COUNT(I.InvoiceId) as invoiceCount, 
                SUM(R.PaymentAmount) as amount 
            FROM 
                purchases_invoices AS I 
            INNER JOIN 
                purchases_invoices_receipts AS R 
            ON 
                R.InvoiceId = I.InvoiceId 
            GROUP BY 
                YEAR(I.Created)
            ORDER BY 
                YEAR(I.Created);
        ";
        return (new ReportsModel())->get($sql);
    }

    /**
     * to get sales in the last month
     * @return false|ArrayIterator
     */
    public static function getInvoicesLastMonth(): false|ArrayIterator
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
            GROUP BY 
                YEAR(I.Created), MONTH(I.Created) 
            ORDER BY 
                YEAR(I.Created), MONTH(I.Created);
        ";
        return (new ReportsModel())->get($sql);

    }
    /**
     * to get sales in the last year
     * @return false|ArrayIterator
     */
    public static function getInvoicesLastYear(): false|ArrayIterator
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
            GROUP BY 
                YEAR(I.Created)
            ORDER BY 
                YEAR(I.Created)
        ";
        return (new ReportsModel())->get($sql);

    }
}
