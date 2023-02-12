<?php

namespace APP\Controllers;

use APP\LIB\FilterInput;
use APP\Models\UserGroupModel;
use APP\Models\UserModel;
use function APP\pr;

class UsersController extends AbstractController
{
    use FilterInput;
    private array $_rolesValid = [
        "UserName"          => ["req", "alphaNum",  "between(4,12)",],
        "Password"          => ["req", "between(7,60)", "alphaNum", "compare(confirm_password)"],
        "confirm_password"  => ["req", "between(7,60)", "alphaNum"],
        "Email"             => ["req", "between(10,30)", "email", "compare(confirm_email)"],
        "confirm_email"     => ["req", "between(10,30)", "email"],
        "GroupId"           => ["req", "int", "posInt"],
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

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST) )  {
            $user = new UserModel();
            $user->UserName = $this->filterStr($_POST["UserName"]);



        }
        $this->_renderView();
    }
}