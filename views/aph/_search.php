<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AphSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aph-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_id') ?>

    <?= $form->field($model, 'ta_name') ?>

    <?= $form->field($model, 'ta_desc') ?>

    <?= $form->field($model, 'ta_api_username') ?>

    <?= $form->field($model, 'ta_api_password') ?>

    <?php // echo $form->field($model, 'first_user') ?>

    <?php // echo $form->field($model, 'first_ip') ?>

    <?php // echo $form->field($model, 'first_update') ?>

    <?php // echo $form->field($model, 'last_user') ?>

    <?php // echo $form->field($model, 'last_ip') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
