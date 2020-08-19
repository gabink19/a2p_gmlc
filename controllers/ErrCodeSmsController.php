<?php

namespace app\controllers;

use Yii;
use app\models\ErrCodeSms;
use yii\filters\AccessControl;

use app\models\ErrCodeSmsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ErrCodeSmsController implements the CRUD actions for ErrCodeSms model.
 */
class ErrCodeSmsController extends XxErrCodeSmsController{
    
    
    public function actionCreate3($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id)
    {
        $model = new ErrCodeSms();

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