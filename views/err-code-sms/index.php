

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Aph;
try {
    
    include(dirname(__FILE__) .    "/../../models/ErrCodeSms_Config.php");
    $obj_name="ErrCodeSms_config";
    $$obj_name=$obj_name();    
    
    
        

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/ErrCodeSms_Config.php".".\n";
}




use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ErrCodeSmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['app\models\ErrCodeSms']['name'];
//if ($title==null) $title='Err Code Sms';   
 
$title=$ErrCodeSms_config['name'];
if ($title==null or $title=="") $title='Err Code Sms';   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
$content = $this->render("//g-sensor-alarm/_show_all", []);if ($content != "") {Yii::$app->session->setFlash("error", $content);}?>


<div class="err-code-sms-index">

    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
            
    
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'ErrCodeSmsid_pjax_id']); 
    }
    ?>
    
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a('Create '.$title, ['//err-code-sms/create','app_mode'=>$app_mode], ['class' => 'btn btn-success']) ?>     
            

    </p>

        
    
        
        <?         //$modal_mode=1;
                $GLOBALS['app_mode']=$app_mode;
        $ActionColumn=[];
        $ActionColumn[]=['class' => 'kartik\grid\SerialColumn'];
        
        if ($modal_mode==2) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//err-code-sms/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ErrCodeSmsmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//err-code-sms/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", ['//err-code-sms/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]);
                            return $btn;
                        }
                    ];
        } else if ($modal_mode) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//err-code-sms/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ErrCodeSmsmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//err-code-sms/view-only','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ErrCodeSmsmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//err-code-sms/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ErrCodeSmsajaxButton grid-action',
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
                                        '//err-code-sms/update','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//err-code-sms/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash' style='color:#3c8dbc'></span>", [
                                        'value' => Url::to(['//err-code-sms/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ErrCodeSmsajaxButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Delete'
                            ]);
                            return $btn;
                        }
                        // 'delete' => function($url, $model, $key) {
                        //     $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", [
                        //             '//err-code-sms/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tecs_id]);            
                            
                        //     return $btn;
                        // }
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
            'attribute'=>'tecs_err_code',
            'value'=>'tecs_err_code',
            ];
            $ActionColumn[]=[
            'attribute'=>'tecs_sms_template',
            'value'=>'tecs_sms_template',
            ];
            $ActionColumn[]=
            [
                'attribute' =>'tecs_aph_id',
                'label'=>'APH',
                'value' => function($data){
                    return @Aph::findOne($data['tecs_aph_id'])->ta_name;
                }, 
            ];
            // $ActionColumn[]=[
            // 'attribute'=>'tecs_aph_id',
            // 'value'=>'tecs_aph_id',
            // ];
        
            
            
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
               'id' => 'ErrCodeSmsmyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Create '.$title,
        'id' => 'ErrCodeSmsmyModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='ErrCodeSmsmodalContent'></div>";
    Modal::end();

    
    
$js=<<<js
    $('.ErrCodeSmsmodalButton').on('click', function () {
        console.log( 'ErrCodeSmsmodalButton.click' );
        $('#ErrCodeSmsmyModal').modal('show')
                .find('#ErrCodeSmsmodalContent')
                .load($(this).attr('value'));
    });
    $('.ErrCodeSmsajaxButton').on('click', function () {
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
                $.pjax.reload({container: '#ErrCodeSmsid_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $(".btn-success").on('click', function(){
            $("#ErrCodeSmsmyModal").on('hide.bs.modal', function(){
        console.log( 'ErrCodeSmsmodalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#ErrCodeSmsid_pjax_id', async: false});  
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


 