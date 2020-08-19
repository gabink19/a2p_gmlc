<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetail */

$this->title = $model->ttd_id;
$this->params['breadcrumbs'][] = ['label' => 'T Transaksi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ttransaksi-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ttd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ttd_id], [
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
            'ttd_id',
            't_transaksi_tt_id',
            'g_poliklinik_gp_id',
            'g_tenaga_medis_gtm_id',
            'g_peralatan_gp_id',
            'gServicesGs.gs_service_name',
            't_transaksi_detail_ttd_id',
        ],
    ]) ?>

</div>
