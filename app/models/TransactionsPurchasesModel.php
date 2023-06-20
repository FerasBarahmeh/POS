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


}