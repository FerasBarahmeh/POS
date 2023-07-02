<?php
namespace APP\Controllers;

use APP\Enums\PaymentStatus;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\Models\ProductModel;
use APP\Models\PurchasesInvoicesModel;
use APP\Models\ReportsModel;
use APP\Models\SalesInvoicesModel;
use APP\Models\SettingsModel;
use APP\Models\TransactionsSalesModel;
use ReflectionException;

class ReportsController extends AbstractController
{
    use PublicHelper;
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("reports.default");


        $this->_renderView();
    }

    /**
     * GET[http://estore.local/reports/monthly]
     * @return void
     * @throws ReflectionException
     */
    public function monthlyAction(): void
    {
        $this->language->load("template.common");
        $this->language->load("reports.default");
        $this->language->load("transactions.default");
        $this->language->load("reports.monthly");

        $this->_info["invoicesLastMonth"] = ReportsModel::getInvoicesLastMonth();
        $this->_info["paymentsStatus"]    = $this->getSpecificProperties((new PaymentStatus()), flip: true);
        $this->_info["destSellingProductLastMonth"]= ProductModel::bestSellingProductLastMonth(fetchAll: true);
        $this->_info["destSellingProductPreviousMonth"]= ProductModel::bestSellingProductsInMonth(fetchAll: true);

        $this->_renderView();
    }
    /**
     * GET[http://estore.local/reports/yearly]
     * @return void
     * @throws ReflectionException
     */
    public function yearlyAction(): void
    {
        $this->language->load("template.common");
        $this->language->load("reports.default");
        $this->language->load("transactions.default");
        $this->language->load("reports.yearly");

        $this->_info["invoicesLastMonth"] = ReportsModel::getInvoicesLastYear();
        $this->_info["paymentsStatus"]    = $this->getSpecificProperties((new PaymentStatus()), flip: true);
        $this->_info["destSellingProductLastMonth"]= ProductModel::bestSellingProductLastYear(fetchAll: true);
        $this->_info["destSellingProductPreviousMonth"]= ProductModel::bestSellingProductsInYear(fetchAll: true);
        $this->_renderView();
    }
    /**
     * GET[http://estore.local/reports/daily]
     * @return void
     * @throws ReflectionException
     */
    public function dailyAction(): void
    {
        $this->language->load("template.common");
        $this->language->load("reports.default");
        $this->language->load("transactions.default");
        $this->language->load("reports.daily");

        $this->_info["currency"] = SettingsModel::getCurrency($this->session->user->UserId);
        $countSaleTransactionToday = SalesInvoicesModel::countTransactionsToday();
        $countPurchasesTransactionToday = PurchasesInvoicesModel::countTransactionsToday();
        $this->_info["countSaleTransactionToday"] = $countSaleTransactionToday;
        $this->_info["countPurchasesTransactionToday"] = $countPurchasesTransactionToday;
        $this->_info["revenueToday"]     = TransactionsSalesModel::revenueToday() ;
        $this->_info["transactionsToday"]     = $countSaleTransactionToday + $countPurchasesTransactionToday;
        $this->_renderView();
    }

    /**
     * GET[http://estore.local/reports/getMonthsAjax]
     * get month names depend on language
     * @return void
     */
    public function getMonthsAjaxAction(): void
    {
        echo json_encode($this->getMonthNames());
    }

    /**
     * GET[http://estore.local/reports/getMonthlySalesAjax]
     * get sales in last month
     * @return void
     */
    public function getMonthlySalesAjaxAction(): void
    {
        echo json_encode(ReportsModel::getStatisticsSalesMonthly());
    }
    /**
     * GET[http://estore.local/reports/getMonthlyPurchasesAjax]
     * get purchases in last month
     * @return void
     */
    public function getMonthlyPurchasesAjaxAction(): void
    {
        echo json_encode(ReportsModel::getStatisticsPurchasesMonthly());
    }
    /**
     * GET[http://estore.local/reports/getYearlySalesAjax]
     * get sales in last year
     * @return void
     */
    public function getYearlySalesAjaxAction(): void
    {
        echo json_encode(ReportsModel::getStatisticsSalesYearly());
    }
    /**
     * GET[http://estore.local/reports/getYearlyPurchasesAjax]
     * get purchases in last year
     * @return void
     */
    public function getYearlyPurchasesAjaxAction(): void
    {
        echo json_encode(ReportsModel::getStatisticsPurchasesYearly());
    }
}

