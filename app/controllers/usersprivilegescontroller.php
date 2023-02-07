<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\Models\AbstractModel;
use APP\Models\UserPrivilegeModel;

class UsersPrivilegesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    public function defaultAction()
    {
        $this->_language->load("template.common");
        $this->_language->load("usersprivileges.default");
        $this->_info["privileges"] = UserPrivilegeModel::getAll();
        $this->_renderView();
    }

    public function addAction()
    {
        $this->_language->load("template.common");
        $this->_language->load("usersprivileges.add");
        if (isset($_POST['add'])) {
            $privilege = new UserPrivilegeModel();
            $privilege->PrivilegeTitle  = $this->filterStr($_POST["privilege_title"]);
            $privilege->Privilege       = $this->filterStr($_POST["privilege"]);

            if ($privilege->save()) {
                $this->redirect("/usersprivileges");
            } else {
                echo "Catch Some Error";
            }
        }
        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $privilege = UserPrivilegeModel::getByPK($id);
        $this->_info['privilege'] = $privilege;

        if ($privilege == null) {
            $this->redirect("usersprivileges");
        }

        $this->_language->load("template.common");
        $this->_language->load("usersprivileges.edit");
        if (isset($_POST['save'])) {

            $privilege->PrivilegeTitle  = $this->filterStr($_POST["privilege_title"]);
            $privilege->Privilege       = $this->filterStr($_POST["privilege"]);

            if ($privilege->save()) {
                $this->redirect("/usersprivileges");
            } else {
                echo "Catch Some Error";
            }
        }
        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $privilege = UserPrivilegeModel::getByPK($id);

        if ($privilege == null) {
            $this->redirect("usersprivileges");
        }

        if ($privilege->delete()) {
            $this->redirect("/usersprivileges");
        }
    }
}
