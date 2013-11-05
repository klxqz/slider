<?php

class shopSliderPluginBackendAddsliderAction extends waViewAction {

    protected $effect_params = array(
        'sliceDown',
        'sliceDownLeft',
        'sliceUp',
        'sliceUpLeft',
        'sliceUpDown',
        'sliceUpDownLeft',
        'fold',
        'fade',
        'random',
        'slideInRight',
        'slideInLeft',
        'boxRandom',
        'boxRain',
        'boxRainReverse',
        'boxRainGrow',
        'boxRainGrowReverse',
    );
    
    protected $default = array(
        'enabled' => '1',
        'name' => 'Новый слайдер',
        'theme' => 'default',
        'effect' => 'random',
        'slices' => '15',
        'boxCols' => '8',
        'boxRows' => '4',
        'animSpeed' => '500',
        'pauseTime' => '3000',
        'startSlide' => '0',
        'directionNav' => 'true',
        'controlNav' => 'true',
        'controlNavThumbs' => 'false',
        'pauseOnHover' => 'true',
        'manualAdvance' => 'false',
        'prevText' => 'Вперед',
        'nextText' => 'Назад',
        'randomStart' => 'false',
    );

    public function execute() {
        $id = waRequest::get('id');
        $slider_model = new shopSliderModel();
        $slider = $slider_model->getById($id);
        $slides = array();
        if ($slider) {
            $slide_model = new shopSliderSlideModel();
            $slides = $slide_model->getByField('slider_id', $slider['id'], true);
        } else {
            $slider = $this->default;
        }


        $this->view->assign('slider', $slider);
        $this->view->assign('slides', $slides);
        
        $this->view->assign('effect_params', $this->effect_params);
    }

}
