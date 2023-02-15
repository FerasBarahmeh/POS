<?php

namespace APP\Lib;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\Template\Template;
use APP\LIB\Authentication;
use APP\LIB\languages;
use APP\LIB\Registration;
use function APP\pr;


class FrontController
{
    use PublicHelper;

    const NOT_FOUND_ACTION = "notFoundAction";
    const NOT_FOUND_CONTROLLER = "APP\Controllers\NotFoundController";
    private $_controller = "index";
    private $_action = "default";
    private $_params = [];
    private $_template;
    private Registration $_registry;
    private Authentication $_authenticated;
    public function __construct(Template $tem, Registration $registry, Authentication $authenticated)
    {
        $this->_template = $tem;
        $this->_registry = $registry;
        $this->_authenticated = $authenticated;
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

        if (! $this->_authenticated->isAuthenticated()) {
            $controllerClassName    = "APP\Controllers\\" . "Authentication" . "Controller";
            $actionName             = "login". "Action";
            $this->_controller      = "authentication";
            $this->_action          = "login";
        } else  {
            if ($this->_controller == "authentication" && $this->_action == "login") {
                if (isset($_SERVER["HTTP_REFERER"])) {
                    $this->redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->redirect("/");
                }
            }
        }

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
        $controller->setRegistry($this->_registry);
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