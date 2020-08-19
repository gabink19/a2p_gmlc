<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GSensorAlarmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gsensor-alarm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gsa_id') ?>

    <?= $form->field($model, 'gsa_name') ?>

    <?= $form->field($model, 'gsa_value') ?>

    <?= $form->field($model, 'gsa_alarm_mode_ref') ?>

    <?= $form->field($model, 'g_sensor_db_gsd_id') ?>

    <?php // echo $form->field($model, 'f_sensor_detail_fsd_id') ?>

    <?php // echo $form->field($model, 'first_user') ?>

    <?php // echo $form->field($model, 'first_ip') ?>

    <?php // echo $form->field($model, 'first_update') ?>

    <?php // echo $form->field($model, 'last_user') ?>

    <?php // echo $form->field($model, 'last_ip') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'g_customer_gc_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
