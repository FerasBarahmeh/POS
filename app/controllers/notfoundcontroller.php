<?php

namespace APP\Controllers;

class NotFoundController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->_renderView();
    }
}