<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php");
    $obj_name="GSensorAlarm_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\GSensorAlarm */

$title=$GSensorAlarm_config['name'];
if ($title==null or $title=="") $title='G Sensor Alarm';   

//$title=Yii::$app->params['bootstrap']['app\models\GSensorAlarm']['name'];
//if ($title==null) $title='G Sensor Alarm';   

$this->title =  $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index',]];
$this->params['breadcrumbs'][] = ['label' => $model->gsa_id, 'url' => ['view', 'id' => $model->gsa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gsensor-alarm-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        
    ]) ?>

</div>
