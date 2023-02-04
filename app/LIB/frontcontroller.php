<?php

namespace APP\Lib;

use APP\LIP\languages;

class FrontController {

    const NOT_FOUND_ACTION = "notFoundAction";
    const NOT_FOUND_CONTROLLER = "APP\Controllers\NotFoundController";
    private $_controller = "index";
    private $_action = "default";
    private $_params = [];
    private $_template;
    private $_language;
    public function __construct(Template $tem, Language $lang)
    {
        $this->_template = $tem;
        $this->_language = $lang;
        $this->_parseURL();
    }

    private function _parseURL(): void
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $url = explode('/', trim($url, '/'), 3);

        // Split Values
        $this->setController($url[0]);
        $this->setAction(@$url[1]);
        $this->setParams(@$url[2]);
    }

    public function dispatch(): void
    {
        $controllerClassName = "APP\Controllers\\" . ucfirst($this->_controller) . "Controller";
        $actionName          = $this->_action . "Action";

        if (! class_exists($controllerClassName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER;
        }

        $controller = new $controllerClassName();

        if (! method_exists($controller, $actionName)) {
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }

        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setLanguage($this->_language);
        $controller->$actionName();
    }
    public function setController(mixed $controller): void
    {
        if (isset($controller) && $controller) {
            $this->_controller = $controller;
        }
    }
    public function setAction(mixed $action): void
    {
        if (isset($action) && $action) {
            $this->_action = $action;
        }
    }
    public function setParams(mixed $params): void
    {
        if (isset($params) && $params) {
            $this->_params = explode('/', trim($params, '/'));
        }
    }
}