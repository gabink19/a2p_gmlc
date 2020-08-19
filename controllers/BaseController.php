<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;


class BaseController extends \yii\web\Controller
{
    function beforeAction($action){
        /*
        $data = Yii::$app->request->post();
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                
                foreach ($value as $key2 => $value2) {
                    if (is_array($value2)) {
                        foreach ($value2 as $key3 => $value3) {
                            echo "value:".$key.".".$key2.".".$key2.".".$value3."<br>";
                        }
                    } else {
                        echo "value:".$key.".".$key2.".".$value2."<br>";
                        
                    }
                    
                }
                
            } else {
                echo "value:".$key.".".$value."<br>";
            }
        }
        */
        return true;
    }

}
