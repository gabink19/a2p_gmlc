<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthItemChild_Config.php");
    $obj_name="AuthItemChild_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthItemChild_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */

$title=$AuthItemChild_config['name'];
if ($title==null or $title=="") $title='Auth Item Child';   

//$title=Yii::$app->params['bootstrap']['app\models\AuthItemChild']['name'];
//if ($title==null) $title='Auth Item Child';   

$this->title =  $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','master_id'=>$model->parent]];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-child-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        
    ]) ?>

</div>
