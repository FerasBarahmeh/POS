<?php

namespace APP\Controllers;

use APP\Lib\FrontController;
use APP\LIB\Template\Template;
use APP\LIB\Registration;
use APP\LIB\Validation;
use function APP\pr;


abstract class AbstractController
{
    use Validation;
    protected $_controller;
    protected $_action;
    protected $_params;
    public $_info = [];
    protected Template $_template;
    protected Registration $_registry;

    public function __get(string $name)
    {
        return $this->_registry->$name;
    }

    public function notFoundAction(): void
    {
        $this->language->load("template.common");
        $this->_renderView();
    }
    private function mergeInfo(): void
    {
        $dictionaryLanguage = $this->language->getDictionary();
        if (isset($dictionaryLanguage) && !empty($dictionaryLanguage))
            $this->_info = array_merge($this->_info, $dictionaryLanguage);
    }
    protected function _renderView(): void
    {
        $view = VIEWS_PATH .$this->_controller . DS . $this->_action . ".view.php";
        if ($this->_action == FrontController::NOT_FOUND_ACTION || ! file_exists($view)  ) {
            $view =  VIEWS_PATH ."notfound" . DS . "notfound.view.php";
        }

        $this->mergeInfo();
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setData($this->_info);
        $this->_template->renderFiles();

    }
    public function setTemplate($tem): void
    {
        $this->_template = $tem;
    }
    public function setRegistry($registry): void
    {
        $this->_registry = $registry;
    }
    public function setController(mixed $controller): void
    {
        $this->_controller = $controller;
    }
    public function setAction(mixed $action): void
    {
        $this->_action = $action;
    }
    public function setParams(mixed $params): void
    {
        $this->_params = $params;
    }
    /**
     * Fill object or array (any iterator) in lazy way
     *
     * @param mixed $containerValues the element you want fill
     * @param \Generator $records generator contains all data you want translate in $containerValues
     *
     * @return void
     */
    public function putLazy(mixed &$containerValues, \Generator $records): void
    {
        while ($records->valid()) {
            $containerValues[] = $records->current();
            $records->next();
        }
    }
    /**
     *
     * Get Word Language by get specific name file
     *
     * http://estore.local/getMessagesAjax/{Name File}
     * @return void
     */
    public function getMessagesAjaxAction(): void
    {
        $this->language->load($_POST["nameFile"]);
        $messages = $this->language->getDictionary();
        echo json_encode($messages);
    }
}