

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Aph;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
try {
    
    include(dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php");
    $obj_name="MdnWhitelist_config";
    $$obj_name=$obj_name();    
    
    
        

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/MdnWhitelist_Config.php".".\n";
}




use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MdnWhitelistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['app\models\MdnWhitelist']['name'];
//if ($title==null) $title='Mdn Whitelist';   
 
$title=$MdnWhitelist_config['name'];
if ($title==null or $title=="") $title='Mdn Whitelist';   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
$content = $this->render("//g-sensor-alarm/_show_all", []);if ($content != "") {Yii::$app->session->setFlash("error", $content);}?>


<div class="mdn-whitelist-index">

    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
            
    
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'MdnWhitelistid_pjax_id']); 
    }
    ?>
    
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a('Create '.$title, ['//mdn-whitelist/create','app_mode'=>$app_mode], ['class' => 'btn btn-success']) ?>   
        <?= Html::a('Create Bulk Mdn Whitelist', ['#','app_mode'=>$app_mode], ['class' => 'btn btn-primary','onclick'=>'upload();return false;']) ?>   
        <?= Html::a('Remove Bulk Mdn Whitelist', ['#','app_mode'=>$app_mode], ['class' => 'btn btn-primary','onclick'=>'uploadremove();return false;']) ?>  
    </p>

        
    
        
        <?         //$modal_mode=1;
                $GLOBALS['app_mode']=$app_mode;
        $ActionColumn=[];
        $ActionColumn[]=['class' => 'kartik\grid\SerialColumn'];
        
        if ($modal_mode==2) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//mdn-whitelist/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'MdnWhitelistmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//mdn-whitelist/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", ['//mdn-whitelist/delete','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]);
                            return $btn;
                        }
                    ];
        } else if ($modal_mode) {
                    $buttons = [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//mdn-whitelist/update-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'MdnWhitelistmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;},                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//mdn-whitelist/view-only','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'MdnWhitelistmodalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//mdn-whitelist/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'MdnWhitelistajaxButton grid-action',
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
                                        '//mdn-whitelist/update','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//mdn-whitelist/view','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash' style='color:#3c8dbc'></span>", [
                                        'value' => Url::to(['//mdn-whitelist/delete-ajax','app_mode'=>$GLOBALS['app_mode'], 'id' => $model->tmw_id]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'MdnWhitelistajaxButton grid-action',
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
            
            $ActionColumn[]=
            [
                'attribute' =>'tmw_aph_id',
                'value' => function($data){
                    return @Aph::findOne($data['tmw_aph_id'])->ta_name;
                }, 
            ];
            $ActionColumn[]=[
            'attribute'=>'tmw_name',
            'value'=>'tmw_name',
            ];
            $ActionColumn[]=[
            'attribute'=>'tmw_mdn',
            'value'=>'tmw_mdn',
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
               'id' => 'MdnWhitelistmyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Create '.$title,
        'id' => 'MdnWhitelistmyModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='MdnWhitelistmodalContent'></div>";
    Modal::end();

    Modal::begin([
        'options' => [ 
               'id' => 'Uploadbulk', 
               'tabindex' => false  
           ], 
        'header' => 'Create Bulk '.$title,
        'id' => 'Uploadbulk',
        'size' => 'modal-md',
    ]);


    $form = ActiveForm::begin([
        'action' => ['upload'],
        'options' => [
            'enctype'=>'multipart/form-data'
        ],
    ]);

     echo $form->field($searchModel, 'file')->widget(FileInput::classname(), [
              // 'options' => ['accept' => 'doc/*'],
               'pluginOptions' => [
                    'width'=> '90%',
                    'allowedFileExtensions'=>['txt'],
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showCancel' => false,
                    'showUpload' => false,
                ]
          ]);  
    echo "*Format : APH|NAME|MDN";

    echo "<br><div class='form-group'>";
        echo Html::submitButton('Upload', ['class' => 'btn btn-primary']);
    echo "</div>";

    ActiveForm::end();

    Modal::end();

    Modal::begin([
        'options' => [ 
               'id' => 'Uploadbulkremove', 
               'tabindex' => false  
           ], 
        'header' => 'Remove Bulk '.$title,
        'id' => 'Uploadbulkremove',
        'size' => 'modal-md',
    ]);


    $form = ActiveForm::begin([
        'action' => ['remove'],
        'options' => [
            'enctype'=>'multipart/form-data'
        ],
    ]);

     echo $form->field($searchModel, 'remove_file')->widget(FileInput::classname(), [
              // 'options' => ['accept' => 'doc/*'],
               'pluginOptions' => [
                    'width'=> '90%',
                    'allowedFileExtensions'=>['txt'],
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showCancel' => false,
                    'showUpload' => false,
                ]
          ]);  
    echo "*Format : APH|NAME|MDN";

    echo "<br><div class='form-group'>";
        echo Html::submitButton('Upload', ['class' => 'btn btn-primary']);
    echo "</div>";

    ActiveForm::end();

    Modal::end();
    
    
$js=<<<js
    $('.MdnWhitelistmodalButton').on('click', function () {
        console.log( 'MdnWhitelistmodalButton.click' );
        $('#MdnWhitelistmyModal').modal('show')
                .find('#MdnWhitelistmodalContent')
                .load($(this).attr('value'));
    });

    $('.MdnWhitelistajaxButton').on('click', function () {
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
                $.pjax.reload({container: '#MdnWhitelistid_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $(".btn-success").on('click', function(){
            $("#MdnWhitelistmyModal").on('hide.bs.modal', function(){
        console.log( 'MdnWhitelistmodalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#MdnWhitelistid_pjax_id', async: false});  
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
    <script type="text/javascript">
        function upload() {
            $('#Uploadbulk').modal('show')
                // .find('#MdnWhitelistmodalContent')
                // .load($(this).attr('value'));
        }
        function uploadremove() {
            $('#Uploadbulkremove').modal('show')
                // .find('#MdnWhitelistmodalContent')
                // .load($(this).attr('value'));
        }
    </script>
    
        
    
    
</div>


 