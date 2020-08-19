<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax; 
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");

$this->title = 'Create Report';
$this->params['breadcrumbs'][] = ['label' => 'ReportGeneratorX', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-generator-x-create">

    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?
    if (!isset($redirect_url)) $redirect_url="/index.php?r=report-generator-x&Findex";
    echo $this->render('_form', [
        'model' => $model,
        'table' => $table,
        'json' => null,
        'redirect_url'=>$redirect_url
    ]) ?>



</div>
