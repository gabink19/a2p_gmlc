<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetail */

$this->title = 'Create T Transaksi Detail';
$this->params['breadcrumbs'][] = ['label' => 'T Transksi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ttransaksi-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
