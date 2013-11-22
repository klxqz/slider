<?php

/**
 * @author Коробонв Николай wa-plugins.ru <support@wa-plugins.ru>
 * @link http://wa-plugins.ru/
 */
class shopSliderPluginSlidesModel extends waModel {

    protected $table = 'shop_slider_slides';

    public function getAll($key = null, $normalize = false) {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll($key, $normalize);
    }

    public function getSlidersSlide($ids, $key = null, $normalize = false) {
        foreach ($ids as &$id) {
            $id = $this->escape($id);
        }
        $sql = "SELECT * FROM {$this->table} WHERE slider_id IN(" . implode(',', $ids) . ")";
        return $this->query($sql)->fetchAll($key, $normalize);
    }

    public function deleteList($ids = array()) {
        foreach ($ids as &$id) {
            $id = $this->escape($id);
        }
        $sql = "DELETE FROM {$this->table} WHERE slider_id IN(" . implode(',', $ids) . ")";
        return $this->query($sql);
    }

}
