<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ttransksi-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ttd_id')->textInput() ?>

    <?= $form->field($model, 't_transaksi_tt_id')->textInput() ?>

    <?= $form->field($model, 'g_poliklinik_gp_id')->textInput() ?>

    <?= $form->field($model, 'g_tenaga_medis_gtm_id')->textInput() ?>

    <?= $form->field($model, 'g_peralatan_gp_id')->textInput() ?>

    <?= $form->field($model, 'g_services_gs_id')->textInput() ?>

    <?= $form->field($model, 't_transaksi_detail_ttd_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
