<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use JetBrains\PhpStorm\NoReturn;

class LanguageController extends AbstractController
{
    use PublicHelper;
    #[NoReturn] public function defaultAction(): void
    {

        if ($_SESSION["lang"] == "en") {
            $_SESSION["lang"] = "ar";
        } else {
            $_SESSION["lang"] = "en";
        }
        $this->redirect($_SERVER["HTTP_REFERER"]);
    }
}