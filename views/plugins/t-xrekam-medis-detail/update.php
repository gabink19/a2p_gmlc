<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TRekamMedisDetail */

$this->title = 'Update T Rekam Medis Detail: ' . $model->trmd_id;
$this->params['breadcrumbs'][] = ['label' => 'T Rekam Medis Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trmd_id, 'url' => ['view', 'id' => $model->trmd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trekam-medis-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
