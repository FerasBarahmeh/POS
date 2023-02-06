<?php

namespace APP\LIB\Template;

trait TemplateHelper
{
    public function compareURL($url): bool
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) == $url;
    }
}