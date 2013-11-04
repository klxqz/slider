<?php
class shopSliderPluginBackendLayout extends shopBackendLayout
{
    public function execute()
    {
        parent::execute();
        $this->assign('page', 'slider');
    }
}
