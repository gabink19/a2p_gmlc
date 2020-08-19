<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\reportGeneratorXSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report Generator X';
$this->params['breadcrumbs'][] = $this->title;

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<div class="report-generator-x-index">
    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
    <p>
        <? if (!$create_flag or $remove_create1) {echo "<!--";}?><a class="btn btn-info RGXmodalButton" value="<?= Url::to(['//report-generator-x/create','app_mode'=>$app_mode]) ?>">Create <?=$title?></a>
        <? if (!$create_flag or $remove_create1) {echo "-->";}?>
        <? if (!$create_flag or $remove_create2) {echo "<!--";}?><?= Html::a('Create '.$title, ['//report-generator-x/create','app_mode'=>$app_mode], ['class' => 'btn btn-success']) ?>
        <? if (!$create_flag or $remove_create2) {echo "-->";}?>
	</p>
    
    <?php Pjax::begin(['id'=>'report-generator-x-grid','enablePushState'=>false]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover' => true,
        'toolbar' =>  [],
        'responsiveWrap' => false,
        'columns' => [
            // 'tj_id',
            'tj_name',
            'tj_desc',
            'tj_file',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'buttons' => [                        
                        'view'=> function($url, $model,$key){
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('yii', 'View'),
                                        'class' => 'view',
                            ]);
                        },
                        'update'=> function($url, $model,$key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('yii', 'Update'),
                                        'class'=>'update',
                            ]);
                        },
                        'delete'=> function($url, $model,$key){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-method'=>'post',
                                        'data-confirm' => "Are you sure you want to delete?"
                                
                            ]);
                        },
                ],               
              ],
        ],
    ]); ?>
    <?php Pjax::end();?>

    <?php Modal::begin([
        'options' => [ 
               'id' => 'RGXmyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Modal',
        'id' => 'RGXmyModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='GCustomermodalContent'></div>";
    Modal::end(); ?>


</div>

<?php
$js=<<<js
    $.noConflict();
    $('.view').on('click', function () {
        console.log( 'view.click' );
        event.preventDefault(); // stopping submitting
        $('#RGXmyModal').modal('show')
                .find('#GCustomermodalContent')
                .load($(this).attr('href'));
    });

    

    $('.RGXmodalButton').on('click', function () {
        console.log( 'RGXmodalButton.click' );
        $('#RGXmyModal').modal('show')
                .find('#GCustomermodalContent')
                .load($(this).attr('value'));
    });
    $('.GCustomerajaxButton').on('click', function () {
        console.log( 'ajaxButton.click' );
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        var data = $(this).serializeArray();
        var url = $(this).attr('value');
        console.log( url );
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert('deleted');
                $.pjax.reload({container: '#report-generator-x-grid', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $("#RGXmyModal").on('hide.bs.modal', function(){
        console.log( 'RGXmodalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
            $('#GCustomermodalContent').empty();
            // $.pjax.reload({container: '#report-generator-x-grid', async: false});  
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
 
js;
$this->registerJs($js);
?>