<?php

/**
 * @author Коробонв Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPlugin extends shopPlugin {

    public function backendMenu() {
        if ($this->getSettings('status')) {
            $html = '<li ' . (waRequest::get('plugin') == $this->id ? 'class="selected"' : 'class="no-tab"') . '>
                        <a href="?plugin=slider">Слайдер</a>
                    </li>';
            return array('core_li' => $html);
        }
    }

    public static function display($slider_id) {
        $plugin = wa()->getPlugin('slider');
        if ($plugin->getSettings('status')) {
            $view = wa()->getView();

            $slider_model = new shopSliderPluginModel();
            $slider = $slider_model->getById($slider_id);
            if ($slider['enabled']) {
                $slide_model = new shopSliderPluginSlidesModel();
                $slides = $slide_model->getByField('slider_id', $slider_id, true);

                $view->assign('slider', $slider);
                $view->assign('slides', $slides);
                $template_path = wa()->getAppPath('plugins/slider/templates/Slider.html', 'shop');
                $html = $view->fetch($template_path);
                return $html;
            }
        }
    }

}
