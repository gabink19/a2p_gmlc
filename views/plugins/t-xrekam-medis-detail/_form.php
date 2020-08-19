<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRekamMedisDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trekam-medis-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trmd_id')->textInput() ?>

    <?= $form->field($model, 't_rekam_medis_prm_id')->textInput() ?>

    <?= $form->field($model, 'f_rekam_medis_detail_type_frmdt_id')->textInput() ?>

    <?= $form->field($model, 't_rekam_medis_trm_id')->textInput() ?>

    <?= $form->field($model, 'trm_index')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
