<?php
namespace app\controllers;
//gii_manual_update

error_reporting(0);
use Yii;
use app\models\AuthLogin;
use yii\filters\AccessControl;

use app\models\AuthLoginSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AuthLoginController implements the CRUD actions for AuthLogin model.
 */
class AuthLoginController extends XxAuthLoginController{
    
    public function actionBikinPass()
    {
        echo phpinfo();
        $comp_password="iCloudId.gibran.sealover";
        //echo $comp_password;
        //exit();
        $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);
        echo "<pre>"; print_r($comp_password);echo "</pre>";
        echo "<pre>"; print_r($hash_password);echo "</pre>";
        echo "<pre>"; print_r(Yii::$app->getSecurity()->generateRandomString());echo "</pre>";
    }
    
    public function actionSignup($app_mode=null)     
    {
        // $session = Yii::$app->session;
        // // $session['attributes'] = $attributes;
        // var_dump($session['attributes']);
        // exit;
        $model = new AuthLogin();
        $model->scenario="signup";
        

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->user_id]);
            ;
            //$model2=AuthLogin::find()->orderBy("user_id DESC")->one();
            //echo $model2->user_id;
            $role = Yii::$app->request->post()['AuthLogin']['role'];
            $model->tl_user_status_ref=0;
            $comp_password=Yii::$app->id.$model->tl_username.$model->tl_password_new;
            //echo $comp_password;
            //exit();
            $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);
        
            $model->tl_password=$hash_password;
            $model->user_id=Yii::$app->getSecurity()->generateRandomString();
            if ($model->save()) {
                $q1 = "INSERT INTO `auth_assignment` (`item_name`, `user_id`) VALUES ('".$role."', '".$model->user_id."')";
                $insert = Yii::$app->db->createCommand($q1)->execute();
                // Yii::$app->mailer->compose()
                //     ->setFrom('admin@icloud.co.id')
                //     ->setTo($model->tl_email)
                //     ->setSubject('user confirmation')
                //     ->setTextBody('please click for confirm')
                //     ->setHtmlBody('<b>click:</b><a href=\'https://icloud.icode.id/'.Url::to(['//auth-login/confirm','app_mode'=>$app_mode,'id'=>$model->user_id]).'\'>Confirmation Link</a><br>')
                //     ->send();
                
                Yii::$app->session->setFlash('success', "User created successfully."); 
                return $this->redirect(['auth-login/index',
                    'app_mode'=>$app_mode,
                                        ]);
            }
        }
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('create', [
            'model' => $model,
            'app_mode'=>$app_mode,
            'view_form'=>"_active_form_2",
            'view_form2'=>'signup',

                        
                            
        ]);
    }
    public function actionSignupGoogle($app_mode = null)
    {
        $session = Yii::$app->session;
        // var_dump($session['attributes']);
        // exit;
        $model = new AuthLogin();
        $attr= $session['attributes'];

        if (!empty($attr)) {
            $username=explode('@', $attr['email']);
            $model->tl_username= $attr['email'];
            $model->tl_password=$username[0];
            $model->tl_user_status_ref = 1;
            $comp_password = Yii::$app->id . $model->tl_username . $model->tl_password;
            $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);
            $model->tl_password = $hash_password;
            $model->user_id = Yii::$app->getSecurity()->generateRandomString();
            $session['username']= $attr['email'];
            $model->tl_email = $attr['email'];
            // var_dump($attr['email']);
            // exit;
            if ($model->save()) {
                // Yii::$app->mailer->compose()
                //     ->setFrom('admin@icloud.co.id')
                //     ->setTo($model->tl_email)
                //     ->setSubject('user confirmation')
                //     ->setTextBody('please click for confirm')
                //     ->setHtmlBody('<b>click:</b><a href=\'https://icloud.icode.id/'.Url::to(['//auth-login/confirm','app_mode'=>$app_mode,'id'=>$model->user_id]).'\'>Confirmation Link</a><br>')
                //     ->send();

                Yii::$app->session->setFlash('success', "User created successfully.<br> Email Sent<br>Please confirm");
                return $this->redirect([
                    'index',
                    'app_mode' => $app_mode,
                ]);
            }
        }
        return $this->redirect([
            '//site/login',
            'app_mode' => $app_mode,
            // 'attr_google'=> $attributes
        ]);
    }
    
    public function actionChangePassword($app_mode=null)     
    {
        $model = new AuthLogin();
        $model->scenario="change_password";

        
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->user_id]);
            ;
            //$model2=AuthLogin::find()->orderBy("user_id DESC")->one();
            //echo $model2->user_id;
            $model2 =AuthLogin::find()->where("tl_username='".$model->tl_username."'")->one();
            if ($model2!=null) {
                $comp_password=Yii::$app->id.$model->tl_username.$model->tl_password_old;
                if (Yii::$app->getSecurity()->validatePassword($comp_password, $model2->tl_password)) {
        
                
                    $comp_password=Yii::$app->id.$model->tl_username.$model->tl_password_new;
                    //echo $comp_password;
                    //exit();
                    $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);

                    $model2->tl_password=$hash_password;
                    $change_pasword_duration=$model2->tl_change_password_duration;
                    if ($change_pasword_duration===null){
                        $change_pasword_duration=30;
                    }
                    $new_time=strtotime('+'.$change_pasword_duration.' day',time());
                    $model2->tl_password_expire=date('Y-m-d H:i:s',$new_time);
                    if ($model2->tl_user_status_ref=4){
                        $model2->tl_user_status_ref=0;
                    }
                    
                    if ($model2->save()) {
                        Yii::$app->session->setFlash('success', "password change successfully"); 
                        return $this->redirect(['index',
                            'app_mode'=>$app_mode,
                                                ]);
                    } else {
                        echo $model2->user_id."<br>";
                        echo $model2->tl_username."<br>";
                        echo $model2->tl_password."<br>";
                        echo $model2->tl_password_new."<br>";
                        echo $model2->tl_password_new2."<br>";
                        echo $model2->tl_password_old."<br>";
                        echo $model2->tl_password_expire."<br>";
                        
                        exit();
                        Yii::$app->session->setFlash('error', "save problem"); 
                    }
                } else {
                    Yii::$app->session->setFlash('error', "wrong old password"); 
                }
            } else {
               Yii::$app->session->setFlash('error', "User not found"); 
                
            }
        }
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('create', [
            'model' => $model,
            'app_mode'=>$app_mode,
            'view_form'=>"_active_form_3",
            'view_form2'=>'change-password',

                        
                            
        ]);
    }
    
    public function actionConfirm($app_mode=null,$id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $model->tl_user_status_ref=2;
            if ($model->save()){
                Yii::$app->session->setFlash('success', "account confirm, waiting aproval from admin"); 
                        
            };
        };
        return $this->redirect(['index',
                    'app_mode'=>$app_mode,
                                                    ]);
        
    }
}