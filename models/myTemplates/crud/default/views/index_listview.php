

<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\helpers\Strings;





/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$primary_key=$generator->getNameAttribute();
$className= StringHelper::basename($generator->modelClass);
try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();  
    $master_id=$$obj_name['master_id'];
    $parameter_var=$$obj_name['parameter'];
    $split_array = explode(",", $parameter_var);
    $no=0;
    $parameter="";
    $parameter_command="";
    
    $parameter_command2="";
    $parameter_command3="";
    if ($parameter_var!="" and count($split_array)>0) {
        foreach ($split_array as $split_str) {
            if ($no==0) {
                $param="";
            } else {
                $param=",";
            }
            $parameter=$parameter.$param.'$'.$split_str;
            $parameter_command=$parameter_command.$param."'".$split_str."'=>$".$split_str;
            $parameter_command2=$parameter_command2.'$GLOBALS[\''.$split_str.'\']=$'.$split_str.';';
            $parameter_command3=$parameter_command3.$param.'\''.$split_str.'\'=>$GLOBALS[\''.$split_str.'\']';


            $no++;

        }
    }
    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../../models/".$className."_Config.php".".\n";
}




echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use  yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;


try {
    
    include(dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php");
    $obj_name="<?=$className?>_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".  dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php".".\n";
}


<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */


//$title=Yii::$app->params['bootstrap']['<?=$generator->modelClass?>']['name'];
//if ($title==null) $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   

$title=$<?=$className."_config"?>['name'];
if ($title==null or $title=="") $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   
if ($remove_title==null) {

    $this->title = $title;
    $this->params['breadcrumbs'][] = $this->title;
}
?>

<?
    $camel2id_modelClass=Strings::convertToDir(StringHelper::basename($generator->modelClass));
    
            

?>


<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
    <?="<?"?> 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'<?=$className?>id_pjax_id']); 
    }
    ?>
    
    <?php if (!empty($generator->searchModelClass)): ?>
        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php endif; ?>

    <p>
        <?="<?"?> if ($remove_create1) {echo "<!--";}?><a class="btn btn-info <?=$className?>modalButton" value="<?="<?="?> Url::to(['//<?=$camel2id_modelClass?>/create-ajax'<?=$master_id!=""?",'master_id'=>\$master_id":""?><?=($parameter_command==""?"":",".$parameter_command)?>]) ?>">Create <?="<?="?>$title?></a>
        <?="<?"?> if ($remove_create1) {echo "-->";}?>
        <?="<?"?> if ($remove_create2) {echo "<!--";}?><?= "<?= " ?>Html::a(<?= "'Create '.\$title" ?>, ['create2'<?=$master_id!=""?",'master_id'=>\$master_id":""?><?=($parameter_command==""?"":",".$parameter_command)?>], ['class' => 'btn btn-success']) ?>
        <?="<?"?> if ($remove_create2) {echo "-->";}?>
        
        <?="<!--['create3','t_transaksi_tt_id'=>'1','f_rekam_medis_type_frmt_id'=>'1']-->"?>
    </p>

        <?= "<? " ?> 
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
            <?=$parameter_command2?>
        
            
                ?>
    
        <?= "<?= " ?>ListView::widget([
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
                    'modal_class'=>$GLOBALS['modal_class']
                    <?=($parameter_command3==""?"":",".$parameter_command3)?>
                    
                
                        ]);
                return $content2;
        
        
        },
        ]) ?>
    
<?="<?"?> 
    
    Modal::begin([
        'options' => [ 
               'id' => '<?=$className?>myModal', 
               'tabindex' => false
           ], 
        'header' => 'Modal',
        'id' => '<?=$className?>myModal',
        'size' => 'modal-md',
    ]);
    echo "<div id='<?=$className?>modalContent'></div>";
    Modal::end();

    
    
$js=<<<js
    $('.<?=$className?>modalButton').on('click', function () {
        console.log( '<?=$className?>modalButton.click' );
        $('#<?=$className?>myModal').modal('show')
                .find('#<?=$className?>modalContent')
                .load($(this).attr('value'));
    });
    $('.<?=$className?>ajaxButton').on('click', function () {
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
                $.pjax.reload({container: '#<?=$className?>id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    });  
    $("#<?=$className?>myModal").on('hide.bs.modal', function(){
        console.log( 'modalButton.close' );
        try {        
            console.log( 'pjax_enable.reload' );
            $.pjax.reload({container: '#<?=$className?>id_pjax_id', async: false}); 
            console.log( 'pjax_enable.reload done' );
            
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
        
        
    });
js;
$this->registerJs($js);
?>    
    <?='<?'?>
    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
</div>

