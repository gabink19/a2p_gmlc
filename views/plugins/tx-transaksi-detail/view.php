<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\TTransksiDetail */
// echo $viewName;
?>
<div class="ttransaksi-detail-view">
<?php Pjax::begin(['id' => $idFrame,'enablePushState' => false]); ?>
<?php
    //$this->title = $model->ttd_id;
    //$this->params['breadcrumbs'][] = ['label' => 'T Transaksi Details', 'url' => ['index']];
    //$this->params['breadcrumbs'][] = $this->title;
    //\yii\web\YiiAsset::register($this);    
?>
    <h1><?= Html::encode($this->title) ?></h1> 

    <p>
        <?= Html::a('Update', [$viewName.'update', 'id' => $model->ttd_id, 'idFrame' => $idFrame], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', [$viewName.'delete', 'id' => $model->ttd_id], [
            'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => 'Are you sure you want to delete this item?',
            //     'method' => 'post',
            // ],
        ]) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ttd_id',
            't_transaksi_tt_id',
           
            'gServicesGs.gs_name',
            ],
    ]) ?>


</div>
<script type="text/javascript">
  function closeIframe() {
      parent.window.postMessage("<?php echo $idFrame; ?>", "*");
     // var iframe = document.getElementById('<?php echo $idFrame; ?>');
     // iframe.parentNode.removeChild(iframe);
  }
</script>
<?php Pjax::end(); ?>