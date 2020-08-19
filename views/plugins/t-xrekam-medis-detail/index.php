<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TRekamMedisDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'T Rekam Medis Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trekam-medis-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create T Rekam Medis Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'trmd_id',
            't_rekam_medis_prm_id',
            'f_rekam_medis_detail_type_frmdt_id',
            't_rekam_medis_trm_id',
            'trm_index',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
