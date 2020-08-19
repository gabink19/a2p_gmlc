<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2;




/* @var $this yii\web\View */
/* @var $model app\models\AuthLogin */
/* @var $form yii\widgets\ActiveForm */
$escape = new JsExpression("function(m) { return m; }");

$quer = 'SELECT name FROM auth_item where type=2';
$data = Yii::$app->db->createCommand($quer)->queryAll();
?>


<div class="auth-login-form">

<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->user_id],]
    ); ?>
    
    <?= $form->field($model,'tl_name')->textInput(['maxlength' => true,])?>

    <?=  $form->field($model, 'role')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($data, 'name', 'name'),
    'options' => ['placeholder' => 'Select Role ...'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Role');?>

    <?= $form->field($model, 'tl_password_new')->widget(kartik\password\PasswordInput::classname(), []);?>

    <?= $form->field($model,'tl_password_new2')->widget(kartik\password\PasswordInput::classname(), []);?>

        <?= $form->field($model,'tl_phone_number')->widget(kartik\number\NumberControl::classname(),['options' => ['id'=>'tl_phone_number'.$model->user_id,],'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false]])
?>    <?= $form->field($model,'tl_email')->widget(yii\widgets\MaskedInput::classname(),[     'clientOptions' => ['alias' => 'email',],
                                    ]


                                )
?>    <?= $form->field($model,'tl_address')->textInput(['maxlength' => true,])?>


    <?= $form->field($model,'tl_city')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'tl_country')->textInput(['maxlength' => true,])?>

    <div class="form-group">
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


