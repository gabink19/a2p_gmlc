<?
$flag=true;
$name2=$name;
if ($field_type_ext_data!=""){
    $split_array = explode("#", $field_type_ext_data);
    if (count($split_array)==1) {
        $name2=$field_type_ext_data;
        $field_type_ext_data="";
    }
}

if ($field_type_ext_data===""){

    
    $split_array = explode("_", $name2);
    $ref_table = "";
    $ref_table2 = "";
    $ref_table3 = "";
    $split_str2 = "";
    $no = 0;
    $max_no = count($split_array);
    if ($max_no > 2) {
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
                    $ref_table3 = $ref_table3 . " " . ucfirst($split_str);
                }
            }
            $no = $no + 1;
        }
        $ref_table_var=$ref_table . ucfirst($ref_table_name) . ucfirst($ref_table2);
        $ref_name=$ref_table_name . "_name";
        $ref_id=$ref_table_name . "_id";
        
        if ($virtual_parameter==1) {
            echo "public function get".ucfirst($ref_table).ucfirst($ref_table_name).ucfirst($ref_table2)."() 
                    { 
                        return \$this->hasOne(".ucfirst($ref_table)."::className(), ['".$ref_id."' => '".$name."']); 
                    }\n ";
         }
    } else {
        $flag=false;
    }
    //$ref_table="fGeneralKelurahanFgk";
    //$xlabel="flexParameter2('".$className."','".$name."','".substr($ref_table3,1)."')";
    
} else {
        $split_array = explode("#", $field_type_ext_data);
        $ref_table3 = $split_array[0];//nama table
        $ref_table_var = $split_array[1];//
        $ref_id = $split_array[2];
        $ref_name = $split_array[3];
    
}
 if ($flag) {
    $xlabel = "\$this->flexParameter3('" . $className . "','" . $name . "','" . $xlabel . "')";


    $new_label = $new_label . "'" . $ref_table_var . "." .$ref_name. "' => " . $xlabel . ",\n";
    $new_label = $new_label . "'" . strtolower($ref_table_var. $ref_name) . "' => " . $xlabel . ",\n";
    $new_label = $new_label . "'" . $name . "' => " . $xlabel . ",\n";

    echo "var $" . strtolower($ref_table_var. $ref_name) . ";\n";
    
    
    
 }
 
 
?>