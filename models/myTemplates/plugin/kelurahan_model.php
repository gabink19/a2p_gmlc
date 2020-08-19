<?
                $split_array=explode("_",$name);
                    $ref_table="";
                    $ref_table2="";
                    $ref_table3="";
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

                                } else {
                                    $ref_table=$ref_table.ucfirst($split_str);
                                    $ref_table3=$ref_table3." ".ucfirst($split_str);
                                }
                            }
                            $no=$no+1;
                            
                            

                        }
                        //$ref_table="fGeneralKelurahanFgk";
                        //$xlabel="flexParameter('".$className."','".$name."','".substr($ref_table3,1)."')";
                        $xlabel="flexParameter2('".$className."','".$name."','".$xlabel."')";
                        
                        $new_label=$new_label."'".$ref_table.ucfirst($ref_table_name).ucfirst($ref_table2).".".$ref_table_name."_name' => ".$xlabel. ",\n";         
                        $new_label=$new_label."'".strtolower($ref_table.$ref_table_name.$ref_table2)."fgk_name' => ".$xlabel. ",\n";         
                        $new_label=$new_label."'".$name."' => ".$xlabel. ",\n";         
           
                        echo "var $".strtolower($ref_table.$ref_table_name.$ref_table2)."fgk_name;\n";
                        
                        echo "public function get".ucfirst($ref_table).ucfirst($ref_table_name).ucfirst($ref_table2)."Str() {
                            if (\$this->".$name."!=null) {
                                \$result = \$this->db->createCommand('select a.fgk_id,d.fgp_name d_fgp_name,c.fgk_name c_fgk_name,b.fgk_name b_fgk_name,a.fgk_name a_fgk_name from f_general_kelurahan a,f_general_kecamatan b,f_general_kabupaten c,f_general_provinsi d
                                    where a.f_general_kecamatan_fgk_id=b.fgk_id and 
                                    b.f_general_kabupaten_fgk_id=c.fgk_id and c.f_general_provinsi_fgp_id=d.fgp_id and a.fgk_id='.\$this->".$name.")
                                    ->queryOne();
                                return \$result['a_fgk_name'].'-'.\$result['b_fgk_name'].'-'.\$result['c_fgk_name'].'-'.\$result['d_fgp_name'];
                                } else return '';
                                }";
                    }
 
?>