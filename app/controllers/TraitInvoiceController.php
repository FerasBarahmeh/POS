<?php

namespace APP\Controllers;



use APP\Enums\DiscountType;
use APP\Enums\PaymentStatus;
use APP\Enums\PaymentType;
use APP\Enums\StatusProduct;
use APP\Enums\TransactionType;
use APP\Enums\Units;
use APP\Models\ProductModel;
use APP\Models\TransactionsPurchasesModel;
use APP\Models\TransactionsSalesModel;
use Exception;
use ReflectionException;

trait TraitInvoiceController
{

    /**
     * @throws ReflectionException
     */
    protected function setTemplateVariableProductAction(): void
    {
        $units = new Units();
        $initUnit = $units->getDefault();
        $paymentTypes = new PaymentType();
        $initPaymentType = $paymentTypes->getDefault();

        $paymentStatus = new PaymentStatus();
        $intPaymentStatus = $paymentStatus->getDefault();
        $statusProduct = new StatusProduct();
        $initStatusProduct = $statusProduct->getDefault();

        $discountType = new DiscountType();


        $this->_info["products"] = ProductModel::getProducts();

        $this->_info["units"] = $this->getSpecificProperties($units);
        $this->_info["initUnits"] = $initUnit;

        $this->_info["paymentTypes"] = $this->getSpecificProperties($paymentTypes, "default", true);
        $this->_info["initPaymentType"] = $initPaymentType;

        $this->_info["paymentStatus"] = $this->getSpecificProperties($paymentStatus, "default", true);
        $this->_info["intPaymentStatus"] = $intPaymentStatus;

        $this->_info["status"] = $this->getSpecificProperties($statusProduct, "default", true);
        $this->_info["initStatusProduct"] = $initStatusProduct;

        $this->_info["discountTypes"] = $this->getSpecificProperties($discountType, null, true);
    }
    /**
     * @throws ReflectionException
     */
    protected function setAnomalyValues(&$values): void
    {
        $values["Unit"] = $this->language->get(
            $this->getNameByNumber(
                "unit",
                $values["Unit"],
                $this->getSpecificProperties(new Units(), 'default', true),
            ));

        $values["QuantityChoose"] = 1;
        $values["result"] = true;
        $values["Image"] = UPLOAD_FOLDER_IMAGE . $values["Image"];
        $values["message"] = $this->language->get("message_product_exist");
    }

    /**
     * Method to prepare product to before create invoice
     * @throws ReflectionException
     */
    protected function prepareProducts($columnName): void
    {
        $this->language->load("units.units");

        if (ProductModel::countRow($columnName, $this->filterInt($_POST["id"]))) {
            $values = ProductModel::getByPK($this->filterInt($_POST["id"]));


            $values = get_object_vars($values);
            $this->setAnomalyValues($values);

            if ($values["Status"] == (new StatusProduct)->available)
                echo json_encode($values);
            else {
                $result = [
                    "message" => $this->language->get("message_status_message"),
                    "result" => false,
                ];
                echo json_encode($result);
            }
        } else {
            $result = [
                "message" => $this->language->get("message_product_not_exist"),
                "result" => false,
            ];
            echo json_encode($result);
        }
    }

    /**
     * method to check if it has discount and if it has applied it
     * @throws ReflectionException
     */
    protected function applyDiscount(&$invoice, object $invoiceInfo): void
    {
        if ($invoiceInfo->DiscountType !== NULL && $invoiceInfo->discount > 0) {
            $discountTypes = $this->getSpecificProperties((new DiscountType()), flip: true);
            $invoice->DiscountType = $discountTypes[$invoiceInfo->DiscountType];
            $invoice->Discount = $invoiceInfo->discount;
        } else {
            $invoice->DiscountType = NULL;
            $invoice->Discount = 0;
        }
    }

    /**
     * @throws ReflectionException
     */
    protected function addCommonInvoice(&$invoice, &$invoiceInfo, $products, $typeInvoice): array
    {
        $invoice->PaymentType = $invoiceInfo->typePaymentValue;


        $invoice->PaymentStatus = $invoiceInfo->statusInvoiceValue;
        $invoice->Created = date("Y-m-d H:i:s");

        $this->setDiscountInvoice($invoice, $invoiceInfo);

        $invoice->UserId = $this->session->user->UserId;

        $invoice->NumberProducts = count((array)$products);
        $invoice->TypeInvoice = $typeInvoice;

        $result = $invoice->save();

        return [
            "result" => $result,
            "invoice" => $invoice
        ];
    }

    protected function receiptsInvoice(&$receipts, int $invoiceId, object $infoInvoice)
    {
        $receipts->InvoiceId = $invoiceId;

        $receipts->PaymentType = $infoInvoice->typePaymentValue;
        $receipts->PaymentAmount = $infoInvoice->paymentAmount;
        $receipts->PaymentLiteral = (string) ((float)$infoInvoice->totalPriceWithTax - (float)$infoInvoice->paymentAmount);
        $receipts->TotalPrice = (float) $receipts->PaymentAmount + (float) $receipts->PaymentLiteral;
        $receipts->Note = $infoInvoice->Note;
        $receipts->BankName = NULL;
        $receipts->BankAccountNumber = NULL;
        $receipts->CheckNumber = NULL;
        $receipts->TransferredTo = NULL;
        $receipts->created = $infoInvoice->IssuedOn;
        $receipts->UserId = $infoInvoice->employee;

        return $receipts->save();
    }

    /**
     * method to get all transaction (sales, purchase) randomly sort
     * @throws ReflectionException
     * @throws Exception
     */
    protected function transactions($filter=null): void
    {

        $sales = null; $purchases = null;
        if ($filter && ! isset($filter["resit"])) {
            $sales = TransactionsSalesModel::getInfoSalesInvoice($filter);
            $purchases = TransactionsPurchasesModel::getInfoPurchasesInvoice($filter);
        } else {
            $sales = TransactionsSalesModel::getInfoSalesInvoice();
            $purchases = TransactionsPurchasesModel::getInfoPurchasesInvoice();
        }

        $this->_info["transactions"] = $sales && $purchases ?
            $this->mergeArraysRandomly(iterator_to_array(@$sales), iterator_to_array(@$purchases)) :
            ($sales ?: $purchases);


        // Get Type Transaction
        $this->_info["transactionsTypes"] = $this->getSpecificProperties(obj: (new TransactionType()), flip: true);

        // Get Payment status
        $this->_info["paymentsStatus"] = $this->getSpecificProperties(obj: (new PaymentStatus()), flip: true);
    }
}