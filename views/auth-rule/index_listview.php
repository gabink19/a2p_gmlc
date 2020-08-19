

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use  yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;


try {
    
    include(dirname(__FILE__) .    "/../../models/AuthRule_Config.php");
    $obj_name="AuthRule_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".  dirname(__FILE__) .    "/../../models/AuthRule_Config.php".".\n";
}



/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


//$title=Yii::$app->params['bootstrap']['app\models\AuthRule']['name'];
//if ($title==null) $title='Auth Rule';   

$title=$AuthRule_config['name'];
if ($title==null or $title=="") $title='Auth Rule';   

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="auth-rule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_id']); 
    }
    ?>
    
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <? if ($remove_create1) {echo "<!--";}?><a class="btn btn-info modalButton" value="<?= Url::to(['//auth-rule/create-ajax',]) ?>">Create <?=$title?></a>
        <? if ($remove_create1) {echo "-->";}?>
        <? if ($remove_create2) {echo "<!--";}?><?= Html::a('Create '.$title, ['create',], ['class' => 'btn btn-success']) ?>
        <? if ($remove_create2) {echo "-->";}?>
        
        <!--['create3','t_transaksi_tt_id'=>'1','f_rekam_medis_type_frmt_id'=>'1']-->    </p>

        <?  
            if ($pjax_enable2===null) $pjax_enable2=1;
            if ($update_action===null) $update_action='update2';
            if ($delete_action===null) $delete_action='delete2';
            
            $GLOBALS['view_form']=$view_form;
            $GLOBALS['view_form2']=$view_form2;
            $GLOBALS['pjax_enable2']=$pjax_enable2;
            $GLOBALS['remove_delete']=$remove_delete;
            $GLOBALS['remove_update']=$remove_update;
            $GLOBALS['modal_class']=$modal_class;
            $GLOBALS['update_action']=$update_action;
            $GLOBALS['delete_action']=$delete_action;
            
            
                ?>
    
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
                $content2 = $this->render('view', [
                    'model' => $model,
                    'pjax_enable' => $GLOBALS['pjax_enable2'],
                    'view_form' => $GLOBALS['view_form'],
                    'view_form2' => $GLOBALS['view_form2'],
                    'remove_title'=> 1,
                    'update_action'=>$GLOBALS['update_action'],
                    'delete_action'=>$GLOBALS['delete_action'],
                    'remove_delete'=>$GLOBALS['remove_delete'],
                    'remove_update'=>$GLOBALS['remove_update'],
                    'modal_class'=>$GLOBALS['modal_class'],
                    
                
                        ]);
                return $content2;
        
        
        },
        ]) ?>
    
<? 
    
    Modal::begin([
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
    $('.modalButton').on('click', function () {
        console.log( 'modalButton.click' );
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
                alert('deleted');
                $.pjax.reload({container: '#id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    });  
    $("#myModal").on('hide.bs.modal', function(){
        console.log( 'modalButton.close' );
        try {        
            console.log( 'pjax_enable.reload' );
            $.pjax.reload({container: '#id_pjax_id', async: false}); 
            console.log( 'pjax_enable.reload done' );
            
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

