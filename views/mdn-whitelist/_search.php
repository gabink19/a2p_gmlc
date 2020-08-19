<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MdnWhitelistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdn-whitelist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tmw_id') ?>

    <?= $form->field($model, 'tmw_aph_id') ?>

    <?= $form->field($model, 'tmw_name') ?>

    <?= $form->field($model, 'tmw_mdn') ?>

    <?= $form->field($model, 'first_user') ?>

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
