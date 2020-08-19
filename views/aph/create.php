<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/Aph_Config.php");
    $obj_name="Aph_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/Aph_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\Aph */

//$title=Yii::$app->params['bootstrap']['app\models\Aph']['name'];
//if ($title==null) $title='Aph';   
 
$title=$Aph_config['name'];
if ($title==null or $title=="") $title='Aph';   


if ($remove_title==null) {
    $this->title =  $title ;
    $this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];
    //$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = $this->title;

}
?>
<div class="aph-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->ta_id]); 
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
        'app_mode'=>$app_mode
            ]) ?>
    
     <?  
    if ($pjax_enable) {
        Pjax::end();
    }?>

</div>
