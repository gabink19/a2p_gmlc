<?php

namespace app\controllers;

use Yii;
use app\models\MdnWhitelist;
use yii\filters\AccessControl;

use app\models\MdnWhitelistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * MdnWhitelistController implements the CRUD actions for MdnWhitelist model.
 */
class MdnWhitelistController extends XxMdnWhitelistController{
    
    
    public function actionCreate3($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id)
    {
        $model = new MdnWhitelist();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->trms_id]);
            $model->save2($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $pathF  = $_FILES['MdnWhitelistSearch']['tmp_name']['file'];
            $filename = $_FILES['MdnWhitelistSearch']['name']['file'];
            if(!empty($pathF)){
                $rows = explode("\n", file_get_contents($pathF));
                foreach($rows as $k=>$v){
                    if(trim($v)!=''){
                    $data[] = $v;
                    }
                } 
                $uploaded = [];
                $no = 1;
                foreach ($data as $key => $value) {
                  if(strpos($value, '|')){
                      $model = new MdnWhitelist();
                      $data = explode('|', $value); 
                      $q = 'SELECT ta_id from tbl_aph where ta_name="'.$data[0].'"';
                      $ta_id = Yii::$app->db->createCommand($q)->queryScalar();
                      $model->tmw_aph_id = $ta_id;  
                      $model->tmw_name = $data[1];  
                      $model->tmw_mdn = $data[2];  
                      $a = 'SELECT count(*) as tot from tbl_mdn_whitelist where tmw_mdn="'.$data[2].'"';
                      $mdn = Yii::$app->db->createCommand($a)->queryScalar();
                      if ($ta_id!='' && $mdn==0 && $model->save()) {
                            $uploaded[]=$model->tmw_id;
                            Yii::$app->session->setFlash('success', 'Success Upload All Data.');
                      }else{
                            if (!empty($uploaded)) {
                                $quer = "DELETE FROM tbl_mdn_whitelist WHERE tmw_id IN ('".implode(',', $uploaded)."')";
                                Yii::$app->db->createCommand($quer)->execute();
                            }
                            Yii::$app->session->setFlash('success', null);
                            Yii::$app->session->setFlash('error', 'Fail Upload Line : '.$no. ' . All data on this file will be rollback.');
                            return $this->redirect(['index']);
                      }
                      $no++;              
                  }else{
                    if (!empty($uploaded)) {
                        $quer = "DELETE FROM tbl_mdn_whitelist WHERE tmw_id IN ('".implode(',', $uploaded)."')";
                        Yii::$app->db->createCommand($quer)->execute();
                    }
                    Yii::$app->session->setFlash('success', null);
                    Yii::$app->session->setFlash('error', 'Fail Upload Line : '.$no. ' . All data on this file will be rollback.');
                    return $this->redirect(['index']);
                  }
                }
            }
        }
        return $this->redirect(['index']);
    }

    public function actionRemove()
    {
        if (Yii::$app->request->isPost) {
            $pathF  = $_FILES['MdnWhitelistSearch']['tmp_name']['remove_file'];
            $filename = $_FILES['MdnWhitelistSearch']['name']['remove_file'];
            if(!empty($pathF)){
                $rows = explode("\n", file_get_contents($pathF));
                foreach($rows as $k=>$v){
                    if(trim($v)!=''){
                    $data[] = $v;
                    }
                } 
                $remove = [];
                $no = 1;
                foreach ($data as $key => $value) {
                  if(strpos($value, '|')){
                      $model = new MdnWhitelist();
                      try {
                        $data = explode('|', $value); 
                        $q = 'SELECT tmw_id from tbl_mdn_whitelist where tmw_aph_id=(SELECT ta_id from tbl_aph where ta_name="'.$data[0].'") AND tmw_name="'.$data[1].'" AND tmw_mdn="'.$data[2].'"';
                        $tmw_id = Yii::$app->db->createCommand($q)->queryScalar();
                      } catch (\Exception $e) {
                        Yii::$app->session->setFlash('error', 'Fail Upload Line : '.$no. ' . All data on this file will be rollback.');
                        return $this->redirect(['index']);
                      }
                      if ($tmw_id!='') {
                          $remove[]=$tmw_id;
                      }
                      $no++;              
                  }else{
                    Yii::$app->session->setFlash('success', null);
                    Yii::$app->session->setFlash('error', 'Fail Upload Line : '.$no. ' . All data on this file will be rollback.');
                    return $this->redirect(['index']);
                  }
                }

                Yii::$app->session->setFlash('success', 'No Match Data to Remove.');

                if (!empty($remove)) {
                    $quer = "DELETE FROM tbl_mdn_whitelist WHERE tmw_id IN (".implode(',', $remove).")";
                    Yii::$app->db->createCommand($quer)->execute();
                    Yii::$app->session->setFlash('success', 'Success Remove All Data.');
                }
            }
        }
        return $this->redirect(['index']);
    }
}