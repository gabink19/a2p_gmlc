<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;




/* @var $this yii\web\View */
/* @var $model app\models\AuthLogin */
/* @var $form yii\widgets\ActiveForm */
$escape = new JsExpression("function(m) { return m; }");
?>


<div class="auth-login-form">

<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->user_id],]
    ); ?>
    <?= $form->field($model,'tl_user_status_ref')->widget(kartik\select2\Select2::classname(), [
                                    'hideSearch' => false,
                                    'data' => Yii::$app->params['userStatus'],
                                    'options' => ['placeholder' => 'select',
                                        'id'=>'tl_user_status_ref'.$model->user_id,

                                         ],
                                        'pluginOptions' => [
                                            'escapeMarkup' => $escape,
                                        
                                            'allowClear' => true
                                    ],
                                    ]

                                )
?>    <?= $form->field($model,'tl_username')->textInput(['maxlength' => true,])?>

   <div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_phone_number')->textInput(['maxlength' => true,])?>

</div><div class='col-md-6'>    <?= $form->field($model,'tl_email')->widget(yii\widgets\MaskedInput::classname(),[     'clientOptions' => ['alias' => 'email',],
                                    ]


                                )
?></div></div>    <?= $form->field($model,'tl_address')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'tl_address2')->textInput(['maxlength' => true,])?>

<div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_city')->textInput(['maxlength' => true,])?>

</div><div class='col-md-6'>    <?= $form->field($model,'tl_country')->textInput(['maxlength' => true,])?>

</div></div>    <?= $form->field($model,'tl_account_expire')->widget(kartik\widgets\DatePicker::classname(), [
                                   'value' => $model->tlAccountExpireStr,
                                   'options' => ['id'=>'tl_account_expire'.$model->user_id,],
                                   'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd'
                                                ],

                                    ]


                                )
?><div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_password_expire')->widget(kartik\widgets\DatePicker::classname(), [
                                   'value' => $model->tlPasswordExpireStr,
                                   'options' => ['id'=>'tl_password_expire'.$model->user_id,],
                                   'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd'
                                                ],

                                    ]


                                )
?></div><div class='col-md-6'>    <?= $form->field($model,'tl_change_pasword_duration')->widget(kartik\number\NumberControl::classname(),['options' => ['id'=>'tl_change_pasword_duration'.$model->user_id,],'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false]])
?></div></div><div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_retry_count')->textInput(['maxlength' => true,])?>

</div><div class='col-md-6'>    <?= $form->field($model,'tl_max_retry')->textInput(['maxlength' => true,])?>

</div></div>    <div class="form-group">
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
        console.log('action:'+ url);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert(response.data.message); 
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


