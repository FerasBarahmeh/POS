<?php

namespace APP\Controllers;

use APP\Models\UserPrivilegeModel;

class UsersPrivilegesController extends AbstractController
{
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
        $this->_info["privileges"] = UserPrivilegeModel::getAll();
        $this->_renderView();
    }
}