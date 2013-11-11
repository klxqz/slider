<?php

class shopSliderPluginBackendSavesliderController extends waJsonController {

    public function execute() {
        $slider_post = waRequest::post('slider');
        $slider_model = new shopSliderPluginModel();

        if (isset($slider_post['id']) && $slider_post['id']) {
            $slider_model->updateById($slider_post['id'], $slider_post);
        } else {
            $id = $slider_model->insert($slider_post);
            $this->response['id'] = $id;
        }

        $this->response['message'] = 'OK';
    }

}
