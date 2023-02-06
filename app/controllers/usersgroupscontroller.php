<?php

namespace APP\Controllers;

use APP\Models\UserGroupModel;

class UsersGroupsController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load("template.common");
        $this->_language->load("usersgroups.default");
        $this->_info["groups"] = UserGroupModel::getAll();
        $this->_renderView();
    }
}