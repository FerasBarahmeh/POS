<?php

namespace APP\Controllers;

use APP\Enums\DiscountType;
use APP\Enums\PaymentStatus;
use APP\Enums\PaymentType;
use APP\Enums\Units;
use APP\Enums\StatusProduct;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\Models\ClientModel;
use APP\Models\ProductModel;
use APP\Models\SalesInvoicesModel;
use APP\Models\UserModel;
use ReflectionException;

/**
 *
 */
class SalesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;


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
    private function setTemplateVariableSellProductAction()
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
    #[GET('/sales/sellproduct')]
    public function sellProductAction()
    {

        $this->language->load("template.common");
        $this->language->load("sales.sellproducts");
        $this->language->load("sales.messages");

        $this->getClients();
        $this->_info["clients"] = $this->clients;

        $this->setTemplateVariableSellProductAction();

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
     * @param http://estore.local/sales/getInfoClientAjax
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
    private function setAnomalyValues(&$values)
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

    private function sendJsonProduct($columnName)
    {
        $this->language->load("sales.messages");
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


    private function addAction($transactionParty, $detailsInvoice)
    {
        $invoice = new SalesInvoicesModel();
        $invoice->ClientId = $transactionParty->id;
        $invoice->PaymentType = $detailsInvoice->statusPaymentValue;

        $paymentTypes = $this->getClassValuesProperties(new PaymentStatus());

        $invoice->PaymentStatus = $paymentTypes[strtolower($detailsInvoice->statusPaymentName)];
        $invoice->Created = date("Y-m-d H:i:s");
        $invoice->Discount = $detailsInvoice->discount;
        $invoice->UserId = $this->session->user->UserId;
        $invoice->DiscountType = $detailsInvoice->discountType;
        $invoice->NumberProducts = $detailsInvoice->productsNum;

        $invoice->save();
    }

    /**
     *
     * Check if employee will create has privilege to create invoice
     *
     * @param http://estore.local/sales/isHasPrivilegeUserAjax
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
     * @param http://estore.local/sales/getInfoProductAjax
     * @return void
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
     * @param http://estore.local/sales/checkIsValidProductAjax
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
     *
     * Get Word Language by get specific name file
     *
     * http://estore.local/getMessagesAjax/{Name File}
     * @return void
     */
    public function getMessagesAjaxAction(): void
    {
        $this->language->load($_POST["nameFile"]);
        $messages = $this->language->getDictionary();
        echo json_encode($messages);
    }
}