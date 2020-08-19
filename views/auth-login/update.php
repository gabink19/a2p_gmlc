<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthLogin_Config.php");
    $obj_name="AuthLogin_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthLogin_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthLogin */

$title=$AuthLogin_config['name'];
if ($title==null or $title=="") $title='Auth Login';   

//$title=Yii::$app->params['bootstrap']['app\models\AuthLogin']['name'];
//if ($title==null) $title='Auth Login';   

//$this->title =  $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index',]];
//$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
//$this->params['breadcrumbs'][] = 'Update';

if ($remove_title==null) {
    $this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index']];    $this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
    $this->params['breadcrumbs'][] = 'Update';

}
if ($view_form==null) $view_form='_form'; 
?>
<div class="auth-login-update">

    
    <?= $this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'view_form'=>$view_form2, 
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
                
    ]) ?>

</div>
