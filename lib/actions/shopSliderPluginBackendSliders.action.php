<?php

/**
 * @author Коробонв Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPluginBackendSlidersAction extends waViewAction {

    public function execute() {
        $slider_model = new shopSliderPluginModel();
        $sliders = $slider_model->getAll();
        $this->view->assign('sliders', $sliders);
    }

}
