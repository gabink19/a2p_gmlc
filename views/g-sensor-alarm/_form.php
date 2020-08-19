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

<div class="gsensor-alarm-view">

        
<?$attributes=[];
$attributes[]=['attribute' =>'gsa_name','options' => []];
$attributes[]=['attribute' =>'gsa_value','options' => []];
$attributes[]=['attribute' =>'g_sensor_db_gsd_id', 
                        

                        'format'=>'raw','displayOnly'=>$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a($model->gSensorDbGsd->gsd_name, ['g-sensor-db/view', 'id' => $model->g_sensor_db_gsd_id]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\models\GSensorDb::find()->all(), 'gsd_id', 'gsd_name'),
                            'options' => ['placeholder' => 'select',],
                            
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        ];
$attributes[]=['attribute' =>'f_sensor_detail_fsd_id', 
                        

                        'format'=>'raw','displayOnly'=>$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a($model->fSensorDetailFsd->fsd_name, ['f-sensor-detail/view', 'id' => $model->f_sensor_detail_fsd_id]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\models\FSensorDetail::find()->all(), 'fsd_id', 'fsd_name'),
                            'options' => ['placeholder' => 'select',],
                            
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        ];
$attributes[]=['attribute' =>'gsa_alarm_mode_ref',
                                   'displayOnly'=>$displayOnlyFlag,
                                   'type' => DetailView::INPUT_SELECT2,
                                   'value' => $model->gsaAlarmModeRefStr,
                                    'options' => [],
                                    'widgetOptions' => [
                                        'hideSearch' => true,
                                        'data' => Yii::$app->params['alarmMode'],
                                        'options' => ['placeholder' => 'select alarmMode'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]
                                   ];
$attributes[]=['attribute' =>'g_customer_gc_id', 
                        

                        'format'=>'raw','displayOnly'=>$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a($model->gCustomerGc->gc_name, ['g-customer/view', 'id' => $model->g_customer_gc_id]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\models\GCustomer::find()->all(), 'gc_id', 'gc_name'),
                            'options' => ['placeholder' => 'select',],
                            
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        ];
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
            'heading' => $this->title.' # ' . $model->gsa_id,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div class="text-center text-muted">create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                $model->last_user."/".$model->last_ip."/".$model->last_update.'</div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->gsa_id],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
