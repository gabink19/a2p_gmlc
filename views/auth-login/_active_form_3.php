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
    <?= $form->field($model,'tl_username')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'tl_password_old')->input('password',[])?>

    <?= $form->field($model,'tl_password_new')->widget(kartik\password\PasswordInput::classname(),[     ]


                                )
?>    <?= $form->field($model,'tl_password_new2')->input('password',[])?>

    <?= $form->field($model,'capcha')->widget(\yii\captcha\Captcha::classname(),['template' => '{image}{input}',     ]


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


