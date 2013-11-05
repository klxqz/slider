<?php

class shopSliderSlideModel extends waModel
{
    protected $table = 'shop_slider_slide';
    
    public function getAll($key = null, $normalize = false)
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll($key, $normalize);
    }
    
    public function deleteList($ids = array())
    {
        foreach($ids as &$id) {
            $id = $this->escape($id);
        }
        
        $sql = "DELETE FROM {$this->table} WHERE slider_id IN(".implode(',',$ids).")";
        return $this->query($sql);
    }
}
