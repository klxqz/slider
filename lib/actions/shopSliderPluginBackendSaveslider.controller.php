<?php

class shopSliderPluginBackendSavesliderController extends waJsonController {

    public function execute() {
        $slider_post = waRequest::post('slider');
        $slider_model = new shopSliderModel();

        if (isset($slider_post['id'])) {
            $slider_model->updateById($slider_post['id'], $slider_post);
        } else {
            $slider_model->insert($slider_post);
        }


        $this->response['message'] = 'OK';
        //$this->setError('ошибка');
    }

}
