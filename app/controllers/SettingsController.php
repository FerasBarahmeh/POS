<?php

namespace APP\Controllers;

class SettingsController extends AbstractController  {

    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("settings.default");
        
        $this->_info["user"] = $this->session->user;

        

        $this->_renderView();
    }
}