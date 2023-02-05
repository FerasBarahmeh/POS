<?php

namespace APP\Controllers;

class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load("users.default");
        $this->_renderView();
    }
}