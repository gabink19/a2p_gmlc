<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
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



?>

<? if ($remove_title==null) {
$this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index']];    $this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="auth-login-view">
    
        
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->user_id]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($update_flag and $remove_update===null) {?>
        
        <?= Html::a('Update', ['auth-login'."/".$update_action,'app_mode'=>$app_mode, 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
    <?} else if ($update_flag and $remove_update===2) {?>
        <a class="btn btn-info AuthLoginmodalButton" value="<?= Url::to([$update_action,'app_mode'=>$app_mode, 'id' => $model->user_id]) ?>">Update</a>
    <?    }?>
    <?if ($delete_flag and $remove_delete===null) {?>
        <?= Html::a('Delete', ['auth-login'."/".$delete_action,'app_mode'=>$app_mode, 'id' => $model->user_id], ['class' => 'btn btn-danger']) ?>
    <?} else if ($delete_flag and $remove_delete===2) {?>
        <a class="btn btn-info AuthLoginajaxButton" value="<?= Url::to([$delete_action,'app_mode'=>$app_mode, 'id' => $model->user_id]) ?>">Delete</a>
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
        'modal_class'=>$modal_class
                
    ]) ?>
    
    <?    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
        
   
    

</div>

<?$js=<<<js
    $('.panel-footer').on('click', function () {
        console.log( 'footer_detail.click' );
        $('#footer_detail').toggle();
        
        return false;
        
        
    }); 
   
 
js;
$this->registerJs($js);
?>  
    
    <?        if ($remove_detail!=1) {
                $create_flag=false;$update_flag=false;$delete_flag=false;$view_flag=false;
if (Yii::$app->user->can('app\\controllers\\'.'AuthAssignment'.'Controller'.'.create')) {$create_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'AuthAssignment'.'Controller'.'.update')) {$update_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'AuthAssignment'.'Controller'.'.delete')) {$delete_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'AuthAssignment'.'Controller'.'.view')) {$view_flag=true;}
$searchModel = new app\models\AuthAssignmentSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams
                            ,$model->user_id);
echo $this->render('//auth-assignment/index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                'modal_mode'=>1,
                                'pjax_enable' => 1,
                                'master_id'=>$model->user_id,   
                                'create_flag'=>$create_flag,
                                'update_flag'=>$update_flag,
                                'delete_flag'=>$delete_flag,
                                'view_flag'=>$view_flag,

                                'remove_title'=>1,
                                'remove_create2'=>1,]);
            
            
        }
        
    
    ?>