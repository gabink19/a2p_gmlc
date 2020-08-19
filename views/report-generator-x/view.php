<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ReportGenerator */

$this->title = $model->tj_name;
$this->params['breadcrumbs'][] = ['label' => 'Report Generator', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<div class="report-generator-x-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'tj_id',
            'tj_name',
            'tj_desc',
            'tj_file',
            [
                'label'=>'Columns',
                'format'=>'raw',
                'value'=>'<div id="jstree_selected" ></div>',
            ],
        ],
    ]) ?>

    

</div>

<script>
// console.info($.fn.jquery);
var column = <?=json_encode($column)?>;
var fullMenuList = [];

for (var i = 0; i < column.length; i++) {
    fullMenuList.push({
        id: i,
        parent: "#",
        icon: "glyphicon glyphicon-leaf",   
        text: column[i].COLUMN_NAME,
        state : {"opened" : false},
    });
    
    var j = 1;
    for (var key in column[i]) {
        fullMenuList.push({
            id: i+"_"+j,
            parent: i,
            icon: "glyphicon glyphicon-info-sign",   
            text: key+":"+column[i][key],
        });
        j++;
    }
}

initTree(fullMenuList);

function initTree(collumn) {
    $('#jstree_selected').jstree({
        "core" : {
            'data' : collumn
        },
        "conditionalselect" : function (node, event) {
          
        },
        "plugins" : [ "conditionalselect" ]
    });
}

</script>