<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\helpers\Strings;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$className= StringHelper::basename($generator->modelClass);
try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name(); 
    
    if ($file_no==0) {
        $view_config=$$obj_name['view'];
    } else {
        $view_config=$$obj_name['view'.($file_no+1)];
    }
    
    
    $master_id=$$obj_name['master_id'];
    $master_id_ref=$$obj_name['master_id_ref'];
    $client_id=$$obj_name['client_id'];
    $model2=strpos($$obj_name['mode1'],'model2');
    if ($master_id_ref==""){
        $master_id_class=Strings::getclass($master_id);//"g-customer"
    } else {
        $master_id_class=Strings::getclass($master_id_ref);//"g-customer"
        
    }
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
    echo $ex."\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../../models/".$className."_Config.php".".\n";
}




echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
try {
    
    include(dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php");
    $obj_name="<?=$className?>_config";
    $$obj_name=$obj_name();   

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$title=$<?=$className."_config"?>['name'];
if ($title==null or $title=="") $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   



?>

<?="<?"?> if ($remove_title==null) {
$this->title =  $title ;
<? 
if ($master_id!="") {
    echo "\$this->params['breadcrumbs'][] = ['label' => \"\$title\", 'url' => ['//".$master_id_class."/view','id'=>\$model->".$master_id.($parameter_command==""?"":",".$parameter_command).", 'app_mode'=>\$app_mode]];";
} else {
    echo "\$this->params['breadcrumbs'][] = ['label' => \"\$title\", 'url' => ['index'".($parameter_command==""?"":",".$parameter_command).", 'app_mode'=>\$app_mode]];";
}
?>
    $this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?><?=($parameter_command==""?"":",".$parameter_command)?>, 'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = <?= $generator->generateString('View') ?>;
    \yii\web\YiiAsset::register($this);

}?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    
    <?
       $script1= $view_config['script_1'] ;
       if ($script1!=""){
          echo "<?". $script1."?>";
       }
       
    ?>    
    <?="<?"?> 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model-><?=$generator->getNameAttribute()?>]); 
    }
    ?>
       
    
    <p>
    <?="<?"?>
        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?="<?"?>if ($update_flag and $remove_update===null) {?>
        
        <?="<?= "?>Html::a('Update', ['<?=get_class_dir(StringHelper::basename($generator->modelClass))?>'."/".$update_action,'app_mode'=>$app_mode, <?= $urlParams ?><?=($parameter_command==""?"":",".$parameter_command)?>], ['class' => 'btn btn-primary']) ?>
    <?="<?"?>} else if ($update_flag and $remove_update===2) {?>
        <a class="btn btn-info <?=$className?>modalButton" value="<?="<?="?> Url::to([$update_action,'app_mode'=>$app_mode, <?= $urlParams ?><?=($parameter_command==""?"":",".$parameter_command)?>]) ?>">Update</a>
    <?="<?"?>    }?>
    <?="<?"?>if ($delete_flag and $remove_delete===null) {?>
        <?="<?= "?>Html::a('Delete', ['<?=get_class_dir(StringHelper::basename($generator->modelClass))?>'."/".$delete_action,'app_mode'=>$app_mode, <?= $urlParams ?><?=($parameter_command==""?"":",".$parameter_command)?>], ['class' => 'btn btn-danger']) ?>
    <?="<?"?>} else if ($delete_flag and $remove_delete===2) {?>
        <a class="btn btn-info <?=$className?>ajaxButton" value="<?="<?="?> Url::to([$delete_action,'app_mode'=>$app_mode, <?= $urlParams ?><?=($parameter_command==""?"":",".$parameter_command)?>]) ?>">Delete</a>
    <?="<?"?>    }?>
    <?
        $button= $view_config['button'] ;
        if ($button!=""){
           echo  $button;
        }
    ?>
    
    </p>
    
    <?='<?'?> 
       if ($view_form==null) $view_form='_form';
       echo $this->render($view_form, [
        'model' => $model,
        'mode'=>'view',
        'button1'=>'',
        'button2'=>'{reset} {view} {save}',
        'view_form'=>$view_form2,
        'modal_class'=>$modal_class,
        'app_mode'=>$app_mode
        <?=($parameter_command==""?"":",".$parameter_command)?>
        
    ]) ?>
    
    <?='<?'?>
    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
    <?
       $script2= $view_config['script_2'] ;
       if ($script2!=""){
          echo "<?". $script2."?>";
       }
       
    ?>
    
   
    

</div>

<?='<?'?>
$js=<<<js
    $('.panel-footer').on('click', function () {
        console.log( 'footer_detail.click' );
        $('#footer_detail').toggle();
        
        return false;
        
        
    }); 
   
 
js;
$this->registerJs($js);
?>  
    <?
      $single_client="false";
      $multi_client="false";
      $clients=[];
      if ($client_id!=""){
        $clients=explode(",",$client_id);
        $multi_count=count($clients);
        if ($multi_count==1) {
          $single_client="true";
        } else if ($multi_count>1) {
          $multi_client="true";
        }
      };
    ?>

    <?='<?'?>
        if ($remove_detail!=1) {
                <?
                    if ($single_client=="true"){
                        echo "\$create_flag=false;\$update_flag=false;\$delete_flag=false;\$view_flag=false;\n";
                        echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_id."'.'Controller'.'.create')) {\$create_flag=true;}\n";
                        echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_id."'.'Controller'.'.update')) {\$update_flag=true;}\n";
                        echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_id."'.'Controller'.'.delete')) {\$delete_flag=true;}\n";
                        echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_id."'.'Controller'.'.view')) {\$view_flag=true;}\n";
                        echo "\$searchModel".$ke." = new app\\models\\".$client_id."Search();\n";
                        echo "\$dataProvider".$ke." = \$searchModel".$ke."->search(Yii::\$app->request->queryParams
                            ,\$model->".$generator->getNameAttribute().");\n";
                        echo "echo \$this->render('//".Strings::convertToDir($client_id)."/index', [
                                'searchModel' => \$searchModel".$ke.",
                                'dataProvider' => \$dataProvider".$ke.",
                                'modal_mode'=>".($model2!== false?'2':'1').",
                                'pjax_enable' => 1,
                                'master_id'=>\$model->".$generator->getNameAttribute().",   
                                'create_flag'=>\$create_flag,
                                'update_flag'=>\$update_flag,
                                'delete_flag'=>\$delete_flag,
                                'view_flag'=>\$view_flag,
                                'app_mode'=>\$app_mode,
                                'remove_title'=>1,
                                'remove_create2'=>1,]);\n";
                            
               
                    } else if ($multi_client=="true"){
                        $ke=1;
                        echo "\$items=[];\n";

                        foreach ($clients as &$client_items) {
                            $client_detail=explode(":",$client_items);
                            echo "\$create".$ke."_flag=false;\$update".$ke."_flag=false;\$delete".$ke."_flag=false;\$view".$ke."_flag=false;\n";
                            echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_detail[0]."'.'Controller'.'.create')) {\$create".$ke."_flag=true;}\n";
                            echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_detail[0]."'.'Controller'.'.update')) {\$update".$ke."_flag=true;}\n";
                            echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_detail[0]."'.'Controller'.'.delete')) {\$delete".$ke."_flag=true;}\n";
                            echo "if (Yii::\$app->user->can('app\\\\controllers\\\\'.'".$client_detail[0]."'.'Controller'.'.view')) {\$view".$ke."_flag=true;}\n";

                            echo "\$searchModel".$ke." = new app\\models\\".$client_detail[0]."Search();\n";
                            echo "\$dataProvider".$ke." = \$searchModel".$ke."->search(Yii::\$app->request->queryParams
                                ,\$model->".$generator->getNameAttribute().");\n";
                            echo "\$content".$ke."=\$this->render('//".Strings::convertToDir($client_detail[0])."/index', [
                                    'searchModel' => \$searchModel".$ke.",
                                    'dataProvider' => \$dataProvider".$ke.",
                                    'modal_mode'=>".($model2!== false?'2':'1').",
                                    'pjax_enable' => 1,
                                    'master_id'=>\$model->".$generator->getNameAttribute().",   
                                    'remove_title'=>1,
                                    'create_flag'=>\$create".$ke."_flag,
                                    'update_flag'=>\$update".$ke."_flag,
                                    'delete_flag'=>\$delete".$ke."_flag,
                                    'view_flag'=>\$view".$ke."_flag,
                                    'app_mode'=>\$app_mode,
                                    'remove_create2'=>1,]);\n";
                            echo "\$items[]=[
                                        'label' => '<i class=\"fas fa-home\"></i> ".$client_detail[1]."',
                                        'content' => \$content".$ke.",
                                        'active' => ".($client_detail[2]=="true"?"true":"false").",
                                    ];\n";
                            $ke++;


                        }
                    
                        echo "echo kartik\\tabs\\TabsX::widget([
                            'items' => \$items,
                            'position' => kartik\\tabs\\TabsX::POS_ABOVE,
                            'height' => kartik\\tabs\\TabsX::SIZE_LARGE,
                            'bordered' => true,
                            'encodeLabels' => false,
                            'pluginOptions' => ['enableCache' => 'false'],
                        ]);";
                    }
                    
                ?>
            
            
        }
        
    
    ?>