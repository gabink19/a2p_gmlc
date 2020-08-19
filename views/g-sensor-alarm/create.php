<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php");
    $obj_name="GSensorAlarm_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\GSensorAlarm */

//$title=Yii::$app->params['bootstrap']['app\models\GSensorAlarm']['name'];
//if ($title==null) $title='G Sensor Alarm';   
 
$title=$GSensorAlarm_config['name'];
if ($title==null or $title=="") $title='G Sensor Alarm';   

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index',]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsensor-alarm-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->gsa_id]); 
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
    ]) ?>
    
     <?  
    if ($pjax_enable) {
        Pjax::end();
    }?>

</div>
