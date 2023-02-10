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

    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("usersprivileges.add");
        if (isset($_POST['add'])) {
            $privilege = new UserPrivilegeModel();
            $privilege->PrivilegeTitle  = $this->filterStr($_POST["privilege_title"]);
            $privilege->Privilege       = $this->filterStr($_POST["privilege"]);

            if ($privilege->save()) {
                $this->message->addMessage($this->setMassLang("Add Privilege Success", "تم اضافة الصلاحية بنجاح"));
            } else {
                $this->message->addMessage($this->setMassLang("Add Privilege Filed", "عذرا, فشل اضافة الصلاحية بنجاح"));
            }
            $this->redirect("/usersprivileges");
        }
        $this->_renderView();
    }

    private function setMassLang($enMass, $arMass)
    {
        // TODO: Update Set Message Way
        if ($this->session->getLang() == APP_DEFAULT_LANGUAGE)
            $mass = $enMass;
        else
            $mass = $arMass;
        return $mass;
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

            if ($privilege->save()) {

                $this->message->addMessage(
                    $this->setMassLang("Edit Privilege Success", "تم تعديل الصلاحية بنجاح"));
            } else {
                $this->message->addMessage($this->setMassLang("Edit Privilege field", "لم تم تعديل الصلاحية بنجاح"),
                    Messenger::MESSAGE_DANGER);
            }
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

        if ($privilege->delete()) {
            $this->message->addMessage($this->setMassLang("Delete Privilege Success", "تم حذف الصلاحية بنجاح"));
        } else {
            $this->message->addMessage($this->setMassLang("Delete Privilege Filed", "عذرا فشل حذف الصلاحية حاول لاحقا"), Messenger::MESSAGE_DANGER);
        }
        $this->redirect("/usersprivileges");
    }
}
