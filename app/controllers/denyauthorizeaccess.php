<?php

namespace APP\Controllers;

class DenyAuthorizeAccess extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->_renderView();
    }
}