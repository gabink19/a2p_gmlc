<?php

namespace app\controllers;

use Yii;
use app\models\GHistoryLog;
use yii\filters\AccessControl;

use app\models\GHistoryLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GHistoryLogController implements the CRUD actions for GHistoryLog model.
 */
class GHistoryLogController extends XxGHistoryLogController{
    
    
    public function actionCreate3($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id)
    {
        $model = new GHistoryLog();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->trms_id]);
            $model->save2($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}