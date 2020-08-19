<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRekamMedisDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trekam-medis-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trmd_id') ?>

    <?= $form->field($model, 't_rekam_medis_prm_id') ?>

    <?= $form->field($model, 'f_rekam_medis_detail_type_frmdt_id') ?>

    <?= $form->field($model, 't_rekam_medis_trm_id') ?>

    <?= $form->field($model, 'trm_index') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
