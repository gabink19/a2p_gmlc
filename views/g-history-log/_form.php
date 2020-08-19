<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

if ($mode==="view"){
    $displayOnlyFlag=true;
} else {
    $displayOnlyFlag=false;
}
$escape = new JsExpression("function(m) { return m; }");


?>

<div class="ghistory-log-view">

    
    
<?$attributes=[];
$attributes[]=['attribute' =>'ghl_userid','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_username','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_log','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_ip','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_date','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_id_model','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'ghl_model','format' => 'raw','options' => []];
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
            'heading' => $this->title.' # ' . $model->ghl_id,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div id="footer_detail" class="text-center text-muted" style="display: none;"><small>create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                        $model->last_user."/".$model->last_ip."/".$model->last_update.'</small></div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->ghl_id],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
