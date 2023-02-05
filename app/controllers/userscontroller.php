<?php

namespace APP\Controllers;

use APP\Models\UserModel;

class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load("users.default");
        $this->_info["users"] = UserModel::getAll();
        $this->_renderView();
    }
}