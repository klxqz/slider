<?php

class shopSliderModel extends waModel
{
    protected $table = 'shop_slider';
    
    public function getAll($key = null, $normalize = false)
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll($key, $normalize);
    }

}
