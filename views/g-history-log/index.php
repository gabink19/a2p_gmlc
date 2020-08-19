

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
try {
    
    include(dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php");
    $obj_name="GHistoryLog_config";
    $$obj_name=$obj_name();    
    
    
        

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/GHistoryLog_Config.php".".\n";
}




use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GHistoryLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['app\models\GHistoryLog']['name'];
//if ($title==null) $title='G History Log';   
 
$title=$GHistoryLog_config['name'];
if ($title==null or $title=="") $title='G History Log';   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
$content = $this->render("//g-sensor-alarm/_show_all", []);if ($content != "") {Yii::$app->session->setFlash("error", $content);}?>


<div class="ghistory-log-index">

    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
            
    
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'GHistoryLogid_pjax_id']); 
    }
    ?>
    
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <? if (!$create_flag or $remove_create1) {echo "<!--";}?><a class="btn btn-info GHistoryLogmodalButton" value="<?= Url::to(['//g-history-log/create-ajax','app_mode'=>$app_mode]) ?>">Create <?=$title?></a>
        <? if (!$create_flag or $remove_create1) {echo "-->";}?>
        <? if (!$create_flag or $remove_create2) {echo "<!--";}?><?= Html::a('Create '.$title, ['//g-history-log/create','app_mode'=>$app_mode], ['class' => 'btn btn-success']) ?>
        <? if (!$create_flag or $remove_create2) {echo "-->";}?>
        <!--['create2','t_transaksi_tt_id'=>'1','f_rekam_medis_type_frmt_id'=>'1']-->        
            

    </p>

        
    
        
        <?         //$modal_mode=1;
                $GLOBALS['app_mode']=$app_mode;
        $ActionColumn=[];
        $ActionColumn[]=['class' => 'kartik\grid\SerialColumn'];
        
        if ($modal_mode==2) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//g-history-log/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'GHistoryLogmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//g-history-log/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", ['//g-history-log/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]);
                            return $btn;
                        }
                    ];
        } else if ($modal_mode) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//g-history-log/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'GHistoryLogmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//g-history-log/view-only','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'GHistoryLogmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//g-history-log/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'GHistoryLogajaxButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Delete'
                            ]);
                            return $btn;
                        }
                    ];
                    
            } else {
                
                $buttons = [
                        'update' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-pencil'></span>", [
                                        '//g-history-log/update','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//g-history-log/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", [
                                    '//g-history-log/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->ghl_id]);            
                            
                            return $btn;
                        }
                    ];
            } 
            
            
        if ($view_flag or $update_flag or $delete_flag) {
            $ActionColumn[]=['class' => 'kartik\grid\ActionColumn',
                    'options' => ['class' => 'action-column'],
                    'template' => ($view_flag==true?"{view} ":"").($update_flag==true?"{update} ":"").($delete_flag==true?"{delete} ":"")." ",
                    'buttons' =>$buttons
                        ];
        };
            
                $ActionColumn[]=[
            'attribute'=>'ghl_userid',
            'value'=>'ghl_userid',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_username',
            'value'=>'ghl_username',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_log',
            'value'=>'ghl_log',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_ip',
            'value'=>'ghl_ip',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_date',
            'value'=>'ghl_date',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_id_model',
            'value'=>'ghl_id_model',
            ];
            $ActionColumn[]=[
            'attribute'=>'ghl_model',
            'value'=>'ghl_model',
            ];
        
            
            
    echo GridView::widget([
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        
        'dataProvider' => $dataProvider,
        'responsiveWrap'=>false,
        
        'filterModel' => $searchModel,'columns' =>         $ActionColumn,
                    
        
        ]); 
        
        ?>
        
     <?    Modal::begin([
        'options' => [ 
               'id' => 'GHistoryLogmyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Create '.$title,
        'id' => 'GHistoryLogmyModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='GHistoryLogmodalContent'></div>";
    Modal::end();

    
    
$js=<<<js
    $('.GHistoryLogmodalButton').on('click', function () {
        console.log( 'GHistoryLogmodalButton.click' );
        $('#GHistoryLogmyModal').modal('show')
                .find('#GHistoryLogmodalContent')
                .load($(this).attr('value'));
    });
    $('.GHistoryLogajaxButton').on('click', function () {
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
                $.pjax.reload({container: '#GHistoryLogid_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $(".btn-success").on('click', function(){
            $("#GHistoryLogmyModal").on('hide.bs.modal', function(){
        console.log( 'GHistoryLogmodalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#GHistoryLogid_pjax_id', async: false});  
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
});
js;
$this->registerJs($js);
?>       
<?    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
    
    
        
    
    
</div>


 