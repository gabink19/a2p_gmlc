<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Aph;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AphTransactionHistoryDailySearch */
/* @var $form yii\widgets\ActiveForm */
$model->startDate = isset($_GET['AphTransactionHistoryDailySearch'])?$_GET['AphTransactionHistoryDailySearch']['startDate']:date('Y-m-d');
$model->endDate = isset($_GET['AphTransactionHistoryDailySearch'])?$_GET['AphTransactionHistoryDailySearch']['endDate']:date('Y-m-d');
?>

<div class="summary-mo-daily-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <div class="row">
        <div class="col-sm-3">
            <?= 
                $form->field($model, 'startDate')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'value' => isset($_GET['AphTransactionHistoryDailySearch'])?$_GET['AphTransactionHistoryDailySearch']['startDate']:date('Y-m-d'),
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ])
            ?>
        </div>
        <div class="col-sm-3" id='endDate'>
            <?= 
                $form->field($model, 'endDate')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => false,
                        'value' => isset($_GET['AphTransactionHistoryDailySearch'])?$_GET['AphTransactionHistoryDailySearch']['endDate']:date('Y-m-d'),
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                ])
            ?>
        </div>
    </div><!--row-->

    <?= $form->field($model, 'shortcode') ?>

    <?=  $form->field($model, 'aph_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Aph::find()->orderBy('ta_name')->asArray()->all(), 'ta_id', 'ta_name'),
    'options' => ['placeholder' => 'Select APH ...'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('APH Name');?>

    <?php echo $form->field($model, 'direction')->dropDownList(
                Yii::$app->params['direction'], 
                ['prompt'=>'Select MO/MT']);
                ?>

    <?php echo $form->field($model, 'error_code') ?>

    <?php // echo $form->field($model, 'total') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
