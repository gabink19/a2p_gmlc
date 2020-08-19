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

<div class="auth-login-view">

    
    
<?$attributes=[];
$attributes[]=['attribute' =>'tl_user_status_ref',
                                   'displayOnly'=>$displayOnlyFlag,
                                   'type' => DetailView::INPUT_SELECT2,
                                   'format'=>'raw',
                                   'value' => $model->tlUserStatusRefStr,
                                    'options' => [],
                                    'widgetOptions' => [
                                        'hideSearch' => true,
                                        'data' => Yii::$app->params['userStatus'],
                                        'options' => ['placeholder' => 'select userStatus'],
                                        'pluginOptions' => [
                                            'escapeMarkup' => $escape,
                                            'allowClear' => true
                                        ],
                                    ]
                                   ];
$attributes[]=['attribute' =>'user_id','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_name','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_password_new','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_password_new2','format' => 'raw','options' => []];
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
$attributes[]=['attribute' =>'tl_password_expire',
                                   'value' => $model->tlPasswordExpireStr,
                                   'options' => [],
                                    'type' => DetailView::INPUT_DATE,
                                   'widgetOptions' => [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd'
                                                ],
                                    ]
                                   ];
$attributes[]=['attribute' =>'tl_account_expire',
                                   'value' => $model->tlAccountExpireStr,
                                   'options' => [],
                                    'type' => DetailView::INPUT_DATE,
                                   'widgetOptions' => [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd'
                                                ],
                                    ]
                                   ];
$attributes[]=['attribute' =>'tl_change_pasword_duration',
                                   'type' => DetailView::INPUT_WIDGET,
                                    'options' => [],
                                    'widgetOptions' => [
                                        'class' => 'kartik\number\NumberControl',
                                        'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false],

                                    ]
                                   ];
$attributes[]=['attribute' =>'tl_phone_number',
                                   'type' => DetailView::INPUT_WIDGET,
                                    'options' => [],
                                    'widgetOptions' => [
                                        'class' => 'kartik\number\NumberControl',
                                        'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false],

                                    ]
                                   ];
$attributes[]=['attribute' =>'tl_email',
                                   'type' => DetailView::INPUT_WIDGET,
                                   'options' => [],
                                    'widgetOptions' => [
                                        'class' => 'yii\widgets\MaskedInput',
                                        'clientOptions' => [
                                            'alias' => 'email'
                                                ],
                                    ]
                                   ];
$attributes[]=['attribute' =>'tl_address','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_address2','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_city','format' => 'raw','options' => []];
$attributes[]=['attribute' =>'tl_country','format' => 'raw','options' => []];
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
            'heading' => $this->title.' # ' . $model->user_id,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div id="footer_detail" class="text-center text-muted" style="display: none;"><small>create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                        $model->last_user."/".$model->last_ip."/".$model->last_update.'</small></div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->user_id],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
