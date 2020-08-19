<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Response;
use app\models\LoginForm;


class ApiController extends \yii\web\Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
        
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','view','detail'],
                'rules' => [
                [
                'allow' => true,
                'actions' => ['index'],
                'roles' => [static::class.'.index'],
                ],
                [
                'allow' => true,
                'actions' => ['create'],
                'roles' => [static::class.'.create'],
                ],
                [
                'allow' => true,
                'actions' => ['update'],
                'roles' => [static::class.'.update'],
                ],
                [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => [static::class.'.delete'],
                ],
                [
                'allow' => true,
                'actions' => ['view'],
                'roles' => [static::class.'.view'],
                ],
        
        
        
                ],
            ],
        
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login2' => ['POST'],
                ],
            ],
        ];
    }
    public function actionLogin(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return [
                'result'=>true,
           
           ];
        }
        
        return [
           'result'=>false,
           
           ];
        
    }
    public function actionLogout(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        Yii::$app->user->logout();
        return [
                'result'=>true,
           
           ];
    }
    
    
    
    public function actionRequestMenu()
    {
       $items=[]; 
            
           $result = Yii::$app->db->createCommand("select name,menu1,menu2,menu_label,menu_url from auth_item where type=3 order by menu1,menu2,menu_label;") 
               ->queryAll(); 
           $last_menu=""; 
           $last_id=-1; 
           $last_menu2=""; 
           $last_id2=-1; 
           function deleteFirstWord($menu) { 
               $res=strstr($menu,'.'); 
               if ($res==""){ 
                   return $menu; 
                 } else {  
                     return substr($res,1); 
                 } 
           } 
           foreach($result as $item){ 
               /* 
               print_r($item); 
               echo "<br>"; 
               echo $item["menu1"].'<br>';*/ 
               $menu1=$item["menu1"]; 
               if ($menu1!="hidden" ) { 
                   if ($last_menu!=$menu1) { 
                       $items[]=['label' => deleteFirstWord($menu1) , 'items'=>[]]; 
                       $last_id++; 
                       $last_id2=-1; 
                       $last_menu=$menu1; 
                       $last_menu2=""; 
                   }; 
                   $menu2=$item["menu2"]; 
                   if ($last_menu2!=$menu2) { 
                       $items[$last_id]["items"][]=['label' =>deleteFirstWord($menu2), 'items'=>[]]; 
                       $last_id2++; 
                       $last_menu2=$menu2; 
                   }; 
                   if (Yii::$app->user->can($item['name'])) { 
                       $items[$last_id]["items"][$last_id2]["items"][]=['label' => deleteFirstWord($item["menu_label"]), 'url' => [$item["menu_url"]]]; 
                   } 
               } 
           }; 
       Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
                        
       return [
           'result'=>true,
           'data'=>$items,
           
           ];
    }

}
