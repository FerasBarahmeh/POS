<?php

namespace APP\Controllers;


use APP\Enums\PaymentStatus;
use APP\Enums\TransactionType;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\TransactionsSalesModel;
use ReflectionException;

/**
 *
 */
class TransactionsController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;

    /**
     * @throws ReflectionException
     */
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("transactions.default");

        $transactionsSales = new TransactionsSalesModel();

        $this->_info["transactionsSales"] = $transactionsSales->getInfoSalesInvoice();

        // Get Type Transaction
        $this->_info["transactionsTypes"] = $this->getSpecificProperties(obj: (new TransactionType()), flip: true);

        // Get Payment status
        $this->_info["paymentsStatus"] = $this->getSpecificProperties(obj: (new PaymentStatus()), flip: true);


        $this->_renderView();
    }
}