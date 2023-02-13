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
    private  $isUserExist = [] ;
    private array $_rolesAddValid = [
        "UserName"          => ["req", "alphaNum",  "between(4,12)",],
        "Password"          => ["req", "between(7,60)", "alphaNum", "compare(confirm_password)"],
        "confirm_password"  => ["req", "between(7,60)", "alphaNum"],
        "Email"             => ["req", "between(10,30)", "email", "compare(confirm_email)"],
        "confirm_email"     => ["req", "between(10,30)", "email"],
        "GroupId"           => ["req", "int", "posInt"],
        "PhoneNumber"       => ["num"],
    ];
    private array $_rolesEditValid = [
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

    private function checkIfRepeat($columnName, $valueColumn)
    {
        if (UserModel::count($columnName, $valueColumn)) {
            $this->message->addMessage(
                $this->language->get("message_" . $columnName . "_exist"),
                Messenger::MESSAGE_DANGER
            );
            $this->redirect("/users/add");
        }
    }

    private function saveUser($user, $messageSuccess, $messageFail)
    {
        if ($user->save()) {
            $this->message->addMessage(
                $this->language->get($messageSuccess),
            );
        } else {
            $this->message->addMessage(
                $this->language->get($messageFail),
                Messenger::MESSAGE_DANGER
            );
        }

    }

    private function setAttributeUser($user)
    {
        $user->UserName = $this->filterStr($_POST["UserName"]);
        $user->encryptionPassword($_POST["Password"]);
        $user->Email                = $this->filterStr($_POST["Email"]);
        $user->SubscriptionDate     = date("Y-m-d H:i:s");
        $user->LastLogin            = date("Y-m-d H:i:s");
        $user->GroupId              = $this->filterInt($_POST["GroupId"]);
        $user->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);
        $user->Status               = 1;

    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("users.add");
        $this->language->load("messages.errors");
        $this->language->load("users.messages");

        $this->_info["groups"] = UserGroupModel::getAll();

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesAddValid, $_POST))  {

            $user = new UserModel();

            $this->setAttributeUser($user);

            $this->checkIfRepeat("UserName", $user->UserName);
            $this->checkIfRepeat("Email", $user->Email);

            $this->saveUser($user, "message_add_success", "message_add_fail");

            $this->redirect("/users");
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $idUser =  $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($idUser);

        if (! $user) { // User not exist
            $this->redirect("/users");
        }

        $this->_info["user"] = $user;

        $this->language->load("template.common");
        $this->language->load("users.edit");
        $this->language->load("users.messages");
        $this->language->load("messages.errors");

        $this->_info["groups"] = UserGroupModel::getAll();

        if (isset($_POST["edit"]) && $this->isAppropriate($this->_rolesEditValid, $_POST) )  {
            $user->GroupId              = $this->filterInt($_POST["GroupId"]);
            $user->PhoneNumber          = $this->filterStr($_POST["PhoneNumber"]);

            $this->saveUser($user, "message_edit_success", "message_edit_fail");

            $this->redirect("/users");
        }
        $this->_renderView();
    }
    public function deleteAction()
    {
        $idUser =  $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($idUser);

        if (! $user) { // User not exist
            $this->redirect("/users");
        }

        $this->language->load("users.messages");

        if ($user->delete()) {
            $this->message->addMessage(
                $this->language->get("message_delete_user_success"),
            );
        } else {
            $this->message->addMessage(
                $this->language->get("message_delete_user_fail"),
            );
        }

        $this->redirect("/users");
    }

    private function sendData($message, $to)
    {
        if (isset($_POST[$to]) && !empty($_POST[$to]))
            if (!UserModel::count($to, $_POST[$to])) {
                echo '{"result":"1", "message":"' . $message . '"}';
            } else {
                echo '{"result":"0", "message":"' . $message . '"}';
            }
    }
    public function isNameAlreadyUsedAction()
    {
        $this->language->load("users.messages");
        $message = $this->language->get("message_UserName_exist");
        $this->sendData($message, "UserName");
    }
    public function isEmailAlreadyUsedAction()
    {
        $this->language->load("users.messages");
        $message = $this->language->get("message_Email_exist");
        $this->sendData($message, "Email");

    }
}