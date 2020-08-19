<?
$columnname2=$columnname;
if ($field_type_ext_data!=""){
    $split_array = explode("#", $field_type_ext_data);
    if (count($split_array)==1) {
        $columnname2=$field_type_ext_data;
        $field_type_ext_data="";
    }
}

if ($field_type_ext_data===""){
    
    $split_array = explode("_", $columnname2);
    $ref_table = "";
    $ref_table2 = "";
    $ref_table3 = "";

    $split_str2 = "";
    $no = 0;
    $max_no = count($split_array);
    foreach ($split_array as $split_str) {
        if ($no == ($max_no - 1)) {
            //id 
            if ($split_str == "id") {

            } else {
                $ref_table2 = $split_str;
            }
        } else
        if ($no == ($max_no - 2)) {
            //alias
            $ref_table_name = $split_str;
        } else {
            if ($no == 0) {
                $ref_table = $ref_table . $split_str;
            } else {
                $ref_table = $ref_table . ucfirst($split_str);
            }
            $ref_table3 = $ref_table3 . ucfirst($split_str);
        }
        $no = $no + 1;
    }
    $ref_id = $ref_table_name . "_id";
    $ref_name = $ref_table_name . "_name";
    $ref_table_var=$ref_table . ucfirst($ref_table_name) . ucfirst($ref_table2);
    
} else {
    $split_array = explode("#", $field_type_ext_data);
    $ref_table3 = $split_array[0];//nama table
    $ref_table_var = $split_array[1];//
    $ref_id = $split_array[2];
    $ref_name = $split_array[3];
    
    
    

}
//$ref_table="fGeneralKelurahanFgk";
//$_hide=$hide;
//$hide="";
echo "            " . $hide . "\$ActionColumn[]=[\n" .
 "            " . $hide . "'attribute'=>'" . $columnname . "',\n" .
 "//             'attribute'=>'" . strtolower($ref_table_var. $ref_name) . "',\n" .
 "            " . $hide . "'value'=>'" . $ref_table_var . "." . $ref_name."',\n" ."//             'attribute'=>'" . strtolower($ref_table . $ref_table_name . $ref_table2) . $ref_table_name . "_name',\n" .
 "            " . $hide . "'filter'=>ArrayHelper::map(app\\models\\" . $ref_table3 . "::find()". $val['filter_index']."->all(), '" . $ref_id . "', '" . $ref_name  . "'),\n" .
 "            " . $hide . "];\n";
//$hide=$_hide;
?>