<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\dialog\Dialog;

$escape = new JsExpression("function(m) { return m; }");
?>
<?php
if ($view_form== 'create-dashboard'){
$this->title = 'Create Dashboard';
} else {
    $this->title = 'Update Dashboard';   
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-generator-dashboard-x-create">

    <?
    if ($modal_class == null) $modal_class = 'comment-form2';
    else $modal_class = 'submitForm';
    $form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'class' => $modal_class],
        'action' => [$view_form, 'folder'=>$folder],
        // 'id' => '',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute('report-generator-x/validation')
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $form->field($model, 'tj_name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id'=>'bott']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    h1 {
        text-align: center
    }

    .report-generator-dashboard-x-form table,
    .report-generator-dashboard-x-form th,
    .report-generator-dashboard-x-form td {
        border: 1px solid black;
        border-collapse: collapse
    }

    .report-generator-dashboard-x-form th,
    .report-generator-dashboard-x-form td {
        width: 50%;
        padding: 5px;
        text-align: left
    }
</style>
<?
echo Dialog::widget(['overrideYiiConfirm' => false ]);
$js = <<<js
var app_mode='$app_mode';
// $('#bott').on('click', function () {
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
                if ('$view_form'== 'create-dashboard'){
                krajeeDialog.confirm('Success create dashboard<br>go to dashboard?', function (result) {
                if (result) {
                    if (app_mode==''){
                document.location = "index.php?r=tree/index&folder="+response.data.folder;
                    } else {
                        document.location = "index.php?r=tree/index&app_mode=1&folder="+response.data.folder;
                    }
                }
                else {
                location.reload();
                }
                }); 
} else {
     krajeeDialog.confirm('Success update dashboard<br>go to dashboard?', function (result) {
        if (app_mode==''){
                if (result) {
                document.location = "index.php?r=tree/index&folder="+response.data.folder;
                }
                else {
                document.location = "index.php?r=report-generator-x%2Fupdate-dashboard&&folder="+response.data.folder;
                }}
                else {
                    if (result) {
                        document.location = "index.php?r=tree/index&app_mode=1&folder="+response.data.folder;
                        }
                        else {
                        document.location = "index.php?r=report-generator-x%2Fupdate-dashboard&app_mode=1&folder="+response.data.folder;
                        }  
                }
                });   
}
               
            }  
            if (response.data.success === 'fail save') {
            krajeeDialog.alert("This name already exists!");
console.log("XXsubmitForm.submit done");  
            }

        })
        .fail(function() {
            // alert("fail");

        });
        // return false;

    });
//   });
js;
$this->registerJs($js);
?>