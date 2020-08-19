<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GHistoryLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ghistory-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ghl_id') ?>

    <?= $form->field($model, 'ghl_userid') ?>

    <?= $form->field($model, 'ghl_username') ?>

    <?= $form->field($model, 'ghl_log') ?>

    <?= $form->field($model, 'ghl_ip') ?>

    <?php // echo $form->field($model, 'ghl_date') ?>

    <?php // echo $form->field($model, 'ghl_id_model') ?>

    <?php // echo $form->field($model, 'ghl_model') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
