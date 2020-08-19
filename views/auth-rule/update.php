<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthRule_Config.php");
    $obj_name="AuthRule_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthRule_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthRule */

$title=$AuthRule_config['name'];
if ($title==null or $title=="") $title='Auth Rule';   

//$title=Yii::$app->params['bootstrap']['app\models\AuthRule']['name'];
//if ($title==null) $title='Auth Rule';   

$this->title =  $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index',]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-rule-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        
    ]) ?>

</div>
