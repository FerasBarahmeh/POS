<?php

namespace APP\Controllers;


use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\ClientModel;
use APP\Models\ProductModel;
use APP\Models\SalesInvoicesDetailsModel;
use APP\Models\SalesInvoicesModel;
use APP\Models\SalesInvoicesReceiptsModel;
use ReflectionException;

/**
 *
 */
class SalesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;
    use TraitInvoiceController;


    /**
     * @throws ReflectionException
     */
    protected $clients;
    protected $products;

    private function getClients()
    {
        // we will Order records to use tree trie search in js
        $records = (new ClientModel())->allLazy(["ORDER BY " => "Name ASC"]);
        $this->putLazy($this->clients, $records);
    }



    /**
     * @throws ReflectionException
     */
    #[GET('/sales/sellproduct')]
    public function sellProductAction()
    {

        $this->language->load("template.common");
        $this->language->load("sales.sellproducts");
        $this->language->load("sales.messages");

        $this->getClients();
        $this->_info["clients"] = $this->clients;

        $this->setTemplateVariableProductAction();

        $this->_renderView();
    }

    private function sendJsonClient($columnName)
    {
        $this->language->load("sales.messages");

        if (ClientModel::countRow($columnName, $_POST["id"])) {
            $values = ClientModel::getByPK($this->filterInt($_POST["id"]));
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

                $this->language->load("sales.messages");

                $message = $this->getAppropriateMessageClient("sales.messages", $_POST);
                echo json_encode([
                    "result" => false,
                    "message" => $message,
                ]);

            } else {
                $this->sendJsonClient("ClientId");
            }

        }
    }


    /**
     * @throws ReflectionException
     */
    private function sendJsonProduct($columnName)
    {
        $this->language->load("sales.messages");
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
                $this->language->load("sales.messages");

                $message = $this->getAppropriateMessageProduct("sales.messages", "message_product_not_exist");
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
        $this->language->load("sales.messages");
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
     * @param $invoice SalesInvoicesModel invoice object you want set discount information
     * @param $invoiceInfo object object contain all information invoice
     * @return void
     * @throws ReflectionException
     */
    private function setDiscountInvoice(SalesInvoicesModel &$invoice, object $invoiceInfo): void
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
        $client = $invoiceInfo->client;

        $invoice = new SalesInvoicesModel();
        $invoice->ClientId = $client->ClientId;
        return $this->addCommonInvoice($invoice, $invoiceInfo, $products, $this->_controller);
    }

    /**
     * @param $products object The products we will add To Invoice
     * @param $idInvoice int The invoice that we want to add the products to
     * @return bool
     */
    private function addDetailsToSaleInvoice(object $products, int $idInvoice): bool
    {
        foreach ($products as $product) {
            $details = new SalesInvoicesDetailsModel();
            $details->ProductId     = $this->filterInt($product->ProductId);
            $details->ProductPrice  = $this->filterFloat($product->SellPrice);
            $details->Quantity      = $this->filterInt($product->QuantityChoose);
            $details->InvoiceId     = $idInvoice;
            ProductModel::discountProductsQty($product->ProductId, $product->QuantityChoose);
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
    private function createReceiptsToSaleInvoice(int $invoiceId, object $infoInvoice): bool
    {
        $receipts = new SalesInvoicesReceiptsModel();
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
           $isDone = $this->addDetailsToSaleInvoice($invoice->products, $precipitate["invoice"]->InvoiceId);
           if ($isDone) {
               // Create receipt
               $r = $this->createReceiptsToSaleInvoice($precipitate["invoice"]->InvoiceId, $invoice);

               if ($r) {
                   $message = $this->getAppropriateMessageProduct("sales.messages", "message_create_invoice_success");

               } else {
                   $message = $this->getAppropriateMessageProduct("sales.messages", "message_create_invoice_failed");
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
     * http://pos.local/sales/getExtraClientInfoAjax
     * @return void
     */
    public function getExtraClientInfoAjaxAction(): void
    {
        $idClient = $this->filterInt($_POST["id"]);
        
        $totalReceived = SalesInvoicesReceiptsModel::getTotalReceivedFromClient($idClient);
        
        $totalReceived = $totalReceived[0]->totalReceived;
        $literalClient = SalesInvoicesReceiptsModel::getLiteralForClient($idClient);
        $literalClient = $literalClient[0]->Literal;

        echo json_encode([
           "totalReceived"  => $totalReceived,
           "literal"        => $literalClient,
        ]);
    }
    /**
     *
     * Get Word Language by get specific name file
     *
     * http://pos.local/getMessagesAjax/{Name File}
     * @return void
     */
    public function getMessagesAjaxAction(): void
    {
        $this->language->load($_POST["nameFile"]);
        $messages = $this->language->getDictionary();
        echo json_encode($messages);
    }
}