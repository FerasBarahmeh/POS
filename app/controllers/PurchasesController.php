<?php

namespace APP\Controllers;


use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\ProductModel;
use APP\Models\PurchasesInvoicesDetailsModel;
use APP\Models\PurchasesInvoicesModel;
use APP\Models\PurchasesInvoicesReceiptsModel;
use APP\Models\SupplierModel;
use ReflectionException;

/**
 *
 */
class PurchasesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;
    use TraitInvoiceController;


    /**
     * @throws ReflectionException
     */
    protected $suppliers;
    protected $products;

    private function getSupplier()
    {
        // we will Order records to use tree trie search in js
        $records = (new SupplierModel())->allLazy(["ORDER BY " => "Name ASC"]);
        $this->putLazy($this->suppliers, $records);
    }


    /**
     * @throws ReflectionException
     */
    #[GET('/purchases')]
    public function  defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("purchases.purchases");

        $this->getSupplier();
        $this->_info["suppliers"] = $this->suppliers;

        $this->setTemplateVariableProductAction();

        $this->_renderView();
    }

    private function sendJsonClient($columnName)
    {
        $this->language->load("purchases.messages");

        if (SupplierModel::countRow($columnName, $_POST["id"])) {
            $values = SupplierModel::getByPK($this->filterInt($_POST["id"]));
            $values = get_object_vars($values);
            $values["result"] = true;
            $values["id"] = $this->filterInt($_POST["id"]);
            $values["message"] = $this->language->get("message_client_exist");
            echo json_encode($values);
        } else {
            $result = [
                "message" => $this->language->get("message_client_not_exist"),
                "result" => false,
            ];
            echo json_encode($result);
        }

    }

    private function getAppropriateMessageClient($nameFile, $post)
    {
        $this->language->load($nameFile);
        $message = null;

        switch ($post["name"]) {
            case "Name":
                $message = $this->language->get("message_client_not_exist");
                break;
            case "Email":
                $message = $this->language->get("message_email_not_exist");
                break;
        }

        return $message;
    }

    /**
     * Get information client by id
     *
     * @param http://pos.local/sales/getInfoClientAjax
     * @return void
     */
    public function getInfoClientAjaxAction():void
    {

        if (!empty($_POST)) {
            if ($_POST["id"] == null) {

                $this->language->load("purchases.messages");

                $message = $this->getAppropriateMessageClient("purchases.messages", $_POST);
                echo json_encode([
                    "result" => false,
                    "message" => $message,
                ]);

            } else {
                $this->sendJsonClient("SupplierId");
            }

        }
    }


    /**
     * @throws ReflectionException
     */
    protected function sendJsonProduct($columnName)
    {
        $this->language->load("purchases.messages");
        $this->prepareProducts($columnName);
    }

    /**
     *
     * Check if employee will create has privilege to create invoice
     *
     * @param http://pos.local/sales/isHasPrivilegeUserAjax
     * @return void
     */
    public function isHasPrivilegeUserAjaxAction(): void
    {

        if (! empty($_POST)) {
            if ((int) $this->filterInt($_POST["id"]) == $this->session->user->UserId ) {
                echo json_encode(["result" => true]);
            } else {
                echo json_encode(["result" => false]);
            }
        }
    }

    private function getAppropriateMessageProduct($nameFile, $nameMessage)
    {
        $this->language->load($nameFile);
        return $this->language->get($nameMessage);
    }

    /**
     * To get all information for specific product by id
     *
     * @param http://pos.local/sales/getInfoProductAjax
     * @return void
     * @throws ReflectionException
     */
    public function getInfoProductAjaxAction(): void
    {
        if (!empty($_POST)) {
            if ($this->filterInt($_POST["id"]) == null) {
                $this->language->load("purchases.messages");

                $message = $this->getAppropriateMessageProduct("purchases.messages", "message_product_not_exist");
                echo json_encode([
                    "result" => false,
                    "message" => $message,
                ]);

            } else {
                $this->sendJsonProduct("ProductId");
            }

        }
    }

    /**
     * Check if Quantity Choose less than Quantity is store
     *
     * @param $product
     * @version 1.0
     * @return bool true if valid(Quantity choose less than stored) false else
     */
    public function isValidProduct($product): bool
    {
        return $product->QuantityChoose < $product->Quantity;
    }
    /**
     * If valid product Quantity return message success else return error message
     *
     * @param $product
     * @version 1.0
     * @return bool|string true if valid and encode json else
     */
    private function ifValidQuantity($product): bool|string
    {
        if (! $this->isValidProduct($product)) {
            $m = $this->language->feedKey(
                "message_quantity_not_enough",
                [$product->Name, $product->QuantityChoose, $product->Quantity]
            );
            return json_encode([
                "result" => false,
                "message" => $m
            ]);
        }
        return true;
    }

    /**
     * To check if quantity is valid or not
     *
     * @param http://pos.local/sales/checkIsValidProductAjax
     * @return void
     */
    public function checkIsValidProductAjaxAction(): void
    {
        $this->language->load("purchases.messages");
        $products = json_decode($_POST["products"]);

        foreach ($products as $product) {

            if (! $this->isValidProduct($product)) {
                echo $this->ifValidQuantity($product);
                return;
            }
        }
        echo json_encode([
            "result" => true
        ]);

    }

    /**
     * @param $invoice PurchasesInvoicesModel invoice object you want set discount information
     * @param $invoiceInfo object object contain all information invoice
     * @return void
     * @throws ReflectionException
     */
    private function setDiscountInvoice(PurchasesInvoicesModel &$invoice, object $invoiceInfo): void
    {
        $this->applyDiscount($invoice, $invoiceInfo);
    }

    /**
     * create Sale Invoice
     * @param $invoiceInfo object  all invoice information
     * @return array
     * @throws ReflectionException
     */
    private function addInvoice(object $invoiceInfo): array
    {
        $products = $invoiceInfo->products;

        $supplier = $invoiceInfo->client;

        $invoice = new PurchasesInvoicesModel();
        $invoice->SupplierId = $supplier->ClientId;

        return $this->addCommonInvoice($invoice, $invoiceInfo, $products, $this->_controller);
    }

    /**
     * @param $products object The products we will add To Invoice
     * @param $idInvoice int The invoice that we want to add the products to
     * @return bool
     */
    private function addDetailsToPurchasesInvoice(object $products, int $idInvoice): bool
    {
        foreach ($products as $product) {
            $details = new PurchasesInvoicesDetailsModel();
            $details->ProductId     = $this->filterInt($product->ProductId);
            $details->ProductPrice  = $this->filterFloat($product->SellPrice);
            $details->Quantity      = $this->filterInt($product->QuantityChoose);
            $details->InvoiceId     = $idInvoice;
            ProductModel::increaseProductsQty($product->ProductId, $product->QuantityChoose);
            if (!$details->save()) {
                return false;
            }
        }
        return true;

    }

    /**
     * @param $invoiceId int id invoice you want to create receipts
     * @param $infoInvoice object all information to invoice
     * @return bool
     */
    private function createReceiptsToPurchasesInvoice(int $invoiceId, object $infoInvoice): bool
    {
        $receipts = new PurchasesInvoicesReceiptsModel();
        return $this->receiptsInvoice($receipts, $invoiceId, $infoInvoice);
    }

    /**
     * Create Invoice
     * http://pos.local/createInvoiceAjax
     * @return void
     * @throws ReflectionException
     */
    public function createInvoiceAjaxAction(): void
    {

       $invoice = json_decode($_POST["invoice"]);

       $precipitate = $this->addInvoice($invoice);
       if ($precipitate) {
           $isDone = $this->addDetailsToPurchasesInvoice($invoice->products, $precipitate["invoice"]->InvoiceId);
           if ($isDone) {
               // Create receipt
               $r = $this->createReceiptsToPurchasesInvoice($precipitate["invoice"]->InvoiceId, $invoice);
               if ($r) {
                   $message = $this->getAppropriateMessageProduct("purchases.messages", "message_create_invoice_success");

               } else {
                   $message = $this->getAppropriateMessageProduct("purchases.messages", "message_create_invoice_failed");
               }

               echo json_encode([
                   "result" => true,
                   "message" => $message,
               ]);
           }
       }
    }

    /**
     * To Get Extra information to client like TOTAL RECEIVED, pending and draft
     * http://estore.local/sales/getExtraClientInfoAjax
     * @return void
     */
    public function getExtraClientInfoAjaxAction(): void
    {
        $idSupplier= $this->filterInt($_POST["id"]);
        
        $totalReceived = PurchasesInvoicesReceiptsModel::getTotalReceivedFromSupplier($idSupplier);
        
        $totalReceived = $totalReceived[0]->totalReceived;
        $literalSupplier = PurchasesInvoicesReceiptsModel::getLiteralForSupplier($idSupplier);
        $literalSupplier = $literalSupplier[0]->Literal;

        echo json_encode([
           "totalReceived"  => $totalReceived,
           "literal"        => $literalSupplier,
        ]);
    }
}