<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php");
    $obj_name="GHistoryLog_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\GHistoryLog */

$title=$GHistoryLog_config['name'];
if ($title==null or $title=="") $title='G History Log';   

//$title=Yii::$app->params['bootstrap']['app\models\GHistoryLog']['name'];
//if ($title==null) $title='G History Log';   

//$this->title =  $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = ['label' => $model->ghl_id, 'url' => ['view', 'id' => $model->ghl_id,'app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = 'Update';

if ($remove_title==null) {
    $this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];    $this->params['breadcrumbs'][] = ['label' => $model->ghl_id, 'url' => ['view', 'id' => $model->ghl_id,'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = 'Update';

}
if ($view_form==null) $view_form='_form'; 
?>
<div class="ghistory-log-update">

    
    <?= $this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'view_form'=>$view_form2, 
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        'app_mode'=>$app_mode,
                
    ]) ?>

</div>
