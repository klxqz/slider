<?php

/**
 * @author Коробонв Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPluginBackendAddslideAction extends waViewAction {

    public function execute() {
        $slider_id = waRequest::get('slider_id');
        $this->view->assign('slider_id', $slider_id);
    }

}
