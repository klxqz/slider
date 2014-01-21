<?php

/**
 * @author Коробов Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPluginBackendSaveslideController extends waJsonController {

    public function execute() {

        $slide_post = waRequest::post('slide');
        $slide_model = new shopSliderPluginSlidesModel();

        $slide = $slide_model->getById($slide_post['id']);

        $file = waRequest::file('slide_img');
        if ($file->uploaded()) {
            $image_path = wa()->getDataPath('plugins/slider/images/', 'shop');
            $name = $this->uniqueName($image_path, $file->extension);
            try {
                $file->waImage()->save($image_path . $name);
                $this->response['preview'] = wa()->getDataUrl('plugins/slider/images/' . $name, true, 'shop');

                if ($slide && $slide['img'] && file_exists(wa()->getDataPath('plugins/slider/images/' . $slide['img'], true, 'shop'))) {
                    @unlink(wa()->getDataPath('plugins/slider/images/' . $slide['img'], true, 'shop'));
                }

                $slide_post['img'] = $name;
            } catch (Exception $e) {

                $this->setError($e->getMessage());
            }
        }

        if ($slide) {
            $slide_model->updateById($slide_post['id'], $slide_post);
        } else {
            $lastInsertId = $slide_model->insert($slide_post);
            $this->response['id'] = $lastInsertId;
        }

        $this->response['message'] = 'OK';
    }

    protected function uniqueName($path, $file_extension) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        do {
            $name = '';
            for ($i = 0; $i < 10; $i++) {
                $n = rand(0, strlen($alphabet) - 1);
                $name .= $alphabet{$n};
            }
            $name .= '.' . $file_extension;
        } while (file_exists($path . $name));

        return $name;
    }

}
