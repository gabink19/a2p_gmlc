<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TRekamMedisDetail */

$this->title = $model->trmd_id;
$this->params['breadcrumbs'][] = ['label' => 'T Rekam Medis Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trekam-medis-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->trmd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->trmd_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'trmd_id',
            't_rekam_medis_prm_id',
            'f_rekam_medis_detail_type_frmdt_id',
            't_rekam_medis_trm_id',
            'trm_index',
        ],
    ]) ?>

</div>
