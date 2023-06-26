<?php

namespace APP\Controllers;

use APP\Enums\MessageErrorLocation;
use APP\LIB\Validation;
use APP\Models\AbstractModel;
use APP\Models\SettingsModel;

class SettingsController extends AbstractController  {

    use Validation;
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("users.edit");
        $this->language->load("settings.default");

        $user       = (array) $this->session->user;
        $settings   = (array) (new SettingsModel)->getSettings( $this->session->user->UserId);
        $marge      = array_merge($user, $settings);
        $marge      = (object) $marge;
        $this->_info["user"] = $marge;

        $this->_renderView();
    }

    public function updateFieldValueAjaxAction()
    {
        $this->language->load("messages.errors");
        $this->language->load("users.add");

        $query = "UPDATE " . $_POST["table"] . " SET " . $_POST["column"] . " = '" .  $_POST["newValue"] .
            "' WHERE  UserId  = " . $this->session->user->UserId  ;

        $rolesAddValid = [
            "FirstName"         => ["alpha",  "between(2,10)",],
            "LastName"          => ["alpha",  "between(2,10)",],
            "PhoneNumber"       => ["num"],
            "Address"           => ["alphaNum"],
            "BOD"               => ["vDate"],
            "Currency"          => ["between(1,5)"],
        ];

        $checked = [$_POST["column"] => $_POST["newValue"]];

        if (isset($rolesAddValid[$_POST["column"]])) {
            $rolesAddValid = [
                $_POST["column"] => $rolesAddValid[$_POST["column"]]
            ];
        }


        $valid = $this->isAppropriate($rolesAddValid, $checked,  MessageErrorLocation::$stack);

        if (! is_array($valid)) {
            echo json_encode([
               "result" => AbstractModel::executeQuery($query),
            ]);
        } else {
            echo json_encode([
                "errors"    => $valid,
                "result"    => false
            ]);
        }

        
    }
}