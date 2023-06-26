<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\Messenger;
use APP\Models\UserModel;
use UserStatus;


class AuthenticationController extends AbstractController
{
    use PublicHelper;
    use UserStatus;
    private function setMessageLogin($result)
    {
        if ($result == self::$UserNotRegistration) {
            $this->message->addMessage($this->language->get("message_user_not_registration"), Messenger::MESSAGE_DANGER);
        } elseif ($result == self::$UserDisable) {
            $this->message->addMessage($this->language->get("message_user_disabled"), Messenger::MESSAGE_DANGER);
        }
        if($result == self::$UserValid) {
            $this->message->addMessage(
                $this->language->get("welcome_message") ." " . $this->session->user->extraUserInfo->FirstName
                . " "  . $this->session->user->extraUserInfo->LastName
            );
            $this->redirect("/");
        }

    }
    public function loginAction()
    {
        $this->language->load("authentication.login");
        $this->_template->choosePartsUI([
            NAME_VIEW_TEMPLATE_KEY                  => ":action_view",
        ]);

        if (isset($_POST["login"])) {
            $result = UserModel::authentication($_POST["UserName"], $_POST["Password"], $this->session);
            $this->setMessageLogin($result);
        }

        $this->_renderView();
    }

    public function logoutAction()
    {
        setcookie("lang", $_SESSION["lang"]);
        $this->session->kill();
        $this->redirect("/authentication/login");
    }
}