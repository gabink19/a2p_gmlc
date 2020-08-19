<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
if ($mode==="view"){
    $displayOnlyFlag=true;
} else {
    $displayOnlyFlag=false;
}


?>

<div class="auth-rule-view">

        
<?$attributes=[];
$attributes[]=['attribute' =>'name','options' => []];
$attributes[]=['attribute' =>'data','options' => []];
?>
    
    
<?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'bordered'=>false,
        'hover' => true,
        'mode' => $mode,
        'buttons1' => $button1,
        'buttons2' => $button2,
        'container' => ['id'=>'kv-demo'],
                'panel' => [
            'heading' => $this->title.' # ' . $model->name,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div class="text-center text-muted">create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                $model->last_user."/".$model->last_ip."/".$model->last_update.'</div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->name],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
