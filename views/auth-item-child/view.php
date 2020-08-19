<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
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

$this->title =  $title ;


?>

<? if ($remove_title==null) {
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['//parent/view','id'=>$model->parent]];    $this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="auth-item-child-view">
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->parent]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($remove_update===null) {?>
        
        <?= Html::a('Update', ['auth-item-child'."/".$update_action, 'parent' => $model->parent, 'child' => $model->child], ['class' => 'btn btn-primary']) ?>
    <?} else if ($remove_update===2) {?>
        <a class="btn btn-info modalButton" value="<?= Url::to([$update_action, 'parent' => $model->parent, 'child' => $model->child]) ?>">Update</a>
    <?    }?>
    <?if ($remove_delete===null) {?>
        <?= Html::a('Delete', ['auth-item-child'."/".$delete_action, 'parent' => $model->parent, 'child' => $model->child], ['class' => 'btn btn-danger','data-method'=>'post']) ?>
    <?} else if ($remove_delete===2) {?>
        <a class="btn btn-info ajaxButton" value="<?= Url::to([$delete_action, 'parent' => $model->parent, 'child' => $model->child]) ?>">Delete</a>
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
                    ,$model->parent  );

                echo $this->render('///index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'modal_mode'=>1,
                    'pjax_enable' => 1,
                    'master_id'=>$model->parent  ,   
                    'remove_title'=>1,
                    'remove_create2'=>1,

                ]);
            }
        }
        
    
    ?>