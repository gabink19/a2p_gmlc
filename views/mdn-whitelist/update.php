<?php

use yii\helpers\Html;
try {
    
    include(dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php");
    $obj_name="MdnWhitelist_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\MdnWhitelist */

$title=$MdnWhitelist_config['name'];
if ($title==null or $title=="") $title='Mdn Whitelist';   

//$title=Yii::$app->params['bootstrap']['app\models\MdnWhitelist']['name'];
//if ($title==null) $title='Mdn Whitelist';   

//$this->title =  $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = ['label' => $model->tmw_id, 'url' => ['view', 'id' => $model->tmw_id,'app_mode'=>$app_mode]];
//$this->params['breadcrumbs'][] = 'Update';

if ($remove_title==null) {
    $this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];    $this->params['breadcrumbs'][] = ['label' => $model->tmw_id, 'url' => ['view', 'id' => $model->tmw_id,'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = 'Update';

}
if ($view_form==null) $view_form='_form'; 
?>
<div class="mdn-whitelist-update">

    
    <?= $this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'view_form'=>$view_form2, 
        'button1'=>'{update} {delete}',
        'button2'=>'{reset} {view} {save}',
        'app_mode'=>$app_mode,
                
    ]) ?>

</div>
