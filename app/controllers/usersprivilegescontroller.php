<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\Models\AbstractModel;
use APP\Models\UserGroupPrivilegeModel;
use APP\Models\UserPrivilegeModel;
use function APP\pr;

class UsersPrivilegesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("usersprivileges.default");
        $this->_info["privileges"] = UserPrivilegeModel::getAll();
        $this->_renderView();
    }

    private function savePrivilege($privilege, $successMess, $fieldMess)
    {
        if ($privilege->save()) {
            $this->message->addMessage(
                $this->language->get($successMess) . " <b class='bold-font'>" . $privilege->PrivilegeTitle . "</b>"
            );
        } else {
            $this->message->addMessage(
                $this->language->get($fieldMess) . " <b class='bold-font'>" . $privilege->PrivilegeTitle . "</b>",
                Messenger::MESSAGE_DANGER
            );
        }
    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("usersprivileges.add");
        if (isset($_POST['add'])) {
            $privilege = new UserPrivilegeModel();
            $privilege->PrivilegeTitle  = $this->filterStr($_POST["privilege_title"]);
            $privilege->Privilege       = $this->filterStr($_POST["privilege"]);

            $this->savePrivilege($privilege,
                "text_privilege_add_success", "text_privilege_add_field");

            $this->redirect("/usersprivileges");
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

        $this->language->load("template.common");
        $this->language->load("usersprivileges.edit");
        if (isset($_POST['save'])) {

            $privilege->PrivilegeTitle  = $this->filterStr($_POST["privilege_title"]);
            $privilege->Privilege       = $this->filterStr($_POST["privilege"]);
            $this->savePrivilege($privilege,
                "text_privilege_edit_success",
                "text_privilege_edit_field");

            $this->redirect("/usersprivileges");
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

        $groupsPrivileges = UserGroupPrivilegeModel::getBy(["PrivilegeId" => $privilege->PrivilegeId]);

        // Delete
        if ($groupsPrivileges) {
            foreach ($groupsPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }

        $this->language->load("usersprivileges.default");

        if ($privilege->delete()) {
            $this->message->addMessage(
                $this->language->get("text_privilege_delete_success")
            );
        } else {
            $this->message->addMessage(
                $this->language->get("text_privilege_delete_field")
            );
        }
        $this->redirect("/usersprivileges");
    }
}
