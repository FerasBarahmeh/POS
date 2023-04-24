<?php

namespace APP\LIB\Template;


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

    /**
     * function to set image if image not valid or not exist set alter image
     *
     * @param string        $path direction root folder image
     * @param string|null   $nameImage name image will set
     * @param string    $alterImagePath the path the alter image if the main image not found or name id null
     * @param array|null|string $imageClass all class is css
     * @param string|null   $altContentImage Alter text if no image
     *
     * @return void set image in page
     */
    public function setImageIfExist(string $path,
                                    string|null $nameImage,
                                    string $alterImagePath,
                                    array|null|string $imageClass=null,
                                    string|null $altContentImage=null): void
    {
        
        
        if ($nameImage != null || $nameImage >= 3) {
            if (is_array($imageClass)) {
                ?>
                    <img  src= "<?= $path . $nameImage ?>"
                        class="<?= implode(' ', $imageClass) ?>"
                        alt="<?= $altContentImage ?>">
                <?php
            } elseif (is_string($imageClass) || $imageClass == null) {
                ?>
                    <img
                        src= "<?= $path ?><?= $nameImage ?>"
                        class="<?= $imageClass ?>"
                        alt="<?= $altContentImage ?>">
                <?php
            }
        } else {
            ?>
                <img
                    src= "<?= $alterImagePath ?>"
                    class="<?= $imageClass ?>"
                    alt="<?= $altContentImage ?>">
            <?php
        }
    }
    public function encryption($pass): string
    {
        return crypt($pass, MAIN_SALT);
    }
    /**
     * Usually use this method if you want to add attribute HTML in element if value equal another value
     *
     * @param mixed $value fist value
     * @param mixed $comp second value
     * @param mixed $attributeName name attribute will be returned
     *
     * @return ?string return selected if you find value in array
     */
    public function setSpecificAttribute(mixed $value, mixed $comp, mixed $attributeName): ?string
    {
        return $value == $comp ? $attributeName : '';
    }
}