<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\models\Aph;

if ($mode==="view"){
    $displayOnlyFlag=true;
} else {
    $displayOnlyFlag=false;
}
$escape = new JsExpression("function(m) { return m; }");

// echo "<pre>"; print_r('this');echo "</pre>";
?>

<div class="mdn-whitelist-view">

    
    
<?$attributes=[];
// $attributes[]=['attribute' =>'tmw_aph_id','format' => 'raw','options' => []];
$attributes[] = ['attribute' => 'tmw_aph_id', 'format' => 'raw', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => [
    'data' => ArrayHelper::map(Aph::find()->orderBy('ta_name')->asArray()->all(), 'ta_id', 'ta_name'),
    'options' => ['placeholder' => 'Select .....','name'=>'MdnWhitelist[tmw_aph_id]' ],
    'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
], 'options' => []];
$attributes[]=['attribute' =>'tmw_name','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tmw_mdn','format' => 'raw','options' => []];
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
            'heading' => $this->title.' # ' . $model->tmw_id,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div id="footer_detail" class="text-center text-muted" style="display: none;"><small>create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                        $model->last_user."/".$model->last_ip."/".$model->last_update.'</small></div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->tmw_id],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
