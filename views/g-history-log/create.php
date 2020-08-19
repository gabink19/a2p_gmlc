<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php");
    $obj_name="GHistoryLog_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\GHistoryLog */

//$title=Yii::$app->params['bootstrap']['app\models\GHistoryLog']['name'];
//if ($title==null) $title='G History Log';   
 
$title=$GHistoryLog_config['name'];
if ($title==null or $title=="") $title='G History Log';   


if ($remove_title==null) {
    $this->title =  $title ;
    $this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];
    //$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = $this->title;

}
?>
<div class="ghistory-log-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->ghl_id]); 
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
