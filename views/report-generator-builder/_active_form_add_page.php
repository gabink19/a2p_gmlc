<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
?>


<div class="report-generator-form">

    
    <?php
    $form = ActiveForm::begin(['options' => ['class' => "submitForm"]]
    );
       echo $form->field($model, 'param0')->textarea(['rows' => 1,])->label("page name", ['class' => 'label-class']);
                
       
    ?>

    
    


        <div class="form-group">
        <?= Html::submitButton('add', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>



    </div>

<?
$js=<<<js
        
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
                //$(".modal.in").modal('hide');
                location.reload();
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


