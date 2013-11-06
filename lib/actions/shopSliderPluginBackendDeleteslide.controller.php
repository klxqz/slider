<?php

class shopSliderPluginBackendDeleteslideController extends waJsonController {

    public function execute() {
        $id = waRequest::post('slide_id');
        
        $slide_model = new shopSliderSlideModel();
        $slide = $slide_model->getById($id);
        if($slide) {
            if($slide['img'] && file_exists(wa()->getDataPath('plugins/slider/images/'.$slide['img'], true, 'shop'))) {
                @unlink(wa()->getDataPath('plugins/slider/images/'.$slide['img'], true, 'shop'));  
            }
            $slide_model->deleteById($id);
        }
        
        $this->response['message'] = 'OK';
    }

}
