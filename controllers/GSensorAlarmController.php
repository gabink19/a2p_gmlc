<?php
//gii_manual_update


namespace app\controllers;

use Yii;
use app\models\GSensorAlarm;
use yii\filters\AccessControl;

use app\models\GSensorAlarmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GSensorAlarmController implements the CRUD actions for GSensorAlarm model.
 */
class GSensorAlarmController extends XxGSensorAlarmController{
    
    
    public function actionShowAll()    {
        
        $searchModel = new GSensorAlarmSearch();
        $searchModel->gsa_alarm_mode_ref=0;
        $session = \Yii::$app->session;
        $temp_master_id = $session['g_customer_gc_id'];
        if ($temp_master_id != null) {
            $searchModel->g_customer_gc_id=$temp_master_id;
            
            
            
        }
        echo $temp_master_id."<br>";
        exit();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams

                    );

        return $this->render('_show_all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'remove_create2'=>1,
            
        ]);
    }

}