<?="<?php"?>
<?php
//namespace app\models;  
//use app\models;
//include "/project_hospital/pub/basic/models/FInventoryObat_Config.php";

if(!function_exists("endsWith")) {
    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}

try {
    include(dirname(__FILE__) .    "/../../../models/".$className."_Config.php");
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file.\n";
    
}

?>
<?php 
    $obj_name=$className."_config";
    try {
        if(function_exists($obj_name)) {
            $$obj_name=$obj_name();    
        }
    } catch (ErrorException $ex) {
    }

    if ($$obj_name['dataLabel']!=null) {
        foreach ($$obj_name['dataLabel'] as $key=>$val) {
            $value=$$obj_name['dataLabel'][$key]['value'];
            if ($value===null or $value===""){
                $$obj_name['dataLabel'][$key]['deleted']='1';
            } else {
                $$obj_name['dataLabel'][$key]['deleted']='0';
                
            }
            

        }
    }
    
    $counter=0;
    $counter_index=0;
    foreach ($properties as $key => $val) {
        $displayFlag=0;
        $indexFlag=0;
        switch ($key) {
            case "first_user": break;
            case "first_ip": break;
            case "first_update": break;
            case "last_user": break;
            case "last_ip": break;
            case "last_update": break;
            default:
                if ($counter>0) {
                    $displayFlag=1;
                    if ($counter_index<6) {
                        $indexFlag=1;
                        $counter_index++;
                    };
                }
        }
        
        $field_type=$$obj_name['dataLabel'][$key]['field_type'];
        if ($field_type==""){
            if (endsWith($key, "_money")){
               $field_type='money';
            } else if (endsWith($key, "_date")){
               $field_type='date';
            } else if (endsWith($key, "_datetime")){
               $field_type='datetime';
            } else if (endsWith($key, "_time")) {
               $field_type='time';
            } else if (endsWith($key, "_boolean")) {
               $field_type='boolean';
            } else if (endsWith($key, "_notes")) {
               $field_type='notes';
            } else if (endsWith($key, "_email")) {
               $field_type='email';
            } else if (endsWith($key, "_number")) {
               $field_type='number';
            } else if (endsWith($key, "_money")) {
               $field_type='money';
            } else if (endsWith($key, "_id")) {
               $field_type='id';
            } else if (endsWith($key, "_id1")) {
               $field_type='id';
            } else if (endsWith($key, "_id2")) {
               $field_type='id';
            } else if (endsWith($key, "_id3")) {
               $field_type='id';
            } else if (endsWith($key, "_ref")) {
               $field_type='ref';
            }
        }                    
        if ($$obj_name['dataLabel'][$key]==null) {
            
            $$obj_name['dataLabel'][$key]=['name'=>'','index'=>$indexFlag,'ActiveForm'=>'','DetailView'=>'',"deleted"=>0,'field_type'=>$fieldType,'field_type_ext_data'=>"",'disable'=>"",'display'=>$displayFlag];
            //$$obj_name['dataLabel'][$key][]=['DetailView_display'=>"1,1,1"];
            //$$obj_name['dataLabel'][$key][]=['ActiveForm_display'=>"1,1,1"];
            //$$obj_name['dataLabel'][$key][]=['Index_display'=>"1,1,1"];
            
        } else {
            //$$obj_name['dataLabel'][$key]['field_type']=$field_type;
            $$obj_name['dataLabel'][$key]['deleted']='0';
        }
        $counter++;
    
    };
    
    foreach ($$obj_name['dataLabel'] as $key=>$val) {
        if ($$obj_name['dataLabel'][$key]['deleted']==1) {
            unset($$obj_name['dataLabel'][$key]);
        }
        
        
    }
    $filter=$$obj_name['filter']; 
    if ($filter==null){
        $config['filter']='';
    } else {
        $config['filter']=$filter;
    }
    $filter_ex=$$obj_name['filter_ex']; 
    if ($filter_ex==null){
        $config['filter_ex']='';
    } else {
        $config['filter_ex']=$filter_ex;
    }
    $name=$$obj_name['name']; 
    if ($name==null){
        $config['name']='';
    } else {
        $config['name']=$name;
    }
    $js=$$obj_name['js']; 
    if ($js==null){
        $config['js']='';
    } else {
        $config['js']=$js;
    }
    
    $css=$$obj_name['css']; 
    if ($js==null){
        $config['css']='';
    } else {
        $config['css']=$css;
    }
    
    $master_id=$$obj_name['master_id']; 
    if ($master_id==null){
        $config['master_id']='';
    } else {
        $config['master_id']=$master_id;
    }

    $master_id_ref=$$obj_name['master_id_ref']; 
    if ($master_id_ref==null){
        $config['master_id_ref']='';
    } else {
        $config['master_id_ref']=$master_id_ref;
    }

    $option_flag=$$obj_name['option_flag']; 
    if ($option_flag==null){
        $config['option_flag']='';
    } else {
        $config['option_flag']=$option_flag;
    }
    
    
    $client_id=$$obj_name['client_id']; 
    if ($client_id==null){
        $config['client_id']='';
    } else {
        $config['client_id']=$client_id;
    }
    
    $index_count=$$obj_name['index_count']; 
    if ($index_count===null){
        $config['Index_count']='1';
    } else {
        $config['Index_count']=$index_count;
    }
    
    $ActionForm_count=$$obj_name['ActionForm_count']; 
    if ($ActionForm_count===null){
        $config['ActionForm_count']='1';
    } else {
        $config['ActionForm_count']=$ActionForm_count;
    }
    
    $DetailView_count=$$obj_name['DetailView_count']; 
    if ($DetailView_count===null){
        $config['DetailView_count']='1';
    } else {
        $config['DetailView_count']=$DetailView_count;
    }
    
    $parameter=$$obj_name['parameter']; 
    if ($parameter==null){
        $config['parameter']='';
    } else {
        $config['parameter']=$parameter;
    }
    
    $mode1=$$obj_name['mode1']; 
    if ($client_id==null){
        $config['mode1']='';
    } else {
        $config['mode1']=$mode1;
    }

    $API_flag = $$obj_name['API_flag'];
    if ($API_flag === null) {
        $config['API_flag'] = '';
    } else {
        $config['API_flag'] = $API_flag;
    }
    
    echo "\nif(!function_exists('".$className."_config')){";
    echo "\nfunction ".$className."_config(){ return [";
    echo "\n\t'name'=>'".$config['name']."',";
    echo "\n\t'js'=>'".$config['js']."',";
    echo "\n\t'css'=>'".$config['css']."',";
    echo "\n\t'master_id'=>'".$config['master_id']."',";
    echo "\n\t'master_id_ref'=>'".$config['master_id_ref']."',";
    echo "\n\t'filter'=>'".$config['filter']."',";
    echo "\n\t'filter_ex'=>'".$config['filter_ex']."',";
    echo "\n\t'client_id'=>'".$config['client_id']."',";
    echo "\n\t'option_flag'=>'".$config['option_flag']."',";
    echo "\n\t'parameter'=>'".$config['parameter']."',";
    echo "\n\t'mode1'=>'".$config['mode1']."',";
    echo "\n\t'ActionForm_count'=>'".$config['ActionForm_count']."',";
    echo "\n\t'DetailView_count'=>'".$config['DetailView_count']."',";
    echo "\n\t'Index_count'=>'".$config['Index_count']."',";
    echo "\n\t'API_flag'=>'".$config['API_flag']."',";
    echo "\n\t'dataLabel'=>[\n";
    $config_datalabel=$$obj_name['dataLabel'];
    foreach ($config_datalabel as $key=>$val) {
        $val_js=str_replace("\"","\\\"",$val['js']);
        $filter=str_replace("\$","\\$",$val['filter']);
        $filter_index=str_replace("\$","\\$",$val['filter_index']);
        if ($master_id===$key){
            $val['display']=0;
            $val['index']=0;
        };
        echo "\n\t\t'".$key ."'=>[\n\t\t\t'disable'=>'".$val['disable']."',\n\t\t\t'js'=>\"".$val_js."\",\n\t\t\t'name'=>'".$val['name']."',\n\t\t\t'index'=>'".$val['index']."'";
        if ($val['display']===null){
        } else {
            echo ",\n\t\t\t'display'=>'".$val['display']."'";
        }
        echo ",\n\t\t\t'API_Display_Index'=>'".$val['API_Display_Index']."'";
        echo ",\n\t\t\t'API_Display_View'=>'".$val['API_Display_View']."'";
        echo ",\n\t\t\t'API_notes'=>'".$val['API_notes']."'";
        echo ",\n\t\t\t'DetailView'=>'".$val['DetailView']."'";
        echo ",\n\t\t\t'DetailView_1'=>'".$val['DetailView_1']."'";
        echo ",\n\t\t\t'DetailView_2'=>'".$val['DetailView_2']."'";
        echo ",\n\t\t\t'ActiveForm'=>'".$val['ActiveForm']."'";
        echo ",\n\t\t\t'ActiveForm_1'=>'".$val['ActiveForm_1']."'";
        echo ",\n\t\t\t'ActiveForm_2'=>'".$val['ActiveForm_2']."'";
        echo ",\n\t\t\t'ActiveForm_Option'=>".'"'.$val['ActiveForm_Option'].'"';
        echo ",\n\t\t\t'ActiveForm_Option_1'=>".'"'.$val['ActiveForm_Option_1'].'"';
        echo ",\n\t\t\t'ActiveForm_Option_2'=>".'"'.$val['ActiveForm_Option_2'].'"';
        echo ",\n\t\t\t'DetailView_display'=>'".$val['DetailView_display']."'";
        echo ",\n\t\t\t'ActiveForm_display'=>'".$val['ActiveForm_display']."'";
        echo ",\n\t\t\t'Index_display'=>'".$val['Index_display']."'";
        echo ",\n\t\t\t'value'=>'".$val['value']."',\n\t\t\t'filter'=>\"".$filter."\",\n\t\t\t'filter_index'=>\"".$filter_index."\",\n\t\t\t'field_type'=>\"".$val['field_type']."\",\n\t\t\t'field_type_ext_data'=>\"".$val['field_type_ext_data']."\"\n\t\t],\n";
    }
    echo "\n\t],";
    for ($i=0;$i<3;$i++) {
        if ($i==0) {
            $file_no="";
        } else {
            $file_no="_".($i+1);
        }
        $config_index=$$obj_name['index'.$file_no];
        echo "\n\t'index$file_no'=>[";
        $script_1=str_replace("\$","\\$",$config_index['script_1']);
        $script_1=str_replace("\"","\\\"",$script_1);
        $script_2=str_replace("\$","\\$",$config_index['script_2']);
        $script_2=str_replace("\"","\\\"",$script_2);
        $grid_view_option=str_replace("\$","\\$",$config_index['grid_view_option']);
        $grid_view_option=str_replace("\"","\\\"",$grid_view_option);
        $button=str_replace("\$","\\$",$config_index['button']);
        $button=str_replace("\"","\\\"",$button);
        $button2=str_replace("\$","\\$",$config_index['button2']);
        $button2=str_replace("\"","\\\"",$button2);
        $button3=str_replace("\$","\\$",$config_index['button3']);
        $button3=str_replace("\"","\\\"",$button3);
        if($config_index['import']['field_import'] != ''){
        foreach($config_index['import']['field_import'] as $data_import => $number_field){
            if($data_import!=''){
            $import_field.="'".$data_import."'=>".$number_field.",";}
        }} else {$import_field="";}
        $import_field=substr($import_field, 0, -1);
        echo "\n\t\t'script_1'=>\"".$script_1."\",";
        echo "\n\t\t'script_2'=>\"".$script_2."\",";
        echo "\n\t\t'grid_view_option'=>\"".$grid_view_option."\",";
        echo "\n\t\t'button'=>\"".$button."\",";
        echo "\n\t\t'button2'=>\"".$button2."\",";
        echo "\n\t\t'button3'=>\"".$button3."\",";
        echo "\n\t\t'export'=>[";
        echo "\n\t\t\t'html'=>'".$config_index['export']['html']."',";
        echo "\n\t\t\t'excel'=>'".$config_index['export']['excel']."',";
        echo "\n\t\t\t'excel_x'=>'".$config_index['export']['excel_x']."',";
        echo "\n\t\t\t'pdf'=>'".$config_index['export']['pdf']."',";
        echo "\n\t\t\t'text'=>'".$config_index['export']['text']."',";
        echo "\n\t\t\t'csv'=>'".$config_index['export']['csv']."',";
        echo "\n\t\t],";
        echo "\n\t\t'import'=>[";
        echo "\n\t\t\t'field_import'=>[".$import_field."],";
        echo "\n\t\t\t'extensions'=>'".$config_index['import']['extensions']."',";
        echo "\n\t\t\t'explode'=>'".$config_index['import']['explode']."',";
        echo "\n\t\t\t'bulk'=>'".$config_index['import']['bulk']."',";
        echo "\n\t\t]";
        echo "\n\t],";
        unset($import_field);
        $config_view=$$obj_name['view'.$file_no];
        echo "\n\t'view$file_no'=>[";
        $script_1=str_replace("\$","\\$",$config_view['script_1']);
        $script_1=str_replace("\"","\\\"",$script_1);
        $script_2=str_replace("\$","\\$",$config_view['script_2']);
        $script_2=str_replace("\"","\\\"",$script_2);
        $button=str_replace("\$","\\$",$config_view['button']);
        $button=str_replace("\"","\\\"",$button);

        echo "\n\t\t'script_1'=>\"".$script_1."\",";
        echo "\n\t\t'script_2'=>\"".$script_2."\",";
        echo "\n\t\t'button'=>\"".$button."\",";
        echo "\n\t],";

        $config_active_form=$$obj_name['_active_form'.$file_no];
        echo "\n\t'_active_form$file_no'=>[";
        $script_1=str_replace("\$","\\$",$config_active_form['script_1']);
        $script_1=str_replace("\"","\\\"",$script_1);
        $script_2=str_replace("\$","\\$",$config_active_form['script_2']);
        $script_2=str_replace("\"","\\\"",$script_2);

        echo "\n\t\t'script_1'=>\"".$script_1."\",";
        echo "\n\t\t'script_2'=>\"".$script_2."\",";
        echo "\n\t],";
    }
    
    
    echo "\n];";
    echo "\n};\n};";
    
    
    
    
    
?> 
?>