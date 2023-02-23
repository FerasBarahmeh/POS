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
    /**
     * function to get variable name sorted in files language
     * for example: If you want return name unit product in multiple language the unit sorted as a number in db
     * of course can't display it as a number this function solve this problem
     *
     * units = ["Piece" => 1]
     *
     *
     * @param string    $key key mean the common string in units variable unit_Piece, unit_Box the key unit in this case
     * @param int       $number the value sorted in db
     * @param array     $iter array contain all elements and values
     *
     * @return string name variable by the number unit_Piece this variable contain name different language
     */
    public function getNameByNumber(string $key, int $number, array $iter): string
    {
        return rtrim($key, '_') . '_' . ucfirst(array_search($number, $iter));
    }
}