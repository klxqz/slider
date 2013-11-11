<?php
return array(
    'shop_slider' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'name' => array('varchar', 255, 'null' => 0, 'default' => ''),
        'enabled' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'aligncenter' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'width' => array('int', 11, 'null' => 0, 'default' => '0'),
        'height' => array('int', 11, 'null' => 0, 'default' => '0'),
        'theme' => array('varchar', 50, 'null' => 0, 'default' => ''),
        'effect' => array('varchar', 50, 'null' => 0, 'default' => ''),
        'slices' => array('int', 11, 'null' => 0, 'default' => '0'),
        'boxCols' => array('int', 11, 'null' => 0, 'default' => '0'),
        'boxRows' => array('int', 11, 'null' => 0, 'default' => '0'),
        'animSpeed' => array('int', 11, 'null' => 0, 'default' => '0'),
        'pauseTime' => array('int', 11, 'null' => 0, 'default' => '0'),
        'startSlide' => array('int', 11, 'null' => 0, 'default' => '0'),
        'directionNav' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'controlNav' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'controlNavThumbs' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'pauseOnHover' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'manualAdvance' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        'prevText' => array('varchar', 50, 'null' => 0, 'default' => ''),
        'nextText' => array('varchar', 50, 'null' => 0, 'default' => ''),
        'randomStart' => array('tinyint', 1, 'null' => 0, 'default' => '0'),
        ':keys' => array(
            'PRIMARY' => array('id'),
        ),
    ),
    
    'shop_slider_slides' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'slider_id' => array('varchar', 255, 'null' => 0, 'default' => ''),
        'title' => array('varchar', 255, 'null' => 0, 'default' => ''),
        'link' => array('varchar', 255, 'null' => 0, 'default' => ''),
        'img' => array('varchar', 255, 'null' => 0, 'default' => ''),
        ':keys' => array(
            'PRIMARY' => array('id'),
            'slider_id' => 'slider_id',
        ),
    ),
);