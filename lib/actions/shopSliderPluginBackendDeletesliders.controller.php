<?php

class shopSliderPluginBackendDeleteslidersController extends waJsonController {

    public function execute() {
        $slider_ids = waRequest::post('slider_ids',array());
        $slider_model = new shopSliderModel();
        $slide_model = new shopSliderSlideModel();

        if($slider_ids) {
            $slider_model->deleteList($slider_ids);
            $slide_model->deleteList($slider_ids);
        }
        
        $this->response['message'] = 'OK';
        //$this->setError('ошибка');
    }

}
