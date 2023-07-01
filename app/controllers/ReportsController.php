<?php
namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\Models\ReportsModel;

class ReportsController extends AbstractController
{
    use PublicHelper;
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("reports.default");


        $this->_renderView();
    }

    public function getMonthsAjaxAction(): void
    {
        echo json_encode($this->getMonthNames());
    }

    public function getMonthlySalesAjaxAction()
    {
        echo json_encode(ReportsModel::getStatisticsSalesMonthly());
    }
    public function getMonthlyPurchasesAjaxAction()
    {
        echo json_encode(ReportsModel::getStatisticsPurchasesMonthly());
    }
    public function getYearlySalesAjaxAction()
    {
        echo json_encode(ReportsModel::getStatisticsSalesYearly());
    }
    public function getYearlyPurchasesAjaxAction()
    {
        echo json_encode(ReportsModel::getStatisticsPurchasesYearly());
    }
}

