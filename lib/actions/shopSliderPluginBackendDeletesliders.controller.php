<?php

/**
 * @author Коробов Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPluginBackendDeleteslidersController extends waJsonController {

    public function execute() {
        $slider_ids = waRequest::post('slider_ids', array());
        $slider_model = new shopSliderPluginModel();
        $slide_model = new shopSliderPluginSlidesModel();

        if ($slider_ids) {
            $slides = $slide_model->getSlidersSlide($slider_ids);
            foreach ($slides as $slide) {
                if ($slide['img'] && file_exists(wa()->getDataPath('plugins/slider/images/' . $slide['img'], true, 'shop'))) {
                    @unlink(wa()->getDataPath('plugins/slider/images/' . $slide['img'], true, 'shop'));
                }
            }
            $slider_model->deleteList($slider_ids);
            $slide_model->deleteList($slider_ids);
        }

        $this->response['message'] = 'OK';
    }

}
