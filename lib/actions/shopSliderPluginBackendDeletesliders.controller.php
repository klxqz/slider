<?php

class shopSliderPluginBackendDeleteslidersController extends waJsonController {

    public function execute() {
        $slider_ids = waRequest::post('slider_ids',array());
        $slider_model = new shopSliderModel();
        $slide_model = new shopSliderSlideModel();

        if($slider_ids) {
            $slides = $slide_model->getSlidersSlide($slider_ids);
            foreach($slides as $slide) {
                if($slide['img'] && file_exists(wa()->getDataPath('plugins/slider/images/'.$slide['img'], true, 'shop'))) {
                    @unlink(wa()->getDataPath('plugins/slider/images/'.$slide['img'], true, 'shop'));  
                }
            }
            $slider_model->deleteList($slider_ids);
            $slide_model->deleteList($slider_ids);
        }
        
        $this->response['message'] = 'OK';
    }

}
