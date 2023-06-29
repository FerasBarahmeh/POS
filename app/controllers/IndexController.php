<?php

namespace APP\Controllers;

use APP\Enums\PaymentStatus;
use APP\Enums\TransactionType;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\Helpers\Structures\Structures;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\ClientModel;
use APP\Models\ProductCategoriesModel;
use APP\Models\PurchasesInvoicesModel;
use APP\Models\PurchasesInvoicesReceiptsModel;
use APP\Models\SalesInvoicesModel;
use APP\Models\SalesInvoicesReceiptsModel;
use APP\Models\SettingsModel;
use APP\Models\SupplierModel;
use APP\Models\TransactionsPurchasesModel;
use APP\Models\TransactionsSalesModel;
use APP\Models\UserGroupModel;
use Exception;
use ReflectionException;

class IndexController extends AbstractController  {
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;
    use structures;
    use TraitInvoiceController;

    /**
     * #Get(/)
     * @throws ReflectionException
     * @throws Exception
     */
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("index.default");
        $this->language->load("transactions.default");

        $this->_info["currency"] = SettingsModel::getCurrency($this->session->user->UserId);
        $this->_info["lastSalesInvoices"] = TransactionsSalesModel::lastInvoice();
        $this->_info["lastPurchasesInvoices"] = TransactionsPurchasesModel::lastInvoices();

        $countSaleTransactionToday = SalesInvoicesModel::countTransactionsToday();
        $countPurchasesTransactionToday = PurchasesInvoicesModel::countTransactionsToday();

        $this->_info["countSuppliers"]  = SupplierModel::enumerate();
        $this->_info["countClients"]    = ClientModel::enumerate();
        $this->_info["countCategories"] = ProductCategoriesModel::enumerate();
        $this->_info["countGroups"]     = UserGroupModel::enumerate();
        $this->_info["countSalesToday"]     = $countSaleTransactionToday;
        $this->_info["countPurchasesToday"]     = $countPurchasesTransactionToday;
        $this->_info["revenueToday"]     = TransactionsSalesModel::revenueToday() ;
        $this->_info["outcome"]     = TransactionsPurchasesModel::revenueToday();
        $this->_info["financialReceivablesToday"]     = TransactionsSalesModel::financialReceivablesToday();
        $this->_info["transactionsToday"]     = $countSaleTransactionToday + $countPurchasesTransactionToday;
        $this->_info["salesAmount"]     = SalesInvoicesReceiptsModel::sum(column: "PaymentAmount");
        $this->_info["salesLoans"]     = SalesInvoicesReceiptsModel::sum(column: "PaymentLiteral");
        $this->_info["purchasesAmount"]     = PurchasesInvoicesReceiptsModel::sum(column: "PaymentAmount");
        $this->_info["purchasesLoans"]     = PurchasesInvoicesReceiptsModel::sum(column: "PaymentLiteral");




        $this->transactions();



        $this->_renderView();
    }
}