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
$data = ArrayHelper::map($data, 'name', 'name');
unset($data['Developer']);
?>


<div class="auth-login-form">

<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->user_id],]
    ); ?>
    <?= $form->field($model,'tl_username')->textInput(['maxlength' => true,])?>
    <?=  $form->field($model, 'role')->widget(Select2::classname(), [
    'data' => $data,
    'options' => ['placeholder' => 'Select Role ...'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Role');?>
<div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_password_new')->widget(kartik\password\PasswordInput::classname(),[     ]


                                )
?></div><div class='col-md-6'>    <?= $form->field($model,'tl_password_new2')->input('password',[])?>

</div></div>    <?= $form->field($model,'capcha')->widget(\yii\captcha\Captcha::classname(),['template' => '{image}{input}',     ]


                                )
?><div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_phone_number')->textInput(['maxlength' => true,])?>

</div><div class='col-md-6'>    <?= $form->field($model,'tl_email')->widget(yii\widgets\MaskedInput::classname(),[     'clientOptions' => ['alias' => 'email',],
                                    ]


                                )
?></div></div>    <?= $form->field($model,'tl_address')->textInput(['maxlength' => true,])?>


<div class='row'><div class='col-md-6'>    <?= $form->field($model,'tl_city')->textInput(['maxlength' => true,])?>

</div><div class='col-md-6'>    <?= $form->field($model,'tl_country')->textInput(['maxlength' => true,])?>

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


