<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use app\models\Aph;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportTransactionDailySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
// echo "<pre>"; print_r($dataProvider->query->all());echo "</pre>";die();
$this->title = 'Report Summary TPS Daily';
$this->params['breadcrumbs'][] = $this->title;
$columnExport=[
                // [
                //     'header'=>'Date',
                //     'value'=> function ($model) {
                //         return ;
                //     }
                // ],
                // [
                //     'header'=>'Video Submit Counter',
                //     'value'=> function ($model) {
                //         return $model->Video_Submit_Counter;
                //     }
                // ],
                // [
                //     'header'=>'Video Submit Response',
                //     'value'=> function ($model) {
                //         return $model->Video_Submit_Response;
                //     }
                // ],
            // [
            //     'attribute' =>'aph_id',
            //     'label' =>'APH Name',
            //     'value' => function($data){
            //         return @Aph::findOne($data['aph_id'])->ta_name;
            //     }, 
            // ],
            // [
            //     'attribute' =>'status',
            //     'value' => function($data){
            //         return @Yii::$app->params['status'][$data['status']];
            //     }, 
            // ],
            'date',
            'sms_mo',
            'api',
            'sms_mt',
            'dr',
            [
                'header'=>'Total',
                'value'=> function ($model) {
                    return $model->sms_mo+$model->api+$model->sms_mt+$model->dr;
                }
            ],
            ];
?>
<div class="report-summarymt-daily-index">

   <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel-heading">
        <div class="row">
        <div class="col-sm-11">
            <button type="button" class="btn btn-primary" id="search-data">Filter</button>
        </div>
        <div class="col-sm-1">
        <?php 
        // echo ExportMenu::widget([
        //                 'dataProvider' => $dataProvider,
        //                 'columns' => $columnExport,
        //                 'showConfirmAlert' => false,
        //                 'showColumnSelector' => false,
        //                 'target' => ExportMenu::TARGET_SELF,
        //                 'exportConfig' => [
        //                     ExportMenu::FORMAT_HTML => false,
        //                     ExportMenu::FORMAT_EXCEL => false,
        //                     ExportMenu::FORMAT_EXCEL_X => false,
        //                     ExportMenu::FORMAT_PDF => false,
        //                     ExportMenu::FORMAT_TEXT => false,
        //                     ExportMenu::FORMAT_CSV => [
        //                             'label' => 'Export CSV'
        //                     ]
        //                 ],
        //                 'filename' => 'Report Messaging Daily',
                        
        // ]); 
        ?>
        </div>
        </div><!--end row-->
    </div><!--end panel-heading--> 
    <?php Pjax::begin(['id'=>'user-grid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover' => true,
        'emptyTextOptions'=>['class'=>'empty'],
        'filterSelector' => "input[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h4>'.Html::encode($this->title).'</h4>',
        ],
        'rowOptions' => function($model){
                return ['class'=>'success'];
        },
        'columns' => $columnExport,
    ]); ?>
    <?php Pjax::end();?>
</div>
<?php
    Modal::begin([
        'header' => '<h4>Filter</h4>',
        'id' => 'advanced-search',
        'size' => 'modal-lg',        
    ]);
    echo "{$this->render('_search', ['model' => $searchModel])}";
    Modal::end();
?>
<?php
$url = $_SERVER["SCRIPT_NAME"].'?r=user/'.$this->context->id;
$tanggal = date('Y-m-d');

$js = <<<JS
    $(document).on('ready pjax:success', function() {
        
        $('.update').on('click',function(){
            var id = $(this).closest('tr').data('key');
            $('#modal').modal('show')
                .find('#modalContent')
                .load('$url/update&id='+id);
        });
        
        $('.view').on('click',function(){
            var id = $(this).closest('tr').data('key');
            $('#modal').modal('show')
                .find('#modalContent')
                .load('$url/view&id='+id);
        });
    });

 $('button[type="reset"]').on('click',function(){
        $('.form-control').each(function( index ) {
            name_id = $( this ).attr('id');
            if(name_id!='undefined' && name_id!=undefined){
                if (name_id.indexOf("date") >= 0){
                    $( this ).val('$tanggal')
                }else{
                    $( this ).val('').trigger('change')
                }
            }
        });
        return false;
    });
    $('#search-data').on('click',function(){
        $('#advanced-search').modal('show');
    });
    $('form#{$searchModel->formName()}').on('beforeSubmit',function(e){
        $('#advanced-search').modal('hide');
        var \$form = $(this);
        $.pjax.reload({url:\$form.attr('action')+'&'+\$form.serialize(),container:"#user-grid",async:false,replace:false});                 
        return false;
    });
    
    $('.update').on('click',function(){
        var id = $(this).closest('tr').data('key');
        $('#modal').modal('show')
            .find('#modalContent')
            .load('$url/update&id='+id);
    });
    $('.view').on('click',function(){
            var id = $(this).closest('tr').data('key');
            $('#modal').modal('show')
                .find('#modalContent')
                .load('$url/view&id='+id);
    });

    
JS;
$this->registerJs($js);
?>

