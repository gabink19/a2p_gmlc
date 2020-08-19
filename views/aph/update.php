<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/Aph_Config.php");
    $obj_name="Aph_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/Aph_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\Aph */

$title=$Aph_config['name'];
if ($title==null or $title=="") $title='Aph';   

//$title=Yii::$app->params['bootstrap']['app\models\Aph']['name'];
//if ($title==null) $title='Aph';   

//$this->title =  $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = ['label' => $model->ta_id, 'url' => ['view', 'id' => $model->ta_id,'app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = 'Update';

if ($remove_title==null) {
    $this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];    $this->params['breadcrumbs'][] = ['label' => $model->ta_id, 'url' => ['view', 'id' => $model->ta_id,'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = 'Update';

}
if ($view_form==null) $view_form='_form'; 
?>
<div class="aph-update">

    
    <?= $this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'view_form'=>$view_form2, 
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        'app_mode'=>$app_mode,
                
    ]) ?>

</div>
