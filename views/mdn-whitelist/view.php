<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
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



?>

<? if ($remove_title==null) {
$this->title =  $title ;
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index', 'app_mode'=>$app_mode]];    $this->params['breadcrumbs'][] = ['label' => $model->tmw_id, 'url' => ['view', 'id' => $model->tmw_id, 'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="mdn-whitelist-view">
    
        
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->tmw_id]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($update_flag and $remove_update===null) {?>
        
        <?= Html::a('Update', ['mdn-whitelist'."/".$update_action,'app_mode'=>$app_mode, 'id' => $model->tmw_id], ['class' => 'btn btn-primary']) ?>
    <?} else if ($update_flag and $remove_update===2) {?>
        <a class="btn btn-info MdnWhitelistmodalButton" value="<?= Url::to([$update_action,'app_mode'=>$app_mode, 'id' => $model->tmw_id]) ?>">Update</a>
    <?    }?>
    <?if ($delete_flag and $remove_delete===null) {?>
        <?= Html::a('Delete', ['mdn-whitelist'."/".$delete_action,'app_mode'=>$app_mode, 'id' => $model->tmw_id], ['class' => 'btn btn-danger']) ?>
    <?} else if ($delete_flag and $remove_delete===2) {?>
        <a class="btn btn-info MdnWhitelistajaxButton" value="<?= Url::to([$delete_action,'app_mode'=>$app_mode, 'id' => $model->tmw_id]) ?>">Delete</a>
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
                            
            
        }
        
    
    ?>