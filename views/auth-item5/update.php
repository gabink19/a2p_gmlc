<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthItem5_Config.php");
    $obj_name="AuthItem5_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthItem5_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthItem5 */

$title=$AuthItem5_config['name'];
if ($title==null or $title=="") $title='Auth Item5';   

//$title=Yii::$app->params['bootstrap']['app\models\AuthItem5']['name'];
//if ($title==null) $title='Auth Item5';   

//$this->title =  $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index',]];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
//$this->params['breadcrumbs'][] = 'Update';

if ($remove_title==null) {
    $this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index',]];    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
    $this->params['breadcrumbs'][] = 'Update';

}?>
?>
<div class="auth-item5-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        
    ]) ?>

</div>
