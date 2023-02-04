<?php

namespace APP\Controllers;

class IndexController extends AbstractController  {

    public function defaultAction()
    {
        $this->_language->load("index.default");
         $this->_renderView();
    }

    public function addAction()
    {
        $this->_renderView();
    }
}