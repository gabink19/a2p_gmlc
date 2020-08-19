<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetail */

$this->title = 'Update T Transksi Detail: ' . $model->ttd_id;
$this->params['breadcrumbs'][] = ['label' => 'T Transksi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ttd_id, 'url' => ['view', 'id' => $model->ttd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ttransksi-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
