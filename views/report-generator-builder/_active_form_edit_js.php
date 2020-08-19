<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use kdn\yii2\JsonEditor;

$escape = new JsExpression("function(m) { return m; }");
?>
<style>
    
.CodeMirror {
  border: 1px solid #eee;
  height: auto;
}

</style>

<div class="report-generator-form">
     <?
    echo Html::button("<span class='glyphicon glyphicon-filter'></span>", [
        'style' => 'background:none;border:none;padding:5px;color:black',
        'class' => 'grid-action',
        'data-toggle' => 'collapse',
        'data-placement' => 'bottom',
        'data-target' => "#js_help",
        'title' => 'Filter'
    ]);?>
    
    

    <?php
    $form = ActiveForm::begin(['options' => ['class' => "ReportGeneratorSubmitForm2"]]);

    //echo $form->field($model, 'param6' )->textarea(['rows' => 1,'id' => "reportgenerator-param".$ke . '_1'])->label("Javascript", ['class' => 'label-class']);
    ?>
    <div id="js_help" class="collapse">
        
   
    <?= $form->field($model, 'param7' )->textarea(['rows' => 30,'id' => "reportgenerator-param".$ke . '_1'])->label("example code", ['class' => 'label-class']);
    ?>
    


    </div>
    <?

    echo $form->field($model, 'param6')->widget(
        conquer\codemirror\CodemirrorWidget::className(),
        [
            'preset'=>'Javascript',
           // 'options'=>['rows' => 100],
        ]
    )->label("Javascript", ['class' => 'label-class']);
    
    ?>






    <div class="form-group">
        <?= Html::submitButton('save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $return_url , ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

<?
$js = <<<js
        
    $(".ReportGeneratorSubmitForm").submit(function(event) {
                        
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
                //location.reload();
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


