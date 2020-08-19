
<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\models\functions;
use app\helpers\Strings;
use yii\db\ColumnSchema;


try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();
    $lebel_api=$$obj_name['dataLabel'];
    $master_id=$$obj_name['master_id']; 
    $API_flag=$$obj_name['API_flag'];
    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../../models/".$className."_Config.php".".\n";
}

$table_name=str_replace("'",'',str_replace(' ','_',strtolower($generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))))));
if ($API_flag==1) : 
echo "<?php\n";
$table = Yii::$app->db->schema->getTableSchema($table_name);
$data=$table->columns;
$primary=$table->primaryKey;
// $foreign=$table->foreignKeys;
// print_r($table);
// echo $primary[0];
?>

/**
* This is the Document for table "<?=$table_name?>".



<?php 
// foreach ($lebel_api as $key=>$val) {
//     if($data[$key]->dbType==null){
//         if ($val['field_type']==''){
//             $type_data='virtual';
//         } else {
//         $type_data=$val['field_type'];}
//     } else {
//         $type_data=$data[$key]->dbType;
//     }
//     echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n";
//     echo "*****************************************\n"; 
// } 
?>

<?

$a=['api-index','api-view','api-update','api-create','api-delete'];
// for ($i=0;$i<3;$i++) :
//         if ($i==0) {
//             $file_no="";
//         } else {
//             $file_no="_".($i+1);
//         }
        ?>

<?php foreach ($a as $b) : ?>        
*for <?=$b."\n"?>
<?
echo "cURL\ncurl --location --request POST 'https://API_HostName.com/index.php?r=".$table_name."/".$b."".( $b=='api-create'?($master_id!=''?'&master_id=['.$master_id.']':''):($b=='api-update' || $b=='api-view' || $b=='api-delete' ?'&id=['.$primary[0].']':($master_id!=''?'&master_id=['.$master_id.']':'')))."' \
--header 'Content-Type: application/x-www-form-urlencoded'\n";
if($b=='api-update' || $b=='api-create'){
    foreach ($lebel_api as $key=>$val){
    if ($b=='api-update'){
        if ($val['display']!=1){
            $show=explode(',',$val['ActiveForm_display']);
            for ($i=0;$i<3;$i++){
             if ($show[$i+1]==1){
                echo"--data-urlencode '".$className."[".$key."]="."[".$key."]' \ \n ";}}}
             else  { echo"--data-urlencode '".$className."[".$key."]="."[".$key."]' \ \n ";}}
    if ($b=='api-create'){
        if ($val['display']!=1){
            $show=explode(',',$val['ActiveForm_display']);
            for ($i=0;$i<3;$i++){
             if ($show[$i+1]==1){ echo"--data-urlencode '".$className."[".$key."]="."[".$key."]' \ \n ";}}}
             else  { echo"--data-urlencode '".$className."[".$key."]="."[".$key."]' \ \n ";}}
   
             }
}
echo "\n";
echo "HTTP
POST /index.php?r=".$table_name."/".$b."".($b=='api-create'?($master_id!=''?'&master_id=['.$master_id.']':''):($b=='api-update' ||$b=='api-view' || $b=='api-delete' ?'&id=['.$primary[0].']':($master_id!=''?'&master_id=['.$master_id.']':'')))." HTTP/1.1
Host: API_HostName.com
Content-Type: application/x-www-form-urlencoded\n";
if($b=='api-update' || $b=='api-create'){
    foreach ($lebel_api as $key=>$val){
    if ($b=='api-update'){
        if ($val['display']!=1){
            $show=explode(',',$val['ActiveForm_display']);
            for ($i=0;$i<3;$i++){
             if ($show[$i+1]==1){
                $isi_http.=$className."[".$key."]=[".$key."]&";}}}
             else  { $isi_http.=$className."[".$key."]=[".$key."]&";}}
    if ($b=='api-create'){
        if ($val['display']!=1){
            $show=explode(',',$val['ActiveForm_display']);
            for ($i=0;$i<3;$i++){
             if ($show[$i+1]==1){ $isi_http.=$className."[".$key."]=[".$key."]&";}}}
             else  { $isi_http.=$className."[".$key."]=[".$key."]&";}}
   
             }
             echo substr($isi_http, 0, -1);
             unset($isi_http);
}
echo "\n";
?>
<?php foreach ($lebel_api as $key=>$val) : ?>
<?  
if($data[$key]->dbType==null){
    if ($val['field_type']==''){
        $type_data='virtual';
    } else {
    $type_data=$val['field_type'];}
} else {
    $type_data=$data[$key]->dbType;
}
if ($b=='api-index'){
    
    if ($val['API_Display_Index']==1){
        echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
        echo "*****************************************\n"; 
    }
}
if ($b=='api-view'){
    if ($val['API_Display_View']==1){
        echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
        echo "*****************************************\n"; 
    }
}
if ($b=='api-update'){
    if ($val['display']!=1){
        $show=explode(',',$val['ActiveForm_display']);
        for ($i=0;$i<3;$i++){
         if ($show[$i+1]==1){ echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
            echo "*****************************************\n"; }}}
         else  {echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
         echo "*****************************************\n"; }}
if ($b=='api-create'){
    if ($val['display']!=1){
        $show=explode(',',$val['ActiveForm_display']);
        for ($i=0;$i<3;$i++){
         if ($show[$i+1]==1){ echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
            echo "*****************************************\n"; }}}
         else  {echo '* @property Name_Field:'.$key."\n* @property Data_Type: ".$type_data."\n* @property Description: ".$val['API_notes']."\n";
         echo "*****************************************\n"; }}

?>
<?php endforeach; ?>
<?
if ($b=='api-delete'){
    echo '* @property Name_Field:'.$primary[0]."\n* @property Data_Type: ".$data[$primary[0]]->dbType."\n* @property Description: ".$val['API_notes']."\n";
        echo "*****************************************\n"; 
}
if ($master_id!=''){
if ($b=='api-index'||$b=='api-create'){
    echo '* @property master_id:'.$master_id."\n* @property Data_Type: INT \n";
        echo "*****************************************\n"; 
}
}
if ($b=='api-update' || $b=='api-view' || $b=='api-delete'){
    echo '* @property id:'.$primary[0]."\n* @property Data_Type: INT \n";
        echo "*****************************************\n"; 
}

?>
<?="\n"?>
<?php endforeach; ?>

*=================================================================*
*to perform this action, @user must log in first to get 3 cookies.*
*                                                                 *
*The 3 cookies are                                                *
*@property _identity                                              *
*@property _csrf                                                  *
*@property PHPSESSID                                              *
*                                                                 *
*These 3 cookies must be taken while taking action.               *
*=================================================================*

*/

<? 
endif; 
?>
