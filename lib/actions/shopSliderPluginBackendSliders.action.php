<?php

class shopSliderPluginBackendSlidersAction extends waViewAction
{
    public function execute()
    {
        $slider_model = new shopSliderModel();
        $sliders = $slider_model->getAll();
        $this->view->assign('sliders',$sliders);
    }
}