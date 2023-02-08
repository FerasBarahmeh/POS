<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\Models\AbstractModel;
use APP\Models\UserGroupModel;
use APP\Models\UserGroupPrivilegeModel;
use APP\Models\UserPrivilegeModel;
use http\Params;
use function APP\pr;

class UsersGroupsController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    public function defaultAction()
    {
        $this->_language->load("template.common");
        $this->_language->load("usersgroups.default");
        $this->_info["groups"] = UserGroupModel::getAll();
        $this->_renderView();
    }
    public function addAction()
    {
        $this->_language->load("template.common");
        $this->_language->load("usersgroups.add");
        $this->_info["privileges"] = UserPrivilegeModel::getAll();

        if (isset($_POST["privileges"]) && isset($_POST["add"]) && is_array($_POST["privileges"])) {
            $group = new UserGroupModel();
            $group->GroupName = $this->filterStr($_POST["GroupName"]);

            if ($group->save()) {
                foreach ($_POST["privileges"] as  $privilege) {
                    $groupPrivilege = new UserGroupPrivilegeModel();

                    $groupPrivilege->GroupId        = $group->GroupId;
                    $groupPrivilege->PrivilegeId    = $privilege;
                    $groupPrivilege->save();
                }
            }

            $this->redirect("/usersgroups");
        }
        $this->_renderView();
    }

    private function extractPrivilegesIds($groupPrivileges): array
    {
        $ids = [];
        if ($groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $ids[] = $groupPrivilege->PrivilegeId;
            }
            return $ids;
        }
       return $ids;
    }

    private function getDeletePrivileges($oldPrivileges): array
    {
        return array_diff($oldPrivileges, $_POST["privileges"]);
    }

    private function getAddPrivileges($oldPrivileges): array
    {
        return array_diff($_POST["privileges"], $oldPrivileges);
    }
    private function removeDeletePrivilege($old, $group)
    {
        $oldPrivileges = $this->getDeletePrivileges($old);
        foreach ($oldPrivileges as $oldPrivilege) {
            $target = UserGroupPrivilegeModel::getBy(["PrivilegeId" => $oldPrivilege, "GroupId" => $group]);
            $target->current()->delete();
        }
    }

    private function addNewPrivileges($new, $group)
    {
        $newPrivileges = $this->getAddPrivileges($new);
        foreach ($newPrivileges as $newPrivilege) {
            $groupPrivilege = new UserGroupPrivilegeModel();

            $groupPrivilege->GroupId        = $group;
            $groupPrivilege->PrivilegeId    = $newPrivilege;
            $groupPrivilege->save();
        }

    }

    public function editAction()
    {
        $id = $this->_params[0];
        $group = UserGroupModel::getByPK($id);

        if (! $group) {
            $this->redirect("/usersgroups");
        }

        $this->_language->load("template.common");
        $this->_language->load("usersgroups.edit");

        $this->_info["group"]           = $group;
        $this->_info["privileges"]      = UserPrivilegeModel::getAll();
        $privileges                     =
            $this->extractPrivilegesIds(UserGroupPrivilegeModel::getBy(["GroupId" => $group->GroupId]));

        $this->_info["groupPrivilege"]  = $privileges;

        if (isset($_POST["privileges"]) && is_array($_POST["privileges"])) {

            // Delete Removed Privileges
            $this->removeDeletePrivilege($privileges, $group->GroupId);

            // Add new Privileges
            $this->addNewPrivileges($privileges, $group->GroupId);

            $this->redirect("/usersgroups");
        }

        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->_params[0];
        $group = UserGroupModel::getByPK($id);

        if (! $group) {
            $this->redirect("/usersgroups");
        }

        // Delete All Privileges Linked To This Group
        $privilegesThisGroup = UserGroupPrivilegeModel::getBy(["GroupId" => $group->GroupId]);
        if ($privilegesThisGroup) {
            foreach ($privilegesThisGroup as $privilegeThisGroup) {
                $privilegeThisGroup->delete();
            }
        }

        if($group->delete()) {
            $this->redirect("/usersgroups");
        }

    }
}