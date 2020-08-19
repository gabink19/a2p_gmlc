<?php

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthItemChild_Config.php");
    $obj_name="AuthItemChild_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthItemChild_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */

//$title=Yii::$app->params['bootstrap']['app\models\AuthItemChild']['name'];
//if ($title==null) $title='Auth Item Child';   
 
$title=$AuthItemChild_config['name'];
if ($title==null or $title=="") $title='Auth Item Child';   

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index','master_id'=>$master_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">

    <?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->parent]); 
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
