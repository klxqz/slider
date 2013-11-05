<?php

class shopSliderPluginBackendAddsliderAction extends waViewAction
{
    public function execute()
    {
        $id = waRequest::get('id');
        $slider_model = new shopSliderModel();
        $slider = $slider_model->getById($id);
        $slides = array();
        if($slider) {
            $slide_model = new shopSliderSlideModel();
            $slides = $slide_model->getByField('slider_id',$slider['id'],true);

        }
        
        
        $this->view->assign('slider',$slider);
        $this->view->assign('slides',$slides);
        
    }
}