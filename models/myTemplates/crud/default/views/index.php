

<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\models\functions;
use app\helpers\Strings;



try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();  
    $master_id=$$obj_name['master_id'];
    $parameter_var=$$obj_name['parameter'];
    $option_flag=$$obj_name['option_flag'];
    if ($file_no==0) {
        $index_config=$$obj_name['index'];
        $file_no_import=null;
    } else {
        $index_config=$$obj_name['index_'.($file_no+1)];
        $file_no_import=$file_no+1;
    }
    $index_count=$$obj_name['Index_count'];
    if ($index_count<=$file_no){
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

unset($html,$excel,$excel_x,$pdf,$text,$csv,$export);
        
            if($index_config['export']['html']==1){$html=1;}
            if($index_config['export']['excel']==1){$excel=1;}
            if($index_config['export']['excel_x']==1){$excel_x=1;}
            if($index_config['export']['pdf']==1){$pdf=1;}
            if($index_config['export']['text']==1){$text=1;}
            if($index_config['export']['csv']==1){$csv=1;}
            if($index_config['import']['field_import']!=null){$import=1;
                $extensions=$index_config['import']['extensions'];}
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$primary_key=$generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
<?if ($html==1||$excel==1||$excel_x==1||$pdf==1||$text==1||$csv==1){echo "use kartik\\export\ExportMenu;\n";}?>
<? if($import==1){echo "use yii\widgets\ActiveForm;\nuse app\models\\".$className.";\n";}?>
try {
    
    include(dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php");
    $obj_name="<?=$className?>_config";
    $$obj_name=$obj_name();    
    
    
        

} catch (ErrorException $ex) {
    echo $ex->getMessage();
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/<?=$className?>_Config.php".".\n";
}




use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */


 //$title=Yii::$app->params['form'][$generator->modelClass]!=null?$generator->modelClass:Inflector::camel2words(StringHelper::basename($generator->modelClass));   
//$title=Yii::$app->params['bootstrap']['<?=$generator->modelClass?>']['name'];
//if ($title==null) $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   
 
$title=$<?=$className."_config"?>['name'];
if ($title==null or $title=="") $title=<?=$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;   
if ($remove_title===null) {
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
}
<? 
    if (Yii::$app->params['alarm_controller']!="") {
        echo '$content = $this->render("'.Yii::$app->params['alarm_controller'].'", []);'
            .'if ($content != "") {Yii::$app->session->setFlash("error", $content);}';
    }
?>
?>

<?
    $camel2id_modelClass=Strings::convertToDir(StringHelper::basename($generator->modelClass));
    
            

?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <h1><?= "<? " ?>if ($remove_title===null) echo Html::encode($this->title); ?></h1>
    <?
    if($import==1){
echo "<?
if (!\$create_flag) {echo '<!--';}
\$model = new ".$className.";
\$form =ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',],
'action'=>['//".$camel2id_modelClass."/insert-file".$file_no_import."',".($master_id!=""?"'master_id'=>\$master_id":"")."]
]);
echo \$form->field(\$model, 'import_file".$file_no_import."')->widget(kartik\widgets\FileInput::classname(),[ 'pluginOptions' => [
	'allowedFileExtensions' => ['".$extensions."'],
	'showPreview' => false,
	'showCaption' => true,
	'showRemove' => true,
	'showUpload' => true,
	// 'browseClass' => 'btn btn-primary btn-block',
	'browseIcon' => '<i class=glyphicon glyphicon-folder-open></i> ',
	'browseLabel' => 'Select File to Upload',
	'browseClass' => 'btn btn-success',
	'uploadClass' => 'btn btn-info',
	'removeClass' => 'btn btn-danger',
	'removeIcon' => '<i class=glyphicon glyphicon-trash></i>'
	
]]);
ActiveForm::end();
if (!\$create_flag) {echo '-->';} 
?>";
    }
    ?>
    <?
       $script1= $index_config['script_1'] ;
       if ($script1!=""){
          echo "<?". $script1."?>";
       }
       
    ?>    
    
    <?="<?"?> 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'<?=$className?>id_pjax_id']); 
    }
    ?>
    
    
    <?php if (!empty($generator->searchModelClass)): ?>
        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php endif; ?>

    <p>
        <?="<?"?> if (!$create_flag or $remove_create1) {echo "<!--";}?><a class="btn btn-info <?=$className?>modalButton" value="<?="<?="?> Url::to(['//<?=$camel2id_modelClass?>/create-ajax','app_mode'=>$app_mode<?=$master_id!=""?",'master_id'=>\$master_id":""?><?=($parameter_command==""?"":",".$parameter_command)?>]) ?>">Create <?="<?="?>$title?></a>
        <?="<?"?> if (!$create_flag or $remove_create1) {echo "-->";}?>
        <?="<?"?> if (!$create_flag or $remove_create2) {echo "<!--";}?><?= "<?= " ?>Html::a(<?= "'Create '.\$title" ?>, ['//<?=$camel2id_modelClass?>/create','app_mode'=>$app_mode<?=$master_id!=""?",'master_id'=>\$master_id":""?><?=($parameter_command==""?"":",".$parameter_command)?>], ['class' => 'btn btn-success']) ?>
        <?="<?"?> if (!$create_flag or $remove_create2) {echo "-->";}?>
        <?="<!--['create2','t_transaksi_tt_id'=>'1','f_rekam_medis_type_frmt_id'=>'1']-->"?>
        
        <?
        $button= $index_config['button'] ;
        if ($button!=""){
           echo $button;
        }
        ?>
    

    </p>

    <?php if ($generator->indexWidgetType === 'grid'): ?>
    
    
        
        <?= "<? " ?>
        //$modal_mode=1;
        <?=$parameter_command2?>
        $GLOBALS['app_mode']=$app_mode;
        $ActionColumn=[];
        $ActionColumn[]=['class' => 'kartik\grid\SerialColumn'];
        
        if ($modal_mode==2) {
                    $buttons = [
                        <?=(strstr( $option_flag, 'use_active_form' )?
                            "'update' => function(\$url, \$model, \$key) {
                            \$btn = Html::a(\"<span class='glyphicon glyphicon-pencil'></span>\", [
                               '//".$camel2id_modelClass."/update','app_mode'=>\$GLOBALS['app_mode'], 'id' => \$key]);
                            return \$btn;
                            },":
                            "'update' => function(\$url, \$model, \$key) {
                            \$btn = Html::button(\"<span class='glyphicon glyphicon-pencil'></span>\", [
                                        'value' => Url::to(['//".$camel2id_modelClass."/update-ajax','app_mode'=>\$GLOBALS['app_mode'], ".$urlParams.($parameter_command3==""?"":",".$parameter_command3)."]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => '".$className."modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return \$btn;},")?>
                        'view' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//<?=$camel2id_modelClass?>/view','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", ['//<?=$camel2id_modelClass?>/delete','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]);
                            return $btn;
                        }
                    ];
        } else if ($modal_mode) {
                    $buttons = [
                        <?=(strstr( $option_flag, 'use_active_form' )?
                            "'update' => function(\$url, \$model, \$key) {
                            \$btn = Html::a(\"<span class='glyphicon glyphicon-pencil'></span>\", [
                               '//".$camel2id_modelClass."/update','app_mode'=>\$GLOBALS['app_mode'], 'id' => \$key]);
                            return \$btn;
                            },":
                            "'update' => function(\$url, \$model, \$key) {
                            \$btn = Html::button(\"<span class='glyphicon glyphicon-pencil'></span>\", [
                                        'value' => Url::to(['//".$camel2id_modelClass."/update-ajax','app_mode'=>\$GLOBALS['app_mode'], ".$urlParams.($parameter_command3==""?"":",".$parameter_command3)."]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => '".$className."modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'Update'
                            ]);
                            return \$btn;},")?>
                        'view' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        'value' => Url::to(['//<?=$camel2id_modelClass?>/view-only','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => '<?=$className?>modalButton grid-action',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'bottom',
                                        'title' => 'View'
                            ]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>", [
                                        'value' => Url::to(['//<?=$camel2id_modelClass?>/delete-ajax','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]),
                                        'style' => 'background:none;border:none;padding:0;',
                                        'class' => '<?=$className?>ajaxButton grid-action',
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
                                        '//<?=$camel2id_modelClass?>/update','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]);
                            
                            return $btn;
                            
                            
                        },
                        'view' => function($url, $model, $key) {
                            
                            $btn = Html::a("<span class='glyphicon glyphicon-eye-open'></span>", [
                                        '//<?=$camel2id_modelClass?>/view','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]);
                            return $btn;
                        },
                        'delete' => function($url, $model, $key) {
                            $btn = Html::a("<span class='glyphicon glyphicon-trash'></span>", [
                                    '//<?=$camel2id_modelClass?>/delete','app_mode'=>$GLOBALS['app_mode'], <?= $urlParams ?><?=($parameter_command3==""?"":",".$parameter_command3)?>]);            
                            
                            return $btn;
                        }
                    ];
            } 
            
        <?
        $button= $index_config['button2'] ;
        if ($button!=""){
           echo "\$buttons['".$index_config['button3']."']=". $button.";";
        }
        ?>    
        if ($view_flag or $update_flag or $delete_flag) {
            $ActionColumn[]=['class' => 'kartik\grid\ActionColumn',
                    'options' => ['class' => 'action-column'],
                    'template' => ($view_flag==true?"{view} ":"").($update_flag==true?"{update} ":"").($delete_flag==true?"{delete} ":"")."<?=$index_config['button3']?"{".$index_config['button3']."}":"" ?> ",
                    'buttons' =>$buttons
                        ];
        };
            
    <?php
            $count = 0;
            
            if ($$obj_name!=null) {
                
                foreach ($$obj_name['dataLabel'] as $key => $val){ 
                   if  ($val['disable']=="1") continue;
        
                    $columnname=$key;
                    //if ($columnname!=$master_id) 
                    $display=$val['display'];
                    if ($display==null || $display==0){
                        $display_array=explode(",",$val['Index_display']);
                        $display=$display_array[$file_no];
                    }

                    if ($display==1) {    
                    
                        $hide = "";
                        //if ($IndexFlag!=null) {



                            //if (CheckParameter($generator->modelClass,$column->name)!=null) {
                            
                            if ($label=$val['index']==1) {    
                                $hide = "";
                            } else {
                                $hide = "//";

                            }
                        /*} else {
                            if ($count == 0) {
                                $hide = "//";
                                ++$count;
                            } else if (++$count < 7) {

                            } else {
                                $hide = "//";
                            }
                        }*/

                            
                        //$label_value=$val['value'];
                        $filter_value=$val['filter'];
                        $field_type=$val['field_type'];
                        $field_type_ext_data=$val['field_type_ext_data'];
                        /*
                        if ($label_value!=null and $label_value!=""){
                            $label_value=str_replace('$model->','',$label_value);
                            $label_value=str_replace('->','.',$label_value);
                            if ($field_type==='boolean'){
                                echo "            " . $hide  ."[\n".
                                     "            " . $hide  ."'attribute'=>'".$columnname."',\n".
                                     "            " . $hide  ."'class'=>'\kartik\grid\BooleanColumn',\n".
                                     "            " . $hide  ."'value'=>'".$label_value."',\n".
                                     "            " . $hide  ."'vAlign'=>'middle',\n".
                                     "            " . $hide  .($filter_value!=""?"'filter'=>".$filter_value.",":"")."\n".
                                     "            " . $hide  ."],\n";
                            } else {
                                echo "            " . $hide  ."[\n".
                                     "            " . $hide  ."'attribute'=>'".$columnname."',\n".
                                     "            " . $hide  ."'value'=>'".$label_value."',\n".
                                     "            " . $hide  .($filter_value!=""?"'filter'=>".$filter_value.",":"")."\n".
                                     "            " . $hide  ."],\n";
                            }
                            

                        } else {*/

                            $plug_in=Yii::$app->params['plugin_datatype'][$columnname];
                            if ($plug_in != null) {
                                require(Yii::$app->basePath . '/myTemplates/plugin/'.$plug_in['name'].'_index.php');

                            /*} else if ($columnname=='first_user' or $columnname=='first_ip' or $columnname=='first_update'
                                    or $columnname=='last_user'or $columnname=='last_ip'or $columnname=='last_update') {
                                $hide = "//";
                                --$count;*/
                            };
                            if (($field_type=='extend') )   {
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
                                
                                
                                
                                //echo "if (\$model->get".$ref_table2."Title()!=null){";
                                echo "            " . $hide  ."\$ActionColumn[]=['attribute' =>'" . $columnname ."_fixed',\n".
                                     "            " . $hide  ."'format' => 'raw',\n".
                                     "            " . $hide  ."'value' => '".$ref_table."Str'".",\n".
                                     "            " . $hide  ."];\n";
                            } else if (($field_type=='money') or ($field_type=='date') or ($field_type=='datetime') or ($field_type=='time') ) {
                                $ref_table = "";
                                $split_array = explode("_", $columnname);
                                $no = 0;
                                $max_no = count($split_array);
                                foreach ($split_array as $split_str) {

                                    if ($no == 0) {
                                        $ref_table = $ref_table . $split_str;
                                    } else {
                                        $ref_table = $ref_table . ucfirst($split_str);
                                    }
                                    $no = $no + 1;
                                }
                                //echo "            " . $hide . "'" . $ref_table . "Str',\n";

                                 echo "            " . $hide  ."\$ActionColumn[]=[\n".
                                     "            " . $hide  ."'attribute'=>'".strtolower($ref_table)."str',\n".
                                     "            " . $hide  ."'value'=>'".$ref_table."Str',\n";
                                     if ($field_type=="date" || $field_type == "datetime"){
                                        echo"            " . $hide  ."'filterType' => GridView::FILTER_DATE,\n".
                                            "            " . $hide  ."'filterWidgetOptions' => [\n".
                                            "            " . $hide  ."'size' => 'xs',\n".
                                            "            " . $hide  ."'pluginOptions' => [\n".
                                            "            " . $hide  ."'format' => 'yyyy-mm-dd',\n".
                                            "            " . $hide  ."'autoWidget' => true,\n".
                                            "            " . $hide  ."'autoclose' => true,\n".
                                            "            " . $hide  ."'todayHighlight' => true\n".
                                            "            " . $hide  ."]\n".
                                            "            " . $hide  ."],\n".
                                            "            " . $hide  ."];\n";
                                     }else{
                                     echo"            " . $hide  ."];\n";}
                            } else if (($field_type=='boolean') ) {
                                $ref_table = "";
                                $split_array = explode("_", $columnname);
                                $no = 0;
                                $max_no = count($split_array);
                                foreach ($split_array as $split_str) {

                                    if ($no == 0) {
                                        $ref_table = $ref_table . $split_str;
                                    } else {
                                        $ref_table = $ref_table . ucfirst($split_str);
                                    }
                                    $no = $no + 1;
                                }
                                //echo "            " . $hide . "'" . $ref_table . "Str',\n";

                                 echo "            " . $hide  ."\$ActionColumn[]=[\n".
                                    "            " . $hide  ."'attribute'=>'".strtolower($ref_table)."str',\n".
                                     "            " . $hide  ."'value'=>'".$ref_table."Str',\n".
                                     //"            " . $hide  ."'attribute'=>'".strtolower($ref_table)."',\n".
                                     //"            " . $hide  ."'value'=>'".$ref_table."',\n".
                                    "            " . $hide  ."'class' => '\kartik\grid\BooleanColumn',\n".     
                                    //"            " . $hide  ."'filter' => [0=>'false',1=>'true'],\n".     
                                     "            " . $hide  ."];\n";
                            }else if (($field_type=='id')  )   {

                                require(Yii::$app->basePath . '/myTemplates/plugin/id_index.php');

                                //echo "            " . $hide . "'" . $ref_table.ucfirst($ref_table_name).ucfirst($ref_table2).".".$ref_table_name."_name',\n";
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
                                //echo "            " . $hide . "'" . $ref_table . "Str',\n";

                                echo "            " . $hide  ."\$ActionColumn[]=[\n".
                                     "            " . $hide  ."'attribute'=>'".$columnname."',\n".
                                     "            " . $hide  ."'format'=>'raw',\n".
                                     "            " . $hide  ."'value'=>'".$ref_table."Str',\n".
                                     "            " . $hide  ."'filter'=>"."Yii::\$app->params['".$ref_param."']".",\n".   
                                     "            " . $hide  ."];\n";


                            } else {

                                echo "            " . $hide  ."\$ActionColumn[]=[\n".
                                     "            " . $hide  ."'attribute'=>'".$columnname."',\n".
                                     "            " . $hide  ."'value'=>'".$columnname."',\n".
                                     "            " . $hide  ."];\n";
                                //$format = $generator->generateColumnFormat($column);
                                //echo "            " . $hide . "'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                            }
                        //}
                    }
                }
            }
            
        
        ?>
      <?
      
        
        if ($html==1||$excel==1||$excel_x==1||$pdf==1||$text==1||$csv==1){
            $export=1;
            
        echo "\$export= ExportMenu::widget([
            'dataProvider' => \$dataProvider,
            'columns' => \$ActionColumn,
            'showConfirmAlert' => true,
            'clearBuffers'=>true,
            // 'showColumnSelector' => false,
            'target' => ExportMenu::TARGET_BLANK,
            'pjaxContainerId' => 'kv-pjax-container',
            'exportContainer' => [
                'class' => 'btn-group mr-2'
            ],
            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-secondary',
                'itemsBefore' => [
                    '<div class='.'dropdown-header'.'>Export All Data</div>',
                ],
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => ".($html==1?"['label' => 'Export as HTLM'],":"false,")."
                ExportMenu::FORMAT_EXCEL => ".($excel==1?"['label' => 'Export as Excel 95+'],":"false,")."
                ExportMenu::FORMAT_EXCEL_X => ".($excel_x==1?"['label' => 'Export as Excel 2007+'],":"false,")."
                ExportMenu::FORMAT_PDF => ".($pdf==1?"['label' => 'Export as PDF'],":"false,")."
                ExportMenu::FORMAT_TEXT =>".($text==1?"['label' => 'Export as TEXT'],":"false,")."
                ExportMenu::FORMAT_CSV => ".($csv==1?"['label' => 'Export as CSV'],":"false,")."
            ],
            'filename' =>'$className'.date('d-M-Y'),
            
]);"; 
      }
      ?>  
            
            
    echo GridView::widget([
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        
        'dataProvider' => $dataProvider,
        'responsiveWrap'=>false,
        
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,'columns' => " : "'columns' => "; ?>
        $ActionColumn,
        <?
        if ($export==1){
            echo "'export' => [
                'label' => 'Page',
                ],
                'exportContainer' => [
                'class' => 'btn-group mr-2'
                ],
                'toolbar' => [
                    '{toggleData}',
                    \$export,
                   ],
                   'panel' => [
                    'after'=>'{pager}',
                    'footer'=>false
                    ],";
        }
        ?>
        <?
       $grid_view_option= $index_config['grid_view_option'] ;
       if ($grid_view_option!=""){
          echo $grid_view_option;
       }
       
    ?>    
        
        ]); 
        
        ?>
        
    <?php else: ?>
        <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
        ]) ?>
    <?php endif; ?>
 <?="<?"?>
    Modal::begin([
        'options' => [ 
               'id' => '<?=$className?>myModal', 
               'tabindex' => false  
           ], 
        'header' => 'Create '.$title,
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
                //alert('deleted');
                $.pjax.reload({container: '#<?=$className?>id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $(".btn-success").on('click', function(){
        <?//modified?>
    $("#<?=$className?>myModal").on('hide.bs.modal', function(){
        console.log( '<?=$className?>modalButton.close' );
        try {        
            console.log( 'pjax_enable.close' );
                $.pjax.reload({container: '#<?=$className?>id_pjax_id', async: false});  
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
});
js;
$this->registerJs($js);
?>       
<?='<?'?>
    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
    
    
    <?
       $script2= $index_config['script_2'] ;
       if ($script2!=""){
          echo "<?". $script2."?>";
       }
       
    ?>    
    
    
</div>


 