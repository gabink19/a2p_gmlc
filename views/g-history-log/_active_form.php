<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;




/* @var $this yii\web\View */
/* @var $model app\models\GHistoryLog */
/* @var $form yii\widgets\ActiveForm */
$escape = new JsExpression("function(m) { return m; }");
?>


<div class="ghistory-log-form">
        
<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->ghl_id,'app_mode'=>$app_mode],]
    ); ?>
    <?= $form->field($model,'ghl_userid')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_username')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_log')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_ip')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_date')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_id_model')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'ghl_model')->textInput(['maxlength' => true,])?>

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


