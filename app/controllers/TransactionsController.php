<?php

namespace APP\Controllers;


use APP\Enums\PaymentStatus;
use APP\Enums\PaymentType;
use APP\Enums\TransactionType;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\Helpers\Structures\Structures;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\SettingsModel;
use APP\Models\TransactionsPurchasesModel;
use APP\Models\TransactionsSalesModel;
use Exception;

use ReflectionException;

/**
 *
 */
class TransactionsController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;
    use structures;
    use TraitInvoiceController;



    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("transactions.default");

        $this->transactions($_POST);
        

        $this->_renderView();
    }



    /**
     * Get[http://estore.local/transactions/purchases]
     * @throws ReflectionException
     * @throws Exception
     */
    public function purchasesAction()
    {

        $this->language->load("template.common");
        $this->language->load("transactions.default");
        $this->language->load("transactions.purchases");


        $transactionsSales = new TransactionsPurchasesModel();

        $this->_info["transactionsPurchases"] = $transactionsSales->getInfoPurchasesInvoice($_POST);

        // Get Type Transaction
        $this->_info["transactionsTypes"] = $this->getSpecificProperties(obj: (new TransactionType()), flip: true);

        // Get Payment status
        $this->_info["paymentsStatus"] = $this->getSpecificProperties(obj: (new PaymentStatus()), flip: true);


        $this->_renderView();
    }

    /**
     * GET[http://estore.local/transactions/sales]
     * @throws ReflectionException
     * @throws Exception
     */
    public function salesAction()
    {
        $this->language->load("template.common");
        $this->language->load("transactions.default");
        $this->language->load("transactions.sales");

        $transactionsSales = new TransactionsSalesModel();

        $this->_info["transactionsSales"] = $transactionsSales->getInfoSalesInvoice($_POST);

        // Get Type Transaction
        $this->_info["transactionsTypes"] = $this->getSpecificProperties(obj: (new TransactionType()), flip: true);

        // Get Payment status
        $this->_info["paymentsStatus"] = $this->getSpecificProperties(obj: (new PaymentStatus()), flip: true);


        $this->_renderView();
    }

    /**
     * @throws Exception
     */
    public function pdfAction()
    {
        $idInvoice = $this->_params[0];
        $typeInvoice = $this->_params[1];
        $to = $this->_params[2];
        $invoice = null;
        $products = null;
        $idTransactor = null;
        $name= null;
        $currency = SettingsModel::getCurrency($this->session->user->UserId);

        if ($typeInvoice == "sales") {
            $invoice = TransactionsSalesModel::getInvoice($idInvoice);
            $products = TransactionsSalesModel::getProductsInvoice($idInvoice);
            $idTransactor = $invoice->ClientId;
            $name = "Client";
        } else {
            $invoice    = TransactionsPurchasesModel::getInvoice($idInvoice);
            $products   = TransactionsPurchasesModel::getProductsInvoice($idInvoice);
            $idTransactor = $invoice->SupplierId;
            $name = "Supplier";
        }

        $paymentType = $this->getSpecificProperties((new PaymentType()), flip:true);
        $paymentType = $paymentType[$invoice->PaymentType];

        $paymentStatus = $this->getSpecificProperties((new PaymentStatus()), flip:true);
        $paymentStatus = $paymentStatus[$invoice->PaymentStatus];


        require_once "../fpdf/fpdf.php";

        $pdf = new \FPDF();

        $pdf->AddPage();

        $pdf->SetFont("Arial", 'B', 20);

        $pdf->Cell(58, 10, '', 0, 0);
        $pdf->Cell(40, 5, "{$invoice->TypeInvoice} Invoice", 0, 0);
        $pdf->Cell(40, 10, '', 0, 1);


        $pdf->SetFont("Arial", 'B', 15);

        $pdf->Cell(65, 5, 'Details', 0, 0);
        $pdf->Cell(59, 5, '', 0, 0);
        $pdf->Cell(59, 5, '', 0, 1);



        $pdf->SetFont("Arial", '', 10);

        $pdf->Cell(130, 5, "Email {$invoice->Email}", 0, 0);
        $pdf->Cell(25, 5, "{$name} ID", 0, 0);
        $pdf->Cell(34, 5, "{$idTransactor}", 0, 1);


        $symbolDiscount = null;
        if ($invoice->DiscountType == "percentage") {
            $symbolDiscount = '%';
        } else {
            $symbolDiscount = $currency;
        }

        $pdf->Cell(130, 5, "Discount {$invoice->Discount} {$symbolDiscount}", 0, 0);
        $pdf->Cell(25, 5, "Payment Amount {$invoice->PaymentAmount} {$currency}", 0, 0);

        $pdf->Cell(130, 5, "", 0, 0);
        $pdf->Cell(25, 5, 'Invoice No:', 0, 0);
        $pdf->Cell(34, 5, "", 0, 1);

////////////////////
        $pdf->SetFont("Arial", '', 10);

        $pdf->Cell(71, 5, "Discount Type {$invoice->DiscountType}", 0, 0);
        $pdf->Cell(59, 5, '', 0, 0);


        $pdf->SetFont("Arial", '', 10);

        
        $pdf->Cell(130, 5, "Payment Type {$paymentType}" , 0, 0);
        $pdf->Cell(25, 5, "Payment status {$paymentStatus}", 0, 0);
        $pdf->Cell(34, 5, "", 0, 1);


        $pdf->Cell(130, 5, "{$name } address {$invoice->Address}", 0, 0);
        $pdf->Cell(25, 5, 'Invoice Date', 0, 0);
        $pdf->Cell(34, 5, "{$invoice->Created}", 0, 1);

        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'Invoice No:', 0, 0);
        $pdf->Cell(34, 5, "# {$invoice->InvoiceId}", 0, 1);

        $pdf->Cell(60, 5, "Payment Literal {$invoice->PaymentLiteral} {$currency}", 0, 0);
        $pdf->Cell(0, 5, '', 0, 0);
        $pdf->Cell(0, 5, '', 0, 1);


        $pdf->SetFont("Arial", 'B', 15);

        $pdf->Cell(130, 5, 'Bill TO', 0, 0);
        $pdf->Cell(59, 5, "{$invoice->Name}", 0, 0);


        $pdf->SetFont("Arial", 'B', 10);
        $pdf->Cell(189, 10, '', 0, 1);



        // Start Table Header
        $pdf->Cell(23, 6, 'Name', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Barcode', 1, 0, 'C');
        $pdf->Cell(70, 6, 'Description', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Qty', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Unit Price', 1, 0, 'C');
        $pdf->Cell(10, 6, 'Tax', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Total', 1, 1, 'C');
        // End Table Header


        $pdf->SetFont("Arial", '', 10);

        $totalPrice = 0;
        foreach ($products as $product) {
            $total =  ($product->ProductPrice / $product->Tax) *  $product->Quantity ;
            $totalPrice += $total;
            $pdf->Cell(23, 6, "{$product->Name}", 1, 0, 'C');
            $pdf->Cell(25, 6, "{$product->BarCode}", 1, 0, 'C');
            $pdf->Cell(70, 6, "{$product->Description}", 1, 0, 'C');
            $pdf->Cell(15, 6, "{$product->Quantity}", 1, 0, 'C');
            $pdf->Cell(30, 6, "{$product->ProductPrice} {$currency}", 1, 0, 'C');
            $pdf->Cell(10, 6, "{$product->Tax}", 1, 0, 'C');
            $pdf->Cell(25, 6, "{$total}", 1, 1, 'C');
        }

        if ($invoice->DiscountType == "percentage") {
            $totalPrice *= $invoice->Discount;
        } else {
            $totalPrice -= $invoice->Discount;
        }
        $pdf->Cell(198, 6, "Amount ", 1, 1, 'L');
        $pdf->Cell(198, -6, "{$totalPrice} {$currency}", 0, 0, 'R');

        if ($to == 'D') {
            $pdf->Output("invoice.pdf", 'D');
        } else {
            $pdf->Output();
        }

    }
}