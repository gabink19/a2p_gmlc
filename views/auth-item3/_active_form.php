<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $model app\models\AuthItem3 */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="auth-item3-form">

<?php     if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model->name],]
    ); ?>
    <?= $form->field($model,'menu1')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'menu2')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'name')->textInput(['maxlength' => true,])?>

    <?= $form->field($model,'description')->textInput(['maxlength' => true,])?>

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


