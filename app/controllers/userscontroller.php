<?php

namespace APP\Controllers;

use APP\Models\UserGroupModel;
use APP\Models\UserModel;

class UsersController extends AbstractController
{
    private array $_rolesValid = [
        "UserName"          => ["req", "alphaNum",  "between(4,12)",],
        "Password"          => ["req", "min(7)", "max(60)", "alphaNum"],
        "confirm-password"  => ["req", "min(7)", "max(60)", "alphaNum"],
        "Email"             => ["req", "min(10)", "max(30)", "email"],
        "confirm-email"     => ["req", "min(10)", "max(30)", "email"],
        "GroupId"           => ["req", "min(1)", "max(1)", "int"],
        "PhoneNumber"       => ["num"],
    ];
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
        $this->language->load("messages.errors");

        $this->_info["groups"] = UserGroupModel::getAll();

        if (isset($_POST["add"])) {
            $this->isAppropriate($this->_rolesValid, $_POST);

        }
        $this->_renderView();
    }
}