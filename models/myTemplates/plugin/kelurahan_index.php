<?

                $split_array=explode("_",$columnname);
                    $ref_table="";
                    $ref_table2="";
                    $ref_table3="";
                    
                    $split_str2="";
                    $no=0;
                    $max_no=count($split_array);
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
                            } else {
                                $ref_table=$ref_table.ucfirst($split_str);
                            }
                            $ref_table3=$ref_table3.ucfirst($split_str);
                        }
                        $no=$no+1;
                        
                    }
                    //$ref_table="fGeneralKelurahanFgk";
                    echo "            " . $hide  ."[\n".
                         "            " . $hide  ."'attribute'=>'".$columnname."',\n".
                         "//             'attribute'=>'".strtolower($ref_table.$ref_table_name.$ref_table2).$ref_table_name."_name',\n".
                         "            " . $hide  ."'value'=>'".$ref_table.ucfirst($ref_table_name).ucfirst($ref_table2).".".$ref_table_name."_name',\n".
                            
                         "            " . $hide  ."'filter' => ArrayHelper::map(Yii::\$app->db->createCommand('select a.fgk_id,d.fgp_name d_fgp_name,c.fgk_name c_fgk_name,b.fgk_name b_fgk_name,a.fgk_name a_fgk_name from f_general_kelurahan a,f_general_kecamatan b,f_general_kabupaten c,f_general_provinsi d where a.f_general_kecamatan_fgk_id=b.fgk_id and b.f_general_kabupaten_fgk_id=c.fgk_id and c.f_general_provinsi_fgp_id=d.fgp_id')->queryAll(), 'fgk_id',\n ". 
                         "            " . $hide  ." function(\$model) {\n".
                         "            " . $hide  ."    return \$model['d_fgp_name'].'-'.\$model['c_fgk_name'].'-'.\$model['b_fgk_name'].'-'.\$model['a_fgk_name'];\n".
                         "            " . $hide  ."}"."),\n".   
                            
                         "            " . $hide  ."],\n";
                    
        
?>