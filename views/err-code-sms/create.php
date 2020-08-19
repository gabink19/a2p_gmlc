<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/ErrCodeSms_Config.php");
    $obj_name="ErrCodeSms_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/ErrCodeSms_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\ErrCodeSms */

//$title=Yii::$app->params['bootstrap']['app\models\ErrCodeSms']['name'];
//if ($title==null) $title='Err Code Sms';   
 
$title=$ErrCodeSms_config['name'];
if ($title==null or $title=="") $title='Err Code Sms';   


if ($remove_title==null) {
    $this->title =  $title ;
    $this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];
    //$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = $this->title;

}
?>
<div class="err-code-sms-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->tecs_id]); 
    }
    if ($view_form==null) $view_form='_form';
    ?>
    
    <?= $this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{delete}',
        'button2'=>'{save} {reset}',
        'view_form'=>$view_form2,
        'modal_class'=>$modal_class,
        'master_id'=>$master_id,
        'app_mode'=>$app_mode
            ]) ?>
    
     <?  
    if ($pjax_enable) {
        Pjax::end();
    }?>

</div>
