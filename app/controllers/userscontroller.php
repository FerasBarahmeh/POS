<?php

namespace APP\Controllers;

use APP\Models\UserModel;

class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("users.default");
        $this->_info["users"] = UserModel::getAll();
        $this->_renderView();
    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("users.add");

        $this->_renderView();
    }
}