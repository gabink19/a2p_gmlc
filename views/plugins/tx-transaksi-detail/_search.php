<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ttransksi-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ttd_id') ?>

    <?= $form->field($model, 't_transaksi_tt_id') ?>

    <?= $form->field($model, 'g_poliklinik_gp_id') ?>

    <?= $form->field($model, 'g_tenaga_medis_gtm_id') ?>

    <?= $form->field($model, 'g_peralatan_gp_id') ?>

    <?php // echo $form->field($model, 'g_services_gs_id') ?>

    <?php // echo $form->field($model, 't_transksi_detail_ttd_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
