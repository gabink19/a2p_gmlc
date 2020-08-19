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

$model->constanta = '
msisdn yang di track       =   {{mdn_tracking}}
imsi yang di track            =   {{imsi_tracking}}
imei yang di track            =   {{imei_tracking}}
device info                       =   {{device}}
status                              =   {{status}}
network                            =   {{network}}
cell info                            =   {{cell}}
latitude                             =   {{lat}}
longitude                          =   {{long}}
azimuth                            =   {{azimuth}}
last update                       =   {{last_update}}
location info                     =   {{location}}
tracking time                    =   {{datetime}}
ecgi                                  =   {{ecgi}}
enbid                                =   {{enbid}}
operator                           =   {{operator}}
parameter longlat google =   {{parameter}}
latitude original                 =   {{lat_ori}}
longitude original              =   {{long_ori}}
enter                                 =   #$0A
';
?>
<style type="text/css">
    .form-control[disabled], fieldset[disabled] .form-control {
    cursor: default;
}
</style>

<div class="err-code-sms-view">

    
    
<?$attributes=[];
$attributes[]=['attribute' =>'tecs_err_code','format' => 'raw','options' => []];
$attributes[] = ['attribute' => 'tecs_aph_id', 'format' => 'raw', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => [
    'data' => ArrayHelper::map(Aph::find()->orderBy('ta_name')->asArray()->all(), 'ta_id', 'ta_name'),
    'options' => ['placeholder' => 'Select .....','name'=>'ErrCodeSms[tecs_aph_id]' ],
    'pluginOptions' => ['allowClear' => true, 'width' => '100%'],
], 'options' => []];
$attributes[]=['attribute' =>'tecs_sms_template','format' => 'raw','options' => []];
$attributes[] = ['attribute' => 'constanta', 'format' => 'raw', 'type' => DetailView::INPUT_TEXTAREA,
        'options' => ['rows' => 15,'disabled'=>'disabled']];
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
            'heading' => $this->title.' # ' . $model->tecs_id,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div id="footer_detail" class="text-center text-muted" style="display: none;"><small>create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                        $model->last_user."/".$model->last_ip."/".$model->last_update.'</small></div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->tecs_id],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
