<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
try {
    
    include(dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php");
    $obj_name="GSensorAlarm_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GSensorAlarm_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\GSensorAlarm */

$title=$GSensorAlarm_config['name'];
if ($title==null or $title=="") $title='G Sensor Alarm';   

$this->title =  $title ;


?>

<? if ($remove_title==null) {
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index']];    $this->params['breadcrumbs'][] = ['label' => $model->gsa_id, 'url' => ['view', 'id' => $model->gsa_id]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="gsensor-alarm-view">
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->gsa_id]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($remove_update===null) {?>
        
        <?= Html::a('Update', ['g-sensor-alarm'."/".$update_action, 'id' => $model->gsa_id], ['class' => 'btn btn-primary']) ?>
    <?} else if ($remove_update===2) {?>
        <a class="btn btn-info modalButton" value="<?= Url::to([$update_action, 'id' => $model->gsa_id]) ?>">Update</a>
    <?    }?>
    <?if ($remove_delete===null) {?>
        <?= Html::a('Delete', ['g-sensor-alarm'."/".$delete_action, 'id' => $model->gsa_id], ['class' => 'btn btn-danger','data-method'=>'post']) ?>
    <?} else if ($remove_delete===2) {?>
        <a class="btn btn-info ajaxButton" value="<?= Url::to([$delete_action, 'id' => $model->gsa_id]) ?>">Delete</a>
    <?    }?>
    </p>
    
    
    <? 
       if ($view_form==null) $view_form='_form';
       echo $this->render($view_form, [
        'model' => $model,
        'mode'=>'view',
        'button1'=>'',
        'button2'=>'{reset} {view} {save}',
        'view_form'=>$view_form2,
        'modal_class'=>$modal_class,
    ]) ?>
    
    <?    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
   
    

</div>


    <?        if ($remove_detail!=1) {
            if (false) {
                $searchModel = new app\models\Search();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams
                    ,$model->gsa_id  );

                echo $this->render('///index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'modal_mode'=>1,
                    'pjax_enable' => 1,
                    'master_id'=>$model->gsa_id  ,   
                    'remove_title'=>1,
                    'remove_create2'=>1,

                ]);
            }
        }
        
    
    ?>