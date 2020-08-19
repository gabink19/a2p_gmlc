<?php

namespace app\controllers;
//gii_manual_update
use Yii;
use app\models\AuthItem5;
use app\models\AuthItemChild;
use yii\filters\AccessControl;

use app\models\AuthItem5Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItem5Controller implements the CRUD actions for AuthItem5 model.
 */
class AuthItem5Controller extends XxAuthItem5Controller{
    
    
    
    
    public function actionRefresh($id,$profile_id){
        $model=$this->findModel($id);
        $res=$model->getAuthItemChildren0()->where(['parent' =>$profile_id])->all();
        $message="?";
        if (count($res)>0) {
            //delete
            if (($model = AuthItemChild::findOne(['parent' => $profile_id, 'child' => $id])) !== null) {
                $model->delete();
                $message="delete";
            }
        } else {
            //add
            
            $model = new AuthItemChild();
            $model->parent=$profile_id;
            $model->child=$id;
            $model->save();
            $message="add";
            
        }
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'message' => $message,
                    ],
                    'code' => 0,
                ];

    }    
    
    public function actionIndexEx($profile_id)    
    {
        /*
        $session = Yii::$app->session;
        if ($session->isActive){
            
            echo "session active".$session['a'];
            $session['a']=$session['a']+1;
            $session->close();
            $session->destroy();

        } else {
            echo "session non active";
            $session->open();
            //$session['a']=0;
            
        }
        exit();*/
        
        
        
        $params = Yii::$app->request->queryParams;
        
        
        if (count($params) >0) {
            $Search_params = $params['AuthItem5Search'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['AuthItem5Search'];
                if ($Search_params!=null){        
                    $params['AuthItem5Search']=$Search_params;
                }
            } else {
               Yii::$app->session['AuthItem5Search']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['AuthItem5Search_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['AuthItem5Search_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['AuthItem5Search_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['AuthItem5Search_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['AuthItem5Search'];
            if ($Search_params!=null){        
               $params['AuthItem5Search']=$Search_params;
            }
            $page_params=Yii::$app->session['AuthItem5Search_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['AuthItem5Search_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
        $searchModel = new AuthItem5Search();
          
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams
        //    ,$master_id);
        $dataProvider = $searchModel->search($params);
        foreach($dataProvider->getModels() as $record) {
            $record->profile_id=$profile_id;    
          }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modal_mode'=>1,
            'pjax_enable' => 1,
            'remove_title'=>0,
            'remove_create2'=>0,
            'master_id'=>$master_id, 
            'profile_id'=>$profile_id,
            
            
        ]);
    }
}