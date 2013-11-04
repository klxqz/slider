<?php

class shopSliderPlugin extends shopPlugin
{
    
    public function backendMenu()
    {
        $html = '<li '.(waRequest::get('plugin') == $this->id ? 'class="selected"' : 'class="no-tab"').'>
                        <a href="?plugin=slider">Сладер</a>
                    </li>';           
        return array('core_li' => $html);
    }
}