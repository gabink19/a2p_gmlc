<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\helpers\Strings;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

try {
    
    $className= StringHelper::basename($generator->modelClass);
    $camel2id_modelClass=Strings::convertToDir(StringHelper::basename($generator->modelClass));
    
    $lower_className=strtolower($className);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();    
    $master_id=$$obj_name['master_id'];
    $parameter_var=$$obj_name['parameter'];
    $split_array = explode(",", $parameter_var);
    if ($file_no==0) {
        $_active_form_config=$$obj_name['_active_form'];
    } else {
        $_active_form_config=$$obj_name['_active_form_'.($file_no+1)];
    }
    $ActionForm_count=$$obj_name['ActionForm_count'];
    if ($ActionForm_count<=$file_no){
        return;
    }
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
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;




/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
$escape = new JsExpression("function(m) { return m; }");
?>
<?
$primary_key = $generator->getNameAttribute();
?>

<?
if (!function_exists("endsWith")) {

    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

}
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <?
       $script1= $_active_form_config['script_1'] ;
       if ($script1!=""){
          echo "<?". $script1."?>";
       }
       
    ?>
    
<?= "<?php " ?>
    if ($view_form==null) $view_form='update2';
    if ($modal_class==null) $modal_class='comment-form2'; else $modal_class='submitForm';
    
    $form = ActiveForm::begin(
    ['options' => ['data-pjax' => true,'class' => $modal_class],
    'action' =>[$view_form,'id'=>$model-><?= $primary_key ?><?=($master_id!=""?",'master_id'=>\$master_id":"")?><?=($parameter_command==""?"":",".$parameter_command)?>,'app_mode'=>$app_mode],]
    ); ?>
<?
$bootstrap = Yii::$app->params['bootstrap'][$generator->modelClass]['ActiveForm'];
$counter = 0;
if ($$obj_name!=null) {
    foreach ($$obj_name['dataLabel'] as $key => $val){ 
        if  ($val['disable']=="1") continue;
        
        $columnname=$key;
            
//foreach ($generator->getTableSchema()->columns as $column) {
//    $format = $generator->generateColumnFormat($column);
        //if ($columnname!=$master_id) {    
        $display=$val['display'];
        if ($display==null || $display==0){
            $display_array=explode(",",$val['ActiveForm_display']);
            $display=$display_array[$file_no];
        }
        if ($file_no==0) {
            $option=($val['ActiveForm_Option']==null?"":$val['ActiveForm_Option']);}
            else{
            $option=($val['ActiveForm_Option_'.$file_no]==null?"":$val['ActiveForm_Option_'.$file_no]);}
            // if (strpos($option, "options") == null) {
            //     $option = " 'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],
            //         " . $option;
            // }
        $js_script=($val['ActiveForm_js'.$file_no]===null?"":$val['ActiveForm_js'.$file_no]);
        if ($display==1) {    
                
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
                    $bootstrap_param=$val['ActiveForm'];
                } else {
                    $bootstrap_param=$val['ActiveForm_'.$file_no];
                    
                }
                
                    
                if ($bootstrap_param[0]=='*') {
                    $bootstrap_param=strstr($bootstrap_param,"|");
                }
                if ($bootstrap_param[0] == '|') {
                    echo "<div class='row'>";
                }
                if ($bootstrap_param[0] == '#') {
                    $div_id = strstr($bootstrap_param, "#");
                    if ($div_id != '#') {
                        $div_id = str_replace('#', '', $div_id);
                        echo "<div id='" . $div_id . "'>\n";
                    }
                }
                $size=str_replace('|', '',$bootstrap_param );
                switch ($size) {
                    case '1' :
                    case '2' :
                    case '3' :
                    case '4' :
                    case '5' :
                    case '6' :
                        echo "<div class='col-md-".$size."'>";
                        break;


                }
                //$label_value=$val['value'];
                $field_type=$val['field_type'];
                $field_type_ext_data=$val['field_type_ext_data'];
                
                /*if ($label_value!=null and $label_value!=""){
                    echo "<div class='form-group'>";
                    echo "<label class='control-label'>".$columnname."</label>";
                    echo "<div class='form-control' id='".$lower_className."-".$columnname."'>";
                    echo  "<?=".$label_value."?>";
                    echo "</div><div class='help-block'></div></div>";
                } else {*/
            
                    $plug_in = Yii::$app->params['plugin_datatype'][$columnname];
                    if ($plug_in != null) {
                        require(Yii::$app->basePath . '/myTemplates/plugin/' . $plug_in['name'] . '_active_form.php');
                    } else if (($field_type=='extend') )   {
                        $ref_table = "";
                        $ref_table2="";
                        $split_array = explode("_", $columnname);
                        $no = 0;
                        $max_no = count($split_array);
                        foreach ($split_array as $split_str) {

                            if ($no == 0) {
                                $ref_table = $ref_table . $split_str;
                                $ref_table2 = $ref_table2 . ucfirst($split_str);
                            } else {
                                $ref_table = $ref_table . ucfirst($split_str);
                                $ref_table2 = $ref_table2 . ucfirst($split_str);
                            }
                            $no = $no + 1;
                        }
                        echo "    <?if (\$model->get".$ref_table2."Title()!=null)  {echo \$form->field(\$model,'" . $columnname . "')->textInput(['maxlength' => true,".$js_script."]);}?>\n\n";
                    } else if (($field_type=='af-extend') )   {
                        $ref_table = "";
                        $ref_table2="";
                        $split_array = explode("_", $columnname);
                        $no = 0;
                        $max_no = count($split_array);
                        foreach ($split_array as $split_str) {

                            if ($no == 0) {
                                $ref_table = $ref_table . $split_str;
                                $ref_table2 = $ref_table2 . ucfirst($split_str);
                            } else {
                                $ref_table = $ref_table . ucfirst($split_str);
                                $ref_table2 = $ref_table2 . ucfirst($split_str);
                            }
                            $no = $no + 1;
                        }
                        echo "    <?if (\$model->get".$ref_table2."TitleFixed()!=null)  {echo \$form->field(\$model,'" . $columnname . "')->textInput(['maxlength' => true,".$js_script."]);}?>\n\n";
                    } else if (($field_type=='date') or ($field_type=='time') or ($field_type=='datetime') or ($field_type=='boolean')) {
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
                        if (($field_type=='date') ) {
                            if (strpos($option,"pluginOptions")==null){
                                $option="'pluginOptions' => [
                                             'format' => 'yyyy-mm-dd'
                                            ],
                                        ".$option;
                            }
                            echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\widgets\DatePicker::classname(),";
                            echo " [
                                   'value' => \$model->" . $ref_table . "Str" . ",
                                   'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],
                                   ".$option."

                                    ]


                                )\n?>";
                            /*
                              echo "    <?= kartik\widgets\DatePicker::widget(";
                              echo " [
                              'name'=>'".StringHelper::basename($generator->modelClass)."[".$column->name."]',
                              'value'=>\$model->".$column->name.",
                              'pluginOptions' => [
                              'format' => 'yyyy-mm-dd'
                              ],

                              ]


                              )\n?>"; */
                        } else if (($field_type=='datetime') ) {
                            if (strpos($option,"pluginOptions")==null){
                                $option="'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd hh:ii:ss'
                                            ],
                                        ".$option;
                            }
                            echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\widgets\DateTimePicker::classname(),";
                            echo " [
                                   'value' => \$model->" . $ref_table . "Str" . ",
                                   'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],

                                   ".$option."
                                    ]


                                )\n?>";
                            /*
                              echo "    <?= kartik\widgets\DateTimePicker::widget(";
                              echo " [
                              'name'=>'".StringHelper::basename($generator->modelClass)."[".$column->name."]',
                              'value'=>\$model->".$column->name.",
                              'pluginOptions' => [
                              'format' => 'yyyy-mm-dd hh:ii:ss'
                              ],

                              ]


                              )\n?>"; */
                        } else if (($field_type=='time') ) {
                            if (strpos($option,"pluginOptions")==null){
                                $option="'pluginOptions' => [
                                            'showSeconds' => true,
                                            'showMeridian' => false,],
                                             ]
                                    ".$option;
                            }
                            echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\widgets\TimePicker::classname(),";
                            echo " [
                                   'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],

                                   ".$option."

                                )\n?>";
                            /*
                              echo "    <?= kartik\widgets\TimePicker::widget(";
                              echo " [
                              'name'=>'".StringHelper::basename($generator->modelClass)."[".$column->name."]',
                              'value'=>\$model->".$column->name.",
                              'showSeconds' => true,
                              'showMeridian' => false,
                              ]

                              )\n?>";
                             */
                        } else if (($field_type=='boolean') ) {
                            echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(\kartik\switchinput\SwitchInput::classname(),";
                            echo " [
                                   'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],
                                   ".$option."

                                   
                                    ]


                                )\n?>";
                        }
                    } else if (($field_type=='money') ) {
                        //require_once(Yii::$app->basePath . '/myTemplates/plugin/form_money.php');
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

                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\\number\\NumberControl::classname(),[";
                        echo "'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],";
                        echo $option,"
                        ])\n?>";
                        /*
                          echo "    <?= kartik\widgets\NumberControl::widget(";
                          echo " [
                          'name'=>'GServices[".$column->name."]',
                          'value'=>\$model->".$column->name.",
                          ]

                          )\n?>";
                         */
                    } else if (($field_type=='notes') ) {
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->textarea(['rows' => 4,".$js_script."])?>\n\n";
                    } else if (($field_type=='password') ) {
                        $field_type_ext_data_array=explode("[seperator]",$field_type_ext_data);
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\password\PasswordInput::classname(),[";
                        echo $field_type_ext_data_array[2];
                        echo $option."
                             ]


                                )\n?>";
                    } else if (($field_type=='password2') ) {
                        $field_type_ext_data_array=explode("[seperator]",$field_type_ext_data);
                        
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->input('password',[".
                                $field_type_ext_data_array[2].
                        
                                $js_script."])?>\n\n";
                    } else if (($field_type=='capcha') ) {
                        $field_type_ext_data_array=explode("[seperator]",$field_type_ext_data);
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(\yii\captcha\Captcha::classname(),[";
                        echo "'template' => '{image}{input}',";
                        echo $field_type_ext_data_array[2];
                        echo $option."
                             ]


                                )\n?>";
                    } else if (($field_type=='email') ) {
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(yii\widgets\MaskedInput::classname(),[";
                        echo "     'clientOptions' => ['alias' => 'email',],
                                   ".$option."
                                    ]


                                )\n?>";
                    } else if (($field_type=='location')) {
                        
                        $field_type_ext_data_array=explode(",",$field_type_ext_data);
                        echo "<?= \$form->field(\$model, '".$columnname."')->widget(\app\helpers\maplocation\SelectMapLocationWidget::className(), [
                                'attributeLatitude' => '".$field_type_ext_data_array[1]."',
                                'attributeLongitude' => '".$field_type_ext_data_array[0]."',
                                'googleMapApiKey' => 'AIzaSyD7sTqR9nFuvTd_5_LrDNdWeSVnNybHYYA',
                                'draggable'=>true,
                                ])\n?>";
                    } else if (($field_type=='number')) {
                        /*
                        echo "    <?= \$form->field(\$model,'" . $column->name . "')->widget(yii\widgets\MaskedInput::classname(),";
                        echo " [
                                    'options' => ['id'=>'" . $column->name . "'.\$model->" . $primary_key . ",],
                                    'mask' => '99999999999',
                                    ]

                                )\n?>";
                        */

                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\\number\\NumberControl::classname(),[";
                        echo "'options' => ['id'=>'" . $columnname . "'.\$model->" . $primary_key . ",],";
                        echo "'maskedInputOptions' => ['groupSeparator' => '','digits' => 0,'rightAlign' => false]";
                        echo $option."
                        ])\n?>";

                    } else if (($field_type=='typehead') ) {

                        $ref_table = "";
                        $ref_param = "";
                        $ref_param2 = "";

                        if ($field_type_ext_data === "") {
                            $split_array=explode("_",$columnname);
                        } else {
                            $split_array = explode("_", $field_type_ext_data);

                        }

                        $no = 0;
                        $max_no = count($split_array);
                        foreach ($split_array as $split_str) {

                            if ($no == 0) {
                                $ref_table = $ref_table . $split_str;
                            } else {
                                $ref_table = $ref_table . ucfirst($split_str);
                            }
                            if ($no != 0 and $no != ($max_no - 1)) {
                                if ($no == 1) {
                                    $ref_param2 = $ref_param2 .$split_str;
                                    $ref_param = $ref_param . $split_str;
                                } else {
                                    $ref_param2 = $ref_param2 .'-'.$split_str;
                                    $ref_param = $ref_param . ucfirst($split_str);
                                }
                            }
                            $no = $no + 1;
                        }
                        if (strpos($option,"pluginOptions")==null){
                            $option="'pluginOptions' => [
                                            'highlight' => true,
                                            'escapeMarkup' => \$escape,
                                            'allowClear' => true
                                    ],
                                    ".$option;
                        }
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\widgets\Typeahead::classname(),";
                        echo " [
                                    'dataset' => [
                                            [
                                            'datumTokenizer' => \"Bloodhound.tokenizers.obj.whitespace('value')\",
                                            'display' => 'value',
                                            'remote' => [
                                                'url' => Url::to(['".$field_type_ext_data."']) . '&q=%QUERY',
                                                'wildcard' => '%QUERY'
                                            ]
                                            ]
                                        ],
                                    'options' => ['placeholder' => 'select',
                                        'id'=>'" . $columnname . "'.\$model->" . $primary_key . ",

                                         ],
                                    ".$option."
                                    ]

                                )\n?>";
                        
                    } else if (($field_type=='ref') ) {

                        $ref_table = "";
                        $ref_param = "";

                        if ($field_type_ext_data === "") {
                            $split_array=explode("_",$columnname);
                        } else {
                            $split_array = explode("_", $field_type_ext_data);

                        }

                        $no = 0;
                        $max_no = count($split_array);
                        foreach ($split_array as $split_str) {

                            if ($no == 0) {
                                $ref_table = $ref_table . $split_str;
                            } else {
                                $ref_table = $ref_table . ucfirst($split_str);
                            }
                            if ($no != 0 and $no != ($max_no - 1)) {
                                if ($no == 1) {
                                    $ref_param = $ref_param . $split_str;
                                } else {
                                    $ref_param = $ref_param . ucfirst($split_str);
                                }
                            }
                            $no = $no + 1;
                        }
                        if (strpos($option,"pluginOptions")==null){
                            $option="'pluginOptions' => [
                                            'escapeMarkup' => \$escape,
                                            'allowClear' => true
                                    ],
                                    ".$option;
                        }
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->widget(kartik\select2\Select2::classname(),";
                        echo " [
                                    'hideSearch' => false,
                                    'data' => Yii::\$app->params['" . $ref_param . "'],
                                    'options' => ['placeholder' => 'select',
                                        'id'=>'" . $columnname . "'.\$model->" . $primary_key . ",

                                         ],
                                        ".$option."
                                    ]

                                )\n?>";
                        /*
                          echo "    <?= kartik\widgets\NumberControl::widget(";
                          echo " [
                          'name'=>'".StringHelper::basename($generator->modelClass)."[".$column->name."]',
                          'value'=>\$model->".$column->name.",
                          'hideSearch' => false,
                          'data' => Yii::\$app->params['".$ref_param."'],
                          'options' => ['placeholder' => 'select ".$ref_param."'],
                          'pluginOptions' => [
                          'allowClear' => true
                          ],
                          ]

                          )\n?>";
                         */
                    } else if (($field_type=='id') ) {

                        require(Yii::$app->basePath . '/myTemplates/plugin/id_active_form.php');
                    } else {
                        $field_type_ext_data_array=explode("[seperator]",$field_type_ext_data);
                        
                        echo "    <?= \$form->field(\$model,'" . $columnname . "')->textInput(['maxlength' => true,".
                                $field_type_ext_data_array[2].
                        
                                $js_script."])?>\n\n";

                    };
                //}

                switch ($size) {
                    case '1' :
                    case '2' :
                    case '3' :
                    case '4' :
                    case '5' :
                    case '6' :
                        echo "</div>";
                        break;


                }
                if(substr($bootstrap_param,-1)=='#'){
                    echo "</div>\n";
                }
                if ($bootstrap_param[strlen($bootstrap_param)-1]=='|') {
                    echo "</div>";
                }



                $counter++;
            
            }
        }
        
    }
}
?>
    <div class="form-group">
    <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

    <?
       $script2= $_active_form_config['script_2'] ;
       if ($script2!=""){
          echo "<?". $script2."?>";
       }
       
    ?>
    

</div>

<?="<?"?>
$js=<<<js
    <?=$javascript_var?>
    
    $(".submitForm").submit(function(event) {
                        
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        console.log('action:'+ url);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert(response.data.message); 
                $(".modal.in").modal('hide');
                
                //$.pjax.reload({container: '#id_pjax_id', async: false});
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;

    });
  
js;
$this->registerJs($js);
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

