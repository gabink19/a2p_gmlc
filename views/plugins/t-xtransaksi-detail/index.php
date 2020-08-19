<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TTransksiDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'T Transaksi Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ttransaksi-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create T Transaksi Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $f_services_type=$model->getFServicesType();
            $model_name= $f_services_type["fst_model_name"];
            $view_name=$f_services_type["fst_view_name"];
             
            if (($new_model = $model_name::findOne($model->ttd_id)) !== null) {
            
                //$searchModel3 = new $model_name();
                //$searchModel3 = new $model_name();

                $content2 = $this->render($view_name.'view', [
                    'model' => $model,
                   // 'master_id' => $model->tt_id,
                  //      'view_only'=>$view_only,

                        ]);
                return $content2;
            } else {
                return "not found";
            }
//return $view_name;
           
            //return Html::a(Html::encode($model->ttd_id), ['view', 'id' => $model->ttd_id]);
        },
    ]) ?>
</div>
