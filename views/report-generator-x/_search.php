<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\reportGeneratorXSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-generator-x-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => $model->formName()
    ]); ?>

    <?= $form->field($model, 'tj_name') ?>

    <?= $form->field($model, 'tj_desc') ?>

    <?= $form->field($model, 'tj_file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
