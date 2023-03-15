<?php
namespace APP\Controllers;

use APP\Enums\PaymentStatus;
use APP\Enums\PaymentType;
use APP\Enums\StatusProduct;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Template\TemplateHelper;
use APP\LIB\Template\Units;
use APP\Models\ClientModel;
use APP\Models\ProductCategoriesModel;
use APP\Models\ProductModel;
use APP\Models\UserModel;
use function APP\pr;

class SalesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use TemplateHelper;


    /**
     * @throws \ReflectionException
     */
    public function sellProductAction()
    {

        $this->language->load("template.common");
        $this->language->load("sales.sellproducts");

        $this->_info["clients"]         = ClientModel::getAll();
        $this->_info["products"]        = ProductModel::getProducts();
        $this->_info["units"]           = $this->getClassValuesProperties(new Units());
        $this->_info["paymentType"]     = $this->getClassValuesProperties(new PaymentType());
        $this->_info["paymentStatus"]   = $this->getClassValuesProperties(new PaymentStatus());
        $this->_info["status"]          = $this->getClassValuesProperties(new StatusProduct());

        $this->_renderView();
    }

    private function sendJsonClient($columnName)
    {
        $this->language->load("sales.messages");

        if (ClientModel::countRow($columnName, $this->filterInt($_POST["primaryKey"]))) {
            $values = ClientModel::getByPK($this->filterInt($_POST["primaryKey"]));
            $values = get_object_vars($values);
            $values["result"]   = true;
            $values["id"]       = $this->filterInt($_POST["primaryKey"]);
            $values["message"]  = $this->language->get("message_client_exist");
            echo  json_encode($values);
        } else {
            $result = [
                "message" => $this->language->get("message_client_not_exist"),
                "result"  => false,
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
    public function getInfoClientAjaxAction()
    {
        if (! empty($_POST)) {
            if ($this->filterInt($_POST["primaryKey"]) == null) {
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

    private function setAnomalyValues(&$values)
    {
        $values["Unit"] = $this->language->get(
            $this->getNameByNumber(
                "unit",
                    $values["Unit"],
                    $this->getClassValuesProperties(new Units())));

        $values["QuantityChoose"] = 1;
        $values["result"] = true;
        $values["Image"] = UPLOAD_FOLDER_IMAGE . $values["Image"];
        $values["message"] = $this->language->get("message_product_exist");
    }
    private function sendJsonProduct($columnName)
    {
        $this->language->load("sales.messages");
        $this->language->load("units.units");

        if (ProductModel::countRow($columnName, $this->filterInt($_POST["primaryKey"]))) {
            $values = ProductModel::getByPK($this->filterInt($_POST["primaryKey"]));


            $productsCategory = ProductModel::getBy(["products.CategoryId" => $values->CategoryId]);


            $values = get_object_vars($values);
            $this->setAnomalyValues($values);

            if ($values["Status"] == (new StatusProduct)->available )
                echo  json_encode($values);
            else {
                $result = [
                    "message" => $this->language->get("message_status_message"),
                    "result"  => false,
                ];
                echo json_encode($result);
            }
        } else {
            $result = [
                "message" => $this->language->get("message_product_not_exist"),
                "result"  => false,
            ];
            echo json_encode($result);
        }

    }
    private function getAppropriateMessageProduct($nameFile, $nameMessage)
    {
        $this->language->load($nameFile);
        return $this->language->get($nameMessage);
    }

    private function addInvoice()
    {
        echo json_encode([
           "message" => $this->language->get("message_success_user"),
            "result" => true
        ]);
    }
    public function checkIfHasPrivilegeUserAjaxAction()
    {

        if (! empty($_POST)) {
            $namePost = $this->filterStr($_POST["UserName"]);
            $userExist = UserModel::count("UserName", $this->filterStr($_POST["UserName"]));
            
            $password = crypt($this->filterStr($_POST["Password"]), MAIN_SALT);

            $this->language->load("sales.messages");
            if ($this->session->user->UserName !== $namePost || $userExist === false ) {

                $message = $this->language->feedKey(
                    "message_user_cannot_create_invoice",
                    [$namePost]);
                $message .= " <b class='bold-font'>OR</b> " . $this->language->feedKey(
                        "message_user_not_found",
                        [$namePost]);
                echo json_encode([
                    "message" => $message,
                    "result" => false
                ]);
                
            } elseif ($this->session->user->Password != $password) {
                $message = $this->language->get("message_un_valid_password");
                echo json_encode([
                    "message" => $message,
                    "result" => false,
                ]);
            } else {
                // prepare To Add invoice
                $this->addInvoice();
            }

        }

    }

    public function getInfoProductAjaxAction()
    {
        if (! empty($_POST)) {
            if ($this->filterInt($_POST["primaryKey"]) == null) {
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
    public function getMessagesAjaxAction()
    {
        $this->language->load($_POST["nameFile"]);
        $messages = $this->language->getDictionary();
        echo json_encode($messages);
    }
}