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
    //if (count($split_array)==1) {

        $split_array = explode("_", $columnname2);
        $ref_table3 = "";
        $ref_table2 = "";
        $ref_table4 = "";

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
                    $ref_table3 = $ref_table3 . $split_str;
                    $ref_table4 = $split_str;
                } else {
                    $ref_table3 = $ref_table3 . ucfirst($split_str);
                    $ref_table4 = $ref_table4 . '-' . $split_str;
                }
            }
            $no = $no + 1;
        }
        //$ref_table="fGeneralKelurahanFgk";

        $ref_id = $ref_table_name . "_id";
        $ref_name = $ref_table_name . "_name";
        $ref_table_var = $ref_table3 . ucfirst($ref_table_name) . ucfirst($ref_table2);
    //}
} else {
    $split_array = explode("#", $field_type_ext_data);
    $ref_table3 = $split_array[0]; //nama table
    $ref_table_var = $split_array[1]; //
    $ref_id = $split_array[2];
    $ref_name = $split_array[3];
    $ref_table4 = $split_array[4];
}


echo "\$attributes[]=['attribute' =>'" . $columnname . "', 
                        

                        'format'=>'raw','displayOnly'=>\$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a(\$model->" . $ref_table_var . "->" . $ref_name . ", ['" . $ref_table4 . "/view', 'id' => \$model->" . $columnname . "]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\\models\\" . ucfirst($ref_table3) . "::find()" . $val['filter'] . "->all(), '" . $ref_id . "', '" . $ref_name . "'),
                            'options' => ['placeholder' => 'select'," . $js_script . "],
                            
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]" . $size_str . "
                        
                        ];\n";
?>