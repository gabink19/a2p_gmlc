<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthAssignment_Config.php");
    $obj_name="AuthAssignment_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthAssignment_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$title=$AuthAssignment_config['name'];
if ($title==null or $title=="") $title='Auth Assignment';   

//$title=Yii::$app->params['bootstrap']['app\models\AuthAssignment']['name'];
//if ($title==null) $title='Auth Assignment';   

$this->title =  $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','master_id'=>$model->user_id]];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-assignment-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        
    ]) ?>

</div>
