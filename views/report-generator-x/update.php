<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax; 
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
if (!isset($redirect_url)) {
    $this->title = 'Update Report: ' . ' ' . $model->tj_name;
    $this->params['breadcrumbs'][] = ['label' => 'ReportGeneratorX', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->tj_id, 'url' => ['view', 'id' => $model->tj_id]];
    $this->params['breadcrumbs'][] = 'Update';
    }
?>
<div class="report-generator-x-update">
	<?     if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->gc_id]); 
    }
    if ($view_form==null) $view_form='_form';
    ?>
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <? 
    if (!isset($redirect_url)) $redirect_url="/index.php?r=report-generator-x&Findex";
    echo $this->render('_form', [
        'model' => $model,
        'table' => $table,
        'json' => $json,
        'redirect_url'=>$redirect_url
    ]) ?>

    <?  
    if ($pjax_enable) {
        Pjax::end();
    }?>

</div>
