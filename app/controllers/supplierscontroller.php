<?php
namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\Models\EmployeeModel;
use APP\Models\SupplierModel;
use function APP\pr;

class SuppliersController extends AbstractController
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
        $this->language->load("suppliers.default");
        $this->_info["suppliers"] = SupplierModel::getAll();

        $this->_renderView();
    }
    private function setAttributeSuplpplier($supplier)
    {
        $supplier->Name = $this->filterStr($_POST["Name"]);
        $supplier->Email                = $this->filterStr($_POST["Email"]);
        $supplier->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);
        $supplier->Address              = $this->filterStr($_POST["Address"]);

    }
    private function saveSupplier($supplier, $messageSuccess, $messageFail)
    {
        if ($supplier->save()) {
            $this->message->addMessage(
                $this->language->get($messageSuccess) . " <b class='bold-font'>" . $supplier->Name . "</b>",
            );
        } else {
            $this->message->addMessage(
                $this->language->get($messageFail) . "<b class='bold-font'>" . $supplier->Name . "</b>",
                Messenger::MESSAGE_DANGER
            );
        }

    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("suppliers.add");
        $this->language->load("messages.errors");
        $this->language->load("suppliers.messages");

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST))  {

            $supplier = new SupplierModel();

            $this->setAttributeSuplpplier($supplier);

            $this->saveSupplier($supplier, "message_add_success", "message_add_field");

            $this->redirect("/suppliers");
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $idSupplier =  $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($idSupplier);

        if (! $supplier) { // Supplier not exist
            $this->redirect("/suppliers");
        }

        $this->_info["supplier"] = $supplier;

        $this->language->load("template.common");
        $this->language->load("suppliers.edit");
        $this->language->load("suppliers.messages");
        $this->language->load("messages.errors");

        if (isset($_POST["edit"]) && $this->isAppropriate($this->_rolesValid, $_POST) )  {
            $supplier->Name                 = $this->filterStr($_POST["Name"]);
            $supplier->Email                = $this->filterStr($_POST["Email"]);
            $supplier->Address              = $this->filterStr($_POST["Address"]);
            $supplier->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);

            $this->saveSupplier($supplier, "message_edit_success", "message_edit_fail");

            $this->redirect("/suppliers");
        }
        $this->_renderView();
    }
    public function deleteAction()
    {
        $this->language->load("suppliers.messages");
        $idSupplier =  $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($idSupplier);


        // If supplier not register in application
        if (! $supplier) {
            $this->redirect("/suppliers");
        }


        if ($supplier->delete()) {
            $this->message->addMessage(
                $this->language->get("message_delete_supplier_success") . "<b class='bold-font'> " . $supplier->Name . "</b>",
            );
        } else {
            $this->message->addMessage(
                $this->language->get("message_delete_supplier_fail") . "<b class='bold-font'> " . $supplier->Name . "</b>",
            );
        }

        $this->redirect("/suppliers");
    }

}