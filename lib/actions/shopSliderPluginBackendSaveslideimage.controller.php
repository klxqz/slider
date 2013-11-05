<?php

class shopSliderPluginBackendSaveslideimageController extends waJsonController {

    public function execute() {
        
        $slide_post = waRequest::post('slide');
        $file = waRequest::file('slide_img');
        if($file->uploaded()) {
            $image_path = wa()->getDataPath('plugins/slider/images/',  'shop');
            $name = $this->uniqueName($image_path);
            //$app_settings_model = new waAppSettingsModel();
            //$size = $app_settings_model->get(array('shop', 'logocategory'),'size');
            //$resize = $app_settings_model->get(array('shop', 'logocategory'),'resize');
            try {
                $file->waImage()->save($image_path.$name);
                
                
                $this->response['preview'] = wa()->getDataUrl('plugins/slider/images/'.$name, true, 'shop');
                
                $slide_model = new shopSliderSlideModel(); 
                $slide = $slide_model->getById($slide_post['id']);
                if($slide) {
                    
                } else {
                    $slide_post['img'] = $name;
           
                    $lastInsertId = $slide_model->insert($slide_post);
                    $this->response['id'] = $lastInsertId;
                }
                
                //$category_model = new shopCategoryModel();
                //$category = $category_model->getById($category_id);
                //if($category['image']) {
                //    @unlink($image_path.$category['image']);
                //}
                //$category_model->updateById($category_id,array('image'=>$name));
              
              
              
            } catch (Exception $e) {
                
                $this->setError($e->getMessage());
            }
        }
        //$this->response['message'] = 'OK';
        //$this->setError('ошибка');
    }
    
    protected function uniqueName($path) 
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        do {
            $name = '';
            for ($i = 0; $i < 10; $i++) {
                $n = rand(0, strlen($alphabet)-1);
                $name .= $alphabet{$n};
            }
            $name .= '.jpg';
        } while(file_exists($path.$name));
        
        return $name;
    }

}
