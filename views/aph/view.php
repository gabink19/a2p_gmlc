<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
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



?>

<? if ($remove_title==null) {
$this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index', 'app_mode'=>$app_mode]];    $this->params['breadcrumbs'][] = ['label' => $model->ta_id, 'url' => ['view', 'id' => $model->ta_id, 'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="aph-view">
    
        
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->ta_id]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($update_flag and $remove_update===null) {?>
        
        <?= Html::a('Update', ['aph'."/".$update_action,'app_mode'=>$app_mode, 'id' => $model->ta_id], ['class' => 'btn btn-primary']) ?>
    <?} else if ($update_flag and $remove_update===2) {?>
        <a class="btn btn-info AphmodalButton" value="<?= Url::to([$update_action,'app_mode'=>$app_mode, 'id' => $model->ta_id]) ?>">Update</a>
    <?    }?>
    <?if ($delete_flag and $remove_delete===null) {?>
        <?= Html::a('Delete', ['aph'."/".$delete_action,'app_mode'=>$app_mode, 'id' => $model->ta_id], ['class' => 'btn btn-danger']) ?>
    <?} else if ($delete_flag and $remove_delete===2) {?>
        <a class="btn btn-info AphajaxButton" value="<?= Url::to([$delete_action,'app_mode'=>$app_mode, 'id' => $model->ta_id]) ?>">Delete</a>
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
        'app_mode'=>$app_mode
                
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
if (Yii::$app->user->can('app\\controllers\\'.'MdnWhitelist'.'Controller'.'.create')) {$create_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'MdnWhitelist'.'Controller'.'.update')) {$update_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'MdnWhitelist'.'Controller'.'.delete')) {$delete_flag=true;}
if (Yii::$app->user->can('app\\controllers\\'.'MdnWhitelist'.'Controller'.'.view')) {$view_flag=true;}
$searchModel = new app\models\MdnWhitelistSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams
                            ,$model->ta_id);
echo $this->render('//mdn-whitelist/index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                'modal_mode'=>2,
                                'pjax_enable' => 1,
                                'master_id'=>$model->ta_id,   
                                'create_flag'=>$create_flag,
                                'update_flag'=>$update_flag,
                                'delete_flag'=>$delete_flag,
                                'view_flag'=>$view_flag,
                                'app_mode'=>$app_mode,
                                'remove_title'=>1,
                                'remove_create2'=>1,]);
            
            
        }
        
    
    ?>