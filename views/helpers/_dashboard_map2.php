<?php

use app\helpers\GoogleChart;
use yii\helpers\Url;
    
    


    echo GoogleChart::widget([
        //'visualization' => 'LineChart',
        //'packages' => 'corechart', //default is corechart
        'visualization' => $visualization,
        'packages' => $packages, //default is corechart
        'loadVersion' => 1, //default is 1.  As for Calendar, you need change to 1.1
        //'data' => $d1,
         //'url' => 'https://icloud.icode.id/index.php?r=g-sensor-db/get-data-map&master_id=1',
         'url' => $url,
        
        'timeout'=>$timeout,
        'options' => array('title' => 'My Daily Activity',
            'mapType' => 'normal',
            'showTooltip' => false,
            'showInfoWindow' => true,
            'icons' => Yii::$app->params['icons'],
    )]);

?>
        