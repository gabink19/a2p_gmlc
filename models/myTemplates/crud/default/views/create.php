<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\helpers\Strings;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$className= StringHelper::basename($generator->modelClass);
try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();   
    $master_id=$$obj_name['master_id'];
    $master_id_ref=$$obj_name['master_id_ref'];
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
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../../models/".$className."_Config.php".".\n";
}


echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\Pjax; 
try {
    
    include(dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php");
    $obj_name="<?=$className?>_config";
    $$obj_name=$obj_name(); 
    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

//$title=Yii::$app->params['bootstrap']['<?=$generator->modelClass?>']['name'];
//if ($title==null) $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   
 
$title=$<?=$className."_config"?>['name'];
if ($title==null or $title=="") $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   


if ($remove_title==null) {
    $this->title =  $title ;
    <? 
    if ($master_id!="") {
        echo "\$this->params['breadcrumbs'][] = ['label' => \"\$title\", 'url' => ['//".$master_id_class."/view','id'=>\$master_id".($parameter_command==""?"":",".$parameter_command).",'app_mode'=>\$app_mode]];";
    } else {
        echo "\$this->params['breadcrumbs'][] = ['label' => \"\$title\", 'url' => ['index'".($parameter_command==""?"":",".$parameter_command).",'app_mode'=>\$app_mode]];";
    }
    ?>

    //$this->params['breadcrumbs'][] = ['label' => <?="\$title" ?>, 'url' => ['index',<?=$master_id!=""?"'master_id'=>\$master_id,":""?>'app_mode'=>$app_mode]];
    $this->params['breadcrumbs'][] = $this->title;

}
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <?= "<? "?>
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model-><?=$generator->getNameAttribute()?>]); 
    }
    if ($view_form==null) $view_form='_form';
    ?>
    
    <?= "<?= " ?>$this->render($view_form, [
        'model' => $model,
        'mode'=>'edit',
        'button1'=>'{delete}',
        'button2'=>'{save} {reset}',
        'view_form'=>$view_form2,
        'modal_class'=>$modal_class,
        'master_id'=>$master_id,
        'app_mode'=>$app_mode
        <?=($parameter_command==""?"":",".$parameter_command)?>
    ]) ?>
    
     <?= "<? "?> 
    if ($pjax_enable) {
        Pjax::end();
    }?>

</div>
