<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthLoginSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-login-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'tl_username') ?>

    <?= $form->field($model, 'tl_password') ?>

    <?= $form->field($model, 'tl_authKey') ?>

    <?= $form->field($model, 'tl_accessToken') ?>

    <?php // echo $form->field($model, 'first_user') ?>

    <?php // echo $form->field($model, 'first_ip') ?>

    <?php // echo $form->field($model, 'first_update') ?>

    <?php // echo $form->field($model, 'last_user') ?>

    <?php // echo $form->field($model, 'last_ip') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'g_customer_gc_id') ?>

    <?php // echo $form->field($model, 'tl_password_expire') ?>

    <?php // echo $form->field($model, 'tl_account_expire') ?>

    <?php // echo $form->field($model, 'tl_change_pasword_duration') ?>

    <?php // echo $form->field($model, 'tl_user_status_ref') ?>

    <?php // echo $form->field($model, 'tl_email') ?>

    <?php // echo $form->field($model, 'tl_phone_number') ?>

    <?php // echo $form->field($model, 'tl_address') ?>

    <?php // echo $form->field($model, 'tl_address2') ?>

    <?php // echo $form->field($model, 'tl_city') ?>

    <?php // echo $form->field($model, 'tl_country') ?>

    <?php // echo $form->field($model, 'tl_retry_count') ?>

    <?php // echo $form->field($model, 'tl_max_retry') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
