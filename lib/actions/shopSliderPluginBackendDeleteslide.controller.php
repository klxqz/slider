<?php

class shopSliderPluginBackendDeleteslideController extends waJsonController {

    public function execute() {
        $slider_id = waRequest::post('slider_id');
        $id = waRequest::post('slide_id');
        
        $slide_model = new shopSliderSlideModel();
        $slide_model->deleteByField(array('slider_id'=>$slider_id,'id'=>$id));

        //$this->response['message'] = 'OK';
        //$this->setError('ошибка');
    }

}
