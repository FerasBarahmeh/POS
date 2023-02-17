<?php
namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\Models\ClientModel;

class ClientsController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    private array $_rolesValid = [
        "Name"              => ["req", "alpha",  "between(2,30)",],
        "Email"             => ["req", "email"],
        "PhoneNumber"       => ["req", "alphanum"],
        "Address"           => ["req", "alphanum", "max(50)"],
    ];
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("clients.default");
        $this->_info["clients"] = ClientModel::getAll();

        $this->_renderView();
    }
    private function setAttributeSuplpplier($client)
    {
        $client->Name = $this->filterStr($_POST["Name"]);
        $client->Email                = $this->filterStr($_POST["Email"]);
        $client->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);
        $client->Address              = $this->filterStr($_POST["Address"]);

    }
    private function saveSupplier($client, $messageSuccess, $messageFail)
    {
        if ($client->save()) {
            $this->message->addMessage(
                $this->language->get($messageSuccess) . " <b class='bold-font'>" . $client->Name . "</b>",
            );
        } else {
            $this->message->addMessage(
                $this->language->get($messageFail) . "<b class='bold-font'>" . $client->Name . "</b>",
                Messenger::MESSAGE_DANGER
            );
        }

    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("clients.add");
        $this->language->load("messages.errors");
        $this->language->load("clients.messages");

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST))  {

            $client = new ClientModel();

            $this->setAttributeSuplpplier($client);

            $this->saveSupplier($client, "message_add_success", "message_add_field");

            $this->redirect("/clients");
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $idClient =  $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($idClient);

        if (! $client) { // Supplier not exist
            $this->redirect("/clients");
        }

        $this->_info["client"] = $client;

        $this->language->load("template.common");
        $this->language->load("clients.edit");
        $this->language->load("clients.messages");
        $this->language->load("messages.errors");

        if (isset($_POST["edit"]) && $this->isAppropriate($this->_rolesValid, $_POST) )  {
            $client->Name                 = $this->filterStr($_POST["Name"]);
            $client->Email                = $this->filterStr($_POST["Email"]);
            $client->Address              = $this->filterStr($_POST["Address"]);
            $client->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);

            $this->saveSupplier($client, "message_edit_success", "message_edit_fail");

            $this->redirect("/clients");
        }
        $this->_renderView();
    }
    public function deleteAction()
    {
        $this->language->load("clients.messages");
        $idClient =  $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($idClient);


        // If supplier not register in application
        if (! $client) {
            $this->redirect("/clients");
        }


        if ($client->delete()) {
            $this->message->addMessage(
                $this->language->get("message_delete_supplier_success") . "<b class='bold-font'> " . $client->Name . "</b>",
            );
        } else {
            $this->message->addMessage(
                $this->language->get("message_delete_supplier_fail") . "<b class='bold-font'> " . $client->Name . "</b>",
            );
        }

        $this->redirect("/clients");
    }

}