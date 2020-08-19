<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\db\Schema;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

try {
    
    $className= StringHelper::basename($generator->modelClass);
    $lower_className=strtolower($className);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();  
    $master_id=$$obj_name['master_id'];
    $parameter_var=$$obj_name['parameter'];
    $DetailView_count=$$obj_name['DetailView_count'];
    if ($DetailView_count<=$file_no){
        return;
    }
    
    
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
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

if ($mode==="view"){
    $displayOnlyFlag=true;
} else {
    $displayOnlyFlag=false;
}
$escape = new JsExpression("function(m) { return m; }");


?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

    <? $primary_key=$generator->getNameAttribute() ?>

    
<?php
if(!function_exists("endsWith")) {

    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}

if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "            '" . $name . "',\n";
    }
} else {
    $bootstrap = Yii::$app->params['bootstrap'][$generator->modelClass]['DetailView'];
    $counter = 0;

    //foreach ($generator->getTableSchema()->columns as $column) {
    if ($$obj_name!=null) {
        echo "<?";
        echo "\$attributes=[];\n";
        
        foreach ($$obj_name['dataLabel'] as $key => $val){ 
            if  ($val['disable']=="1") continue;
        
            $columnname=$key;
            //$format = $generator->generateColumnFormat($column);
            //if ($columnname!=$master_id) {   
            
            $display=$val['display'];
            if ($display==null || $display==0){
                $display_array=explode(",",$val['DetailView_display']);
                $display=$display_array[$file_no];
            }
            

            $js_script=($val['DetailView_js'.$file_no]===null?"":$val['DetailView_js'.$file_no]);

            if ($display==1) {
                //echo "modal:".$columnname.";display:".$val['display'];
                switch ($columnname) {
                    /*case $primary_key: break;
                    case "first_user": break;
                    case "first_ip": break;
                    case "first_update": break;
                    case "last_user": break;
                    case "last_ip": break;
                    case "last_update": break;*/
                    default:
                        //$bootstrap_param=$bootstrap[$counter];
                        if ($file_no==0) {
                            $bootstrap_param=$val['DetailView'];
                        } else {
                            $bootstrap_param=$val['DetailView'.$file_no];

                        }

                        if ($bootstrap_param[0]=='*') {
                            $token=substr(strtok($bootstrap_param, "|"),1);
                            echo "\$attributes[]=[
                                    'group'=>true,
                                    'label'=>'".$token."',
                                    'rowOptions'=>['class'=>'table-info']
                                ];";
                            $bootstrap_param=strstr($bootstrap_param,"|");
                        }
                        if ($bootstrap_param[0]=='|') {
                            //echo "['columns' => [";
                            echo "\$attributes2=\$attributes;\n";
                            echo "\$attributes=[];\n";
                            
                        }
                        $size=str_replace('|', '',$bootstrap_param );
                        $size_str="";

                        switch ($size) {
                            case '1' :
                            case '2' :
                            case '3' :
                            case '4' :
                            case '5' :
                            case '6' :
                            case '7' :
                            case '8' :
                            case '9' :
                            case '10' :
                            case '11' :
                            case '12' :
                                $size_str=$size_str.",'labelColOptions'=>['style'=>'width:".round(20*$size/12)."%'],'valueColOptions'=>['style'=>'width:".round(80*$size/12)."%']";
                                break;




                        }
                        //$label_value=$val['value'];
                        $field_type=$val['field_type'];
                        $field_type_ext_data=$val['field_type_ext_data'];
                        
                        
                        //if ($label_value!=null and $label_value!=""){
                        //    echo "\$attributes[]=['attribute' =>'" . $columnname ."','format' => 'raw','displayOnly'=>true,'value'=>'<span id=\"".$lower_className."-".$columnname."\">'.".$label_value.".'</span>'".
                        //                $size_str."];\n";

                        //} else {
                            
                        $plug_in=Yii::$app->params['plugin_datatype'][$columnname];
                        if ($plug_in != null) {
                            require(Yii::$app->basePath . '/myTemplates/plugin/'.$plug_in['name'].'_form.php');

                        } else if (($field_type=='extend') )   {
                            $ref_table="";
                            $ref_table2="";
                            $split_array=explode("_",$columnname);
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){

                                    if ($no==0) {
                                        $ref_table=$ref_table.$split_str;
                                        $ref_table2=$ref_table2.ucfirst($split_str);
                                    } else {
                                        $ref_table=$ref_table.ucfirst($split_str);
                                        $ref_table2=$ref_table2.ucfirst($split_str);
                                    }
                                 $no=$no+1;

                            }
                            echo "if (\$model->get".$ref_table2."Title()!=null){";
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'format' => 'raw',
                                    'value' => \$model->".$ref_table."Str"."
                                   ".$size_str."
                                   ];};\n";
                            
                        } else if (($field_type=='f-extend') )   {
                            $ref_table="";
                            $ref_table2="";
                            $split_array=explode("_",$columnname);
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){

                                    if ($no==0) {
                                        $ref_table=$ref_table.$split_str;
                                        $ref_table2=$ref_table2.ucfirst($split_str);
                                    } else {
                                        $ref_table=$ref_table.ucfirst($split_str);
                                        $ref_table2=$ref_table2.ucfirst($split_str);
                                    }
                                 $no=$no+1;

                            }
                            echo "if (\$model->get".$ref_table2."TitleFixed()!=null){";
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'format' => 'raw',
                                    'value' => \$model->".$ref_table."Str"."
                                   ".$size_str."
                                   ];};\n";
                            
                        } else if (($field_type=='date') or ($field_type=='datetime') or ($field_type=='time')or ($field_type=='boolean') )   {
                            $ref_table="";
                            $split_array=explode("_",$columnname);
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){

                                    if ($no==0) {
                                        $ref_table=$ref_table.$split_str;

                                    } else {
                                        $ref_table=$ref_table.ucfirst($split_str);
                                    }
                                 $no=$no+1;

                            }
                            if (($field_type=='date') ) {
                                echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'value' => \$model->".$ref_table."Str".",
                                   'options' => [".$js_script."],
                                    'type' => DetailView::INPUT_DATE,
                                   'widgetOptions' => [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd'
                                                ],
                                    ]".$size_str."
                                   ];\n";
                            } else if (($field_type=='datetime') ) {
                                echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'value' => \$model->".$ref_table."Str".",
                                   'type' => DetailView::INPUT_DATETIME,
                                   'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd hh:ii:ss'
                                                ],
                                        ]
                                        ".$size_str."
                                   ];\n";
                            } else if (($field_type=='boolean') )   {
                                echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'value' => \$model->".$ref_table."Str2".",
                                   'options' => [".$js_script."],
                                    'type' => DetailView::INPUT_WIDGET,
                                   'widgetOptions' => [
                                        'class' => '\kartik\switchinput\SwitchInput',

                                    ]".$size_str."
                                   ];\n";
                            } else if (($field_type=='time') ) {
                                echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'value' => \$model->".$ref_table."Str".",
                                   'type' => DetailView::INPUT_WIDGET,
                                   'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'class' => 'kartik\widgets\TimePicker',
                                        'pluginOptions' => [
                                            'showSeconds' => true,
                                            'showMeridian' => false,
                                           ],
                                    ]".$size_str."
                                   ];\n";
                            }


                        //} else if ($column->type==Schema::TYPE_BOOLEAN){
                        } else if (($field_type=='money') )   {
                            //require_once(Yii::$app->basePath . '/myTemplates/plugin/form_money.php');
                            $ref_table="";
                            $split_array=explode("_",$columnname);
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){

                                    if ($no==0) {
                                        $ref_table=$ref_table.$split_str;

                                    } else {
                                        $ref_table=$ref_table.ucfirst($split_str);
                                    }
                                 $no=$no+1;

                            }
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'value' => \$model->".$ref_table."Str".",
                                   'type' => DetailView::INPUT_WIDGET,
                                   'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'class' => 'kartik\\number\\NumberControl',

                                    ]".$size_str."
                                   ];\n"; 

                        } else if (($field_type=='notes') )   {
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'format' => 'raw',
                                    'type' => DetailView::INPUT_TEXTAREA,
                                   'options' => ['rows' => 4,".$js_script."]".$size_str."
                                   ];\n";

                        } else if (($field_type=='email') )   {
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'type' => DetailView::INPUT_WIDGET,
                                   'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'class' => 'yii\widgets\MaskedInput',
                                        'clientOptions' => [
                                            'alias' => 'email'
                                                ],
                                    ]".$size_str."
                                   ];\n";

                        } else if (($field_type=='number') )   {
                            echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'type' => DetailView::INPUT_WIDGET,
                                    'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'class' => 'kartik\\number\\NumberControl',
                                        'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false],

                                    ]".$size_str."
                                   ];\n";


                        } else if (($field_type=='ref') )   {

                            $ref_table="";
                            $ref_param="";

                            if ($field_type_ext_data === "") {
                                $split_array=explode("_",$columnname);
                            } else {
                                $split_array = explode("_", $field_type_ext_data);

                            }
                            $no=0;
                            $max_no=count($split_array);
                            foreach($split_array as $split_str){

                                    if ($no==0) {
                                        $ref_table=$ref_table.$split_str;

                                    } else {
                                        $ref_table=$ref_table.ucfirst($split_str);
                                    }
                                    if ($no!=0 and $no!=($max_no-1)) {
                                        if ($no==1) {
                                            $ref_param=$ref_param.$split_str;
                                        } else {
                                            $ref_param=$ref_param.ucfirst($split_str);

                                        }
                                    }
                                $no=$no+1;

                            }

                           echo "\$attributes[]=['attribute' =>'" . $columnname ."',
                                   'displayOnly'=>\$displayOnlyFlag,
                                   'type' => DetailView::INPUT_SELECT2,
                                   'format'=>'raw',
                                   'value' => \$model->".$ref_table."Str".",
                                    'options' => [".$js_script."],
                                    'widgetOptions' => [
                                        'hideSearch' => true,
                                        'data' => Yii::\$app->params['".$ref_param."'],
                                        'options' => ['placeholder' => 'select ".$ref_param."'],
                                        'pluginOptions' => [
                                            'escapeMarkup' => \$escape,
                                            'allowClear' => true
                                        ],
                                    ]".$size_str."
                                   ];\n";

                        } else 
                        if (($field_type=='id') )   {

                            require(Yii::$app->basePath . '/myTemplates/plugin/id_form.php');

                        } else {

                                echo "\$attributes[]=['attribute' =>'" . $columnname ."',"
                                        ."'format' => 'raw',"
                                        ."'options' => [".$js_script."]".$size_str
                                        . "];\n";

                        }
                        //}
                        if ($bootstrap_param[strlen($bootstrap_param)-1]=='|') {
                            //echo "],],";
                            echo "\$attributes2[]=['columns'=>\$attributes];\n";
                            echo "\$attributes=\$attributes2;\n";
                        }
                        $counter++;
                        
                }
            }
        }
        
        
        
    }
}
?>
?>
    
    
<?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'bordered'=>false,
        'hover' => true,
        'mode' => $mode,
        'buttons1' => $button1,
        'buttons2' => $button2,
        'container' => ['id'=>'kv-demo'],
                'panel' => [
            'heading' => $this->title.' # ' . $model-><?= $primary_key ?>,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div id="footer_detail" class="text-center text-muted" style="display: none;"><small>create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                        $model->last_user."/".$model->last_ip."/".$model->last_update.'</small></div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model-><?= $primary_key ?><?=($parameter_command==""?"":",".$parameter_command)?>],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?="<?"?>
$js=<<<js
    <?=$javascript_var?>
    
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
<?
    if ($$obj_name!=null) {
    
        $js=$$obj_name['js'];
        if ($js!=null or $js!="") {
            echo "<?\$this->registerJsFile('".$js."');?>";
        };
        $css=$$obj_name['css'];
        if ($css!=null or $css!="") {
            echo "<?\$this->registerCssFile('".$css."');?>";
        };
        
        
    }
?>