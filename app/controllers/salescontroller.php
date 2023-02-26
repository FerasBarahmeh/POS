<?php
namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\Models\ClientModel;
use function APP\pr;

class SalesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    public function sellProductAction()
    {

        $this->language->load("template.common");
        $this->language->load("sales.sellproducts");

        $this->_info["clients"] = ClientModel::getAll();

        $this->_renderView();
    }

    private function sendJson($columnName)
    {
        $this->language->load("sales.messages");

        if (ClientModel::countRow($columnName, $this->filterInt($_POST["primaryKey"]))) {
            $values = ClientModel::getByPK($this->filterInt($_POST["primaryKey"]));
            $values = get_object_vars($values);
            $values["result"] = true;
            $values["message"] = $this->language->get("message_client_exist");
            echo  json_encode($values);
        } else {
            $result = [
                "message" => $this->language->get("message_client_not_exist"),
                "result"  => false,
            ];
            echo json_encode($result);
        }

    }

    private function getAppropriateMessage($nameFile, $post)
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

                $message = $this->getAppropriateMessage("sales.messages", $_POST);
                echo json_encode([
                    "result" => false,
                    "message" => $message,
                ]);

            } else {
                $this->sendJson("ClientId");
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