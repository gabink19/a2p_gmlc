

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;


try {
    
    include(dirname(__FILE__) .    "/../../models/AuthLogin_Config.php");
    $obj_name="AuthLogin_config";
    $$obj_name=$obj_name();    
    
    
        

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthLogin_Config.php".".\n";
}




use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthLoginSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['app\models\AuthLogin']['name'];
//if ($title==null) $title='Auth Login';   
 
$title=$AuthLogin_config['name'];
if ($title==null or $title=="") $title='Auth Login';   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
// $content = $this->render("//g-sensor-alarm/_show_all", []);if ($content != "") {Yii::$app->session->setFlash("error", $content);}
?>


<div class="auth-login-index">

    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
    
        
    
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'AuthLoginid_pjax_id']); 
    }
    ?>
    
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <? if (!$create_flag or $remove_create1) {echo "<!--";}?><a class="btn btn-info AuthLoginmodalButton" value="<?= Url::to(['//auth-login/create-ajax','app_mode'=>$app_mode]) ?>">Create <?=$title?></a>
        <? if (!$create_flag or $remove_create1) {echo "-->";}?>
        <? if (!$create_flag or $remove_create2) {echo "<!--";}?><?= Html::a('Create '.$title, ['//auth-login/signup','app_mode'=>$app_mode], ['class' => 'btn btn-success']) ?>
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
                                        'value' => Url::to(['//auth-login/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthLoginmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//auth-login/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", ['//auth-login/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]);
                            return $btn;
                        }
                    ];
        } else if ($modal_mode) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//auth-login/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthLoginmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//auth-login/view-only','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthLoginmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//auth-login/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthLoginajaxButton grid-action',
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
                                        '//auth-login/update','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//auth-login/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]);
                            return $btn;
                        },
                        // 'delete' => function($url, $model, $key) {
                        //     $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", [
                        //             '//auth-login/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]);            
                            
                        //     return $btn;
                        // },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash' style='color:#3c8dbc'></span>", [
                                        'value' => Url::to(['//auth-login/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->user_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthLoginajaxButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Delete'
                            ]);
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
            
                //$ActionColumn[]=[
            //'attribute'=>'tl_user_status_ref',
            //'format'=>'raw',
            //'value'=>'tlUserStatusRefStr',
            //'filter'=>Yii::$app->params['userStatus'],
            //];
            $ActionColumn[]=[
            'attribute'=>'tl_username',
            'value'=>'tl_username',
            ];
//             $ActionColumn[]=[
//             'attribute'=>'g_customer_gc_id',
// //             'attribute'=>'gcustomergcgc_name',
//             'value'=>'gCustomerGc.gc_name',
// //             'attribute'=>'gcustomergcgc_name',
//             'filter'=>ArrayHelper::map(app\models\GCustomer::find()->all(), 'gc_id', 'gc_name'),
//             ];
            //$ActionColumn[]=[
            //'attribute'=>'tl_phone_number',
            //'value'=>'tl_phone_number',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tl_email',
            //'value'=>'tl_email',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tl_address',
            //'value'=>'tl_address',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tl_address2',
            //'value'=>'tl_address2',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tl_city',
            //'value'=>'tl_city',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tl_country',
            //'value'=>'tl_country',
            //];
            //$ActionColumn[]=[
            //'attribute'=>'tlaccountexpirestr',
            //'value'=>'tlAccountExpireStr',
            //];
            // $ActionColumn[]=[
            // 'attribute'=>'tlpasswordexpirestr',
            // 'value'=>'tlPasswordExpireStr',
            // ];
            //$ActionColumn[]=[
            //'attribute'=>'tl_change_pasword_duration',
            //'value'=>'tl_change_pasword_duration',
            //];
        
            
            
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
               'id' => 'AuthLoginmyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Modal',
        'id' => 'AuthLoginmyModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='AuthLoginmodalContent'></div>";
    Modal::end();

    
    
$js=<<<js
    $('.AuthLoginmodalButton').on('click', function () {
        console.log( 'AuthLoginmodalButton.click' );
        $('#AuthLoginmyModal').modal('show')
                .find('#AuthLoginmodalContent')
                .load($(this).attr('value'));
    });
    $('.AuthLoginajaxButton').on('click', function () {
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
                alert('deleted');
                $.pjax.reload({container: '#AuthLoginid_pjax_id', async: false});
            }

        })
        .fail(function() {
            // alert("fail");
            $.pjax.reload({container: '#AuthLoginid_pjax_id', async: false});

        });
        return false;
        
        
    }); 
    $("#AuthLoginmyModal").on('hide.bs.modal', function(){
        console.log( 'AuthLoginmodalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#AuthLoginid_pjax_id', async: false});  
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
 
js;
$this->registerJs($js);
?>       
<?    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
    
    
        
    
    
</div>


 