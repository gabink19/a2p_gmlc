

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;


try {
    
    include(dirname(__FILE__) .    "/../../models/AuthItem2_Config.php");
    $obj_name="AuthItem2_config";
    $$obj_name=$obj_name();    

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthItem2_Config.php".".\n";
}




use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItem2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['app\models\AuthItem2']['name'];
//if ($title==null) $title='Auth Item2';   
 
$title=$AuthItem2_config['name'];
if ($title==null or $title=="") $title='Auth Item2';   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
$content = $this->render("//g-sensor-alarm/_show_all", []);if ($content != "") {Yii::$app->session->setFlash("error", $content);}?>

<div class="auth-item2-index">

    <h1><? if ($remove_title===null) echo Html::encode($this->title); ?></h1>
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'AuthItem2id_pjax_id']); 
    }
    ?>
    
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <? if ($remove_create1) {echo "<!--";}?><a class="btn btn-info AuthItem2modalButton" value="<?= Url::to(['//auth-item2/create-ajax',]) ?>">Create <?=$title?></a>
        <? if ($remove_create1) {echo "-->";}?>
        <? if ($remove_create2) {echo "<!--";}?><?= Html::a('Create '.$title, ['create',], ['class' => 'btn btn-success']) ?>
        <? if ($remove_create2) {echo "-->";}?>
        <!--['create2','t_transaksi_tt_id'=>'1','f_rekam_medis_type_frmt_id'=>'1']-->    </p>

        
    
    
        <?         //$modal_mode=1;
        
        if ($modal_mode==2) {
                $ActionColumn=['class' => 'kartik\grid\ActionColumn',
                    'options' => ['class' => 'action-column'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//auth-item2/update-ajax', 'id' => $model->name]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthItem2modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//auth-item2/view', 'id' => $model->name]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//auth-item2/delete', 'id' => $model->name]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ajaxButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Delete'
                            ]);
                            return $btn;
                        }
                    ]];
        } else if ($modal_mode) {
            $ActionColumn=['class' => 'kartik\grid\ActionColumn',
                    'options' => ['class' => 'action-column'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'update' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>", [
                                        'value' => Url::to(['//auth-item2/update-ajax', 'id' => $model->name]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthItem2modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//auth-item2/view-only', 'id' => $model->name]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'AuthItem2modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//auth-item2/delete-ajax', 'id' => $model->name]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => 'ajaxButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Delete'
                            ]);
                            return $btn;
                        }
                    ]];
                    
            } else {
                $ActionColumn=['class' => 'kartik\grid\ActionColumn',];
            }    
                    
            
    
    echo GridView::widget([
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        
        'dataProvider' => $dataProvider,
        'responsiveWrap'=>false,
        /*
        'pjax'=>true,
        'toolbar' =>  [
        [
            'content' =>
                Html::button('<i class="fas fa-plus"></i>', [
                    'class' => 'btn btn-success',
                    'title' =>  'Add Book',
                    'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
                ]) . ' '.
                Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                    'class' => 'btn btn-outline-secondary',
                   'title'=> 'Reset Grid',
                    'data-pjax' => 0, 
                ]), 
            'options' => ['class' => 'btn-group mr-2']
            ],
            '{export}',
            '{toggleData}',
        ],*/
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        $ActionColumn,
                    [
            'attribute'=>'name',
            'value'=>'name',
            ],
            [
            'attribute'=>'description',
            'value'=>'description',
            ],
        
        ],
        ]); 
        
        ?>
        
     <?    Modal::begin([
        'options' => [ 
               'id' => 'myModal', 
               'tabindex' => false  
           ], 
        'header' => 'Modal',
        'id' => 'myModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

    
    
$js=<<<js
    $('.AuthItem2modalButton').on('click', function () {
        console.log( 'AuthItem2modalButton.click' );
        $('#myModal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    $('.ajaxButton').on('click', function () {
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
                $.pjax.reload({container: '#AuthItem2id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $("#myModal").on('hide.bs.modal', function(){
        console.log( 'AuthItem2modalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#AuthItem2id_pjax_id', async: false});  
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


 