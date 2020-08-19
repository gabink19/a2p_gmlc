<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $model app\models\GSensorAlarm */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="gsensor-alarm-form">

<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->gsa_id],]
    ); ?>
    <?= $form->field($model,'gsa_name')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'gsa_value')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'g_sensor_db_gsd_id')->widget(kartik\select2\Select2::classname(), [
                            'hideSearch' => false,
                            'data' => ArrayHelper::map(app\models\GSensorDb::find()->all(), 'gsd_id', 'gsd_name'),
                            'options' => ['placeholder' => 'select','id'=>'gsensoralarm-g_sensor_db_gsd_id'.$model->gsa_id,],
                                                        
                            'pluginOptions' => [
                                'allowClear' => true,
                                
                            ],
                            ]
                        
                        )
?>    <?= $form->field($model,'f_sensor_detail_fsd_id')->widget(kartik\select2\Select2::classname(), [
                            'hideSearch' => false,
                            'data' => ArrayHelper::map(app\models\FSensorDetail::find()->all(), 'fsd_id', 'fsd_name'),
                            'options' => ['placeholder' => 'select','id'=>'gsensoralarm-f_sensor_detail_fsd_id'.$model->gsa_id,],
                                                        
                            'pluginOptions' => [
                                'allowClear' => true,
                                
                            ],
                            ]
                        
                        )
?>    <?= $form->field($model,'gsa_alarm_mode_ref')->widget(kartik\select2\Select2::classname(), [
                                    'hideSearch' => false,
                                    'data' => Yii::$app->params['alarmMode'],
                                    'options' => ['placeholder' => 'select',
                                        'id'=>'gsa_alarm_mode_ref'.$model->gsa_id,

                                         ],
                                        'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                    ]

                                )
?>    <?= $form->field($model,'g_customer_gc_id')->widget(kartik\select2\Select2::classname(), [
                            'hideSearch' => false,
                            'data' => ArrayHelper::map(app\models\GCustomer::find()->all(), 'gc_id', 'gc_name'),
                            'options' => ['placeholder' => 'select','id'=>'gsensoralarm-g_customer_gc_id'.$model->gsa_id,],
                                                        
                            'pluginOptions' => [
                                'allowClear' => true,
                                
                            ],
                            ]
                        
                        )
?>    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<?$js=<<<js
        
    $(".submitForm").submit(function(event) {
                        
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                alert(response.data.message); 
                $(".modal.in").modal('hide');
                
                //$.pjax.reload({container: '#id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;

    });
  
js;
$this->registerJs($js);
?>


