<?php

class shopSliderSlideModel extends waModel
{
    protected $table = 'shop_slider_slide';
    
    public function getAll($key = null, $normalize = false)
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll($key, $normalize);
    }

}
