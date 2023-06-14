<?php

namespace APP\Models;

use ArrayIterator;

class TransactionsSalesModel extends AbstractModel
{

    private SalesInvoicesModel $salesInvoicesModel;
    private SalesInvoicesDetailsModel $salesInvoicesDetailsModel;
    private SalesInvoicesReceiptsModel $salesInvoicesReceiptsModel;

    public function __constructor()
    {
        $this->salesInvoicesModel           = new SalesInvoicesModel();
        $this->salesInvoicesDetailsModel    = new SalesInvoicesDetailsModel();
        $this->salesInvoicesReceiptsModel   = new SalesInvoicesReceiptsModel();
    }

    /**
     * To get all information you need to show invoice in transaction page
     * @return false|ArrayIterator
     */
    public function getInfoSalesInvoice(): false|\ArrayIterator
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
        return $this->get($sql);
    }

}