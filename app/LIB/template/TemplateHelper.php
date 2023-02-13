<?php

namespace APP\LIB\Template;

use function APP\pr;

trait TemplateHelper
{
    public function compareURL($url): bool
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) == $url;
    }
    public function getStorePost($nameAttribute, $object = null)
    {
        return $_POST[$nameAttribute] ?? (is_null($object) ? '' : $object->$nameAttribute);
    }

    public function isStored($nameAttribute, $value, $object): ?string
    {
        if (isset($_POST[$nameAttribute]) && $_POST[$nameAttribute] == $value) {
            return "selected";
        }
        if (! is_null($object) && $object->$nameAttribute == $value) {
            return "selected";
        }
        return null;
    }
}