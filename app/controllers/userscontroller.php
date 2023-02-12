<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\Models\UserGroupModel;
use APP\Models\UserModel;
use function APP\pr;

class UsersController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
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
        // TODO: Check if user exist before insert in db ajax
        $this->language->load("template.common");
        $this->language->load("users.add");
        $this->language->load("messages.errors");
        $this->language->load("users.messages");

        $this->_info["groups"] = UserGroupModel::getAll();

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST) )  {
            $user = new UserModel();
            $user->UserName = $this->filterStr($_POST["UserName"]);
            $user->encryptionPassword($_POST["Password"]);
            $user->Email                = $this->filterStr($_POST["Email"]);
            $user->SubscriptionDate     = date("Y-m-d H:i:s");
            $user->LastLogin            = date("Y-m-d H:i:s");
            $user->GroupId              = $this->filterInt($_POST["GroupId"]);
            $user->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);
            $user->Status               = 1;

            if ($user->save()) {
                $this->message->addMessage(
                    $this->language->get("message_add_success"),
                );
            } else {
                $this->message->addMessage(
                    $this->language->get("message_add_fail"),
                    Messenger::MESSAGE_DANGER
                );
            }

            $this->redirect("/users");

        }
        $this->_renderView();
    }
}