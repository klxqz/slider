<?php

class shopSliderPluginBackendAddsliderAction extends waViewAction
{
    public function execute()
    {
        $id = waRequest::get('id');
        $slider_model = new shopSliderModel();
        $slider = $slider_model->getById($id);
        $this->view->assign('slider',$slider);
    }
}