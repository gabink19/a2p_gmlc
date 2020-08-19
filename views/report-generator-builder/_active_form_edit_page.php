<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use kdn\yii2\JsonEditor;

$escape = new JsExpression("function(m) { return m; }");
?>


<div class="report-generator-form">



    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]
    );

    echo $form->field($model, 'param0')->textarea(['rows' => 1,])->label("page name", ['class' => 'label-class']);

    $items = [];


    $content2 = "";
    $content2 = $content2 . $form->field($model, 'param1')->textarea(['rows' => 1,])->label("limit", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param2')->textarea(['rows' => 1,])->label("where", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param3')->textarea(['rows' => 1,])->label("order by", ['class' => 'label-class']);
    $items[] = [
        'label' => '<i class="fas fa-home"></i> database advance',
        'content' => $content2,
        'active' => true,];

    $content2 = "";

    $content2 = $content2 . $form->field($model, "param12")->widget(kartik\select2\Select2::classname(), [
                'hideSearch' => false,
                'data' => $selection_column,
                'options' => ['placeholder' => 'select',
                ],
                'pluginOptions' => [
                    'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
                    ]
            )->label("index", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, "param13")->widget(kartik\select2\Select2::classname(), [
                'hideSearch' => false,
                'data' => $selection_table,
                'options' => ['placeholder' => 'select',
                ],
                'pluginOptions' => [
                    'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
                    ]
            )->label("detail_table", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param4')->textarea(['rows' => 1,])->label("realtime url", ['class' => 'label-class']);
    //echo $form->field($model, 'param5')->textarea(['rows' => 1,])->label("dashboard_name", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param9')->textarea(['rows' => 1,])->label("limit(detail)", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param10')->textarea(['rows' => 1,])->label("where(detail)", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param11')->textarea(['rows' => 1,])->label("order by(detail)", ['class' => 'label-class']);


    $items[] = [
        'label' => '<i class="fas fa-home"></i> realtime',
        'content' => $content2,
        'active' => false,];




    $content2 = "";

    $content2 = $content2 . $form->field($model, "param5")->widget(kartik\select2\Select2::classname(), [
                'hideSearch' => false,
                'data' => $dashboard_list,
                'options' => ['placeholder' => 'select',
                ],
                'pluginOptions' => [
                    'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
                    ]
            )->label("position", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param6')->widget(
                    JsonEditor::class, [
                'clientOptions' => ['modes' => ['code', 'tree']],
                'value' => $model->param6, /* if attribute contains already decoded JSON,
                      then you should pass it as shown, otherwise omit this line */
                    ]
    )->label("dashboard_option", ['class' => 'label-class']);
    //$content2=$content2.$form->field($model, 'param6')->textarea(['rows' => 1,])->label("dashboard_option", ['class' => 'label-class']);
    //echo $form->field($model, 'param7')->textarea(['rows' => 1,])->label("dashboard_backgrond", ['class' => 'label-class']);
    $content2 = $content2 . $form->field($model, 'param7')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => [
                        $model->param7,
                    ],
                    'initialPreviewAsData' => true,
                ]
            ])->label("dashboard_backgrond", ['class' => 'label-class']);
    ;

    $items[] = [
        'label' => '<i class="fas fa-home"></i> options',
        'content' => $content2,
        'active' => false,];
    $content2 = "";
    $content2 = $content2 . $form->field($model, 'param8')->checkboxList($selection_column, ['inline' => true])->label("pre defined column", ['class' => 'label-class']);
    //echo $form->field($model, 'param8')->widget(kartik\checkbox\CheckboxX::classname(), [])->label("pre defined column", ['class' => 'label-class']); 


    $items[] = [
        'label' => '<i class="fas fa-home"></i> column',
        'content' => $content2,
        'active' => false,];

    echo kartik\tabs\TabsX::widget([
        'items' => $items,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'height' => kartik\tabs\TabsX::SIZE_LARGE,
        'bordered' => true,
        'encodeLabels' => false,
        'pluginOptions' => ['enableCache' => 'false'],
    ]);
    ?>






    <div class="form-group">
        <?= Html::submitButton('save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

<?
$js = <<<js
        
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


