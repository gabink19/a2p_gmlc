<?
                $split_array=explode("_",$name);
                    $ref_table="";
                    $ref_table2="";
                    $ref_table3="";
                    $ref_table4="";
                    $split_str2="";
                    $no=0;
                    $max_no=count($split_array);
                    if ($max_no>2) {
                        foreach($split_array as $split_str){
                            if ($no==($max_no-1)) {
                                //id 
                                        if ($split_str=="id"){

                                } else {
                                   $ref_table2= $split_str;
                                }

                            } else 
                            if ($no==($max_no-2)) {
                                //alias
                                $ref_table_name=$split_str;
                            } else {
                                if ($no==0) {
                                    $ref_table=$ref_table.$split_str;
                                    $ref_table4=$split_str;
                                } else {
                                    $ref_table=$ref_table.ucfirst($split_str);
                                    $ref_table3=$ref_table3." ".ucfirst($split_str);
                                    $ref_table4=$ref_table4."_".$split_str;
                                }
                                
                            }
                            $no=$no+1;
                            

                        }
                        //$ref_table="fGeneralKelurahanFgk";
                        $new_label=$new_label."'".strtolower($ref_table.$ref_table_name.$ref_table2)."fgk_name' ,";         
                        $var_name= strtolower($ref_table.$ref_table_name.$ref_table2)."fgk_name";
                        $join_str=$join_str."//\$query->joinWith('".$ref_table.ucfirst($ref_table_name).ucfirst($ref_table2)." ".$var_name."');\n";
                        $andFilterWhere=$andFilterWhere."//\$query->andFilterWhere(['like', '".$ref_table4.".".$ref_table_name."_name', \$this->".$var_name."]);\n";
                        
                    }
 
?>