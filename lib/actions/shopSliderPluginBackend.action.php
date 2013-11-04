<?php

class shopSliderPluginBackendAction extends waViewAction
{
    public function execute()
    {
        $this->setLayout(new shopSliderPluginBackendLayout());       
    }
}