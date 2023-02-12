<?php
namespace APP\LIB;

class Language
{
    private string $_path;
    private array $_dictionary = [];
    private string $_userLanguage;
    private function handlerPathLanguage($path): string
    {
        return str_replace('.', DS, $path) . ".lang.php";
    }

    private function ifFileLangExist(): bool
    {
        $this->_path = LANGUAGES_PATH . $this->_userLanguage . DS . $this->handlerPathLanguage($this->_path);
        return file_exists($this->_path);
    }

    private function setPath($path): void
    {
        $this->_path = $path;
    }

    private function setContent($content): void
    {
        foreach ($content as $key => $value) {
            $this->_dictionary[$key] = $value;
        }
    }

    private function setSessionLanguage(): void
    {
        if (isset($_SESSION["lang"])) {
            $this->_userLanguage = $_SESSION["lang"];
        }
    }
    public function load($dirAndAction): void
    {
        $this->setSessionLanguage();
        $this->setPath($dirAndAction);
        if ($this->ifFileLangExist()) {
            require $this->_path;
            // Set Content
            if(isset($content) && is_array($content))
                $this->setContent($content);
        } else {
            trigger_error("File Language Not Exist {$this->_path}",  E_USER_WARNING);
        }
    }
    public function getDictionary(): array
    {
        return $this->_dictionary;
    }

    public function get($key)
    {
        // TODO: remove method from validation trait
        if(array_key_exists($key, $this->_dictionary)) {
            return $this->_dictionary[$key];
        }
        return false;
    }

}