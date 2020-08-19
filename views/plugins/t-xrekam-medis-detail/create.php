<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TRekamMedisDetail */

$this->title = 'Create T Rekam Medis Detail';
$this->params['breadcrumbs'][] = ['label' => 'T Rekam Medis Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trekam-medis-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
