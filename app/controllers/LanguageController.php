<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\Models\SettingsModel;
use JetBrains\PhpStorm\NoReturn;

class LanguageController extends AbstractController
{
    use PublicHelper;
    #[NoReturn] public function defaultAction(): void
    {

        $id = $this->session->user->UserId;
        if ($_SESSION["lang"] == "en") {
            $_SESSION["lang"] = "ar";
            SettingsModel::changeLanguage($id, 'ar');
            setcookie("lang", 'ar');
        } else {
            $_SESSION["lang"] = "en";
            SettingsModel::changeLanguage($id, 'en');
            setcookie("lang", 'en');

        }
        $this->redirect($_SERVER["HTTP_REFERER"]);
    }
}