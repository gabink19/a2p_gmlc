<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Aph;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\SummaryTpsDailySearch */
/* @var $form yii\widgets\ActiveForm */
$model->startDate = isset($_GET['SummaryTpsDailySearch'])?$_GET['SummaryTpsDailySearch']['startDate']:date('Y-m-d');
$model->endDate = isset($_GET['SummaryTpsDailySearch'])?$_GET['SummaryTpsDailySearch']['endDate']:date('Y-m-d');
?>

<div class="summary-mo-daily-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <div class="row">
        <div class="col-sm-6">
            <?= 
                $form->field($model, 'startDate')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'value' => isset($_GET['SummaryTpsDailySearch'])?$_GET['SummaryTpsDailySearch']['startDate']:date('Y-m-d'),
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ])
            ?>
        </div>
        <div class="col-sm-6" id='endDate'>
            <?= 
                $form->field($model, 'endDate')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'value' => isset($_GET['SummaryTpsDailySearch'])?$_GET['SummaryTpsDailySearch']['endDate']:date('Y-m-d'),
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ])
            ?>
        </div>
    </div><!--row-->

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
