<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php");
    $obj_name="MdnWhitelist_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\MdnWhitelist */

//$title=Yii::$app->params['bootstrap']['app\models\MdnWhitelist']['name'];
//if ($title==null) $title='Mdn Whitelist';   
 
$title=$MdnWhitelist_config['name'];
if ($title==null or $title=="") $title='Mdn Whitelist';   


if ($remove_title==null) {
    $this->title =  $title ;
    $this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index','app_mode'=>$app_mode]];
    //$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = $this->title;

}
?>
<div class="mdn-whitelist-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->tmw_id]); 
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
