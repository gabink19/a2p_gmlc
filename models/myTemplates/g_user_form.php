<?
                $split_array=explode("_",$column->name);
                    $ref_table="";
                    $ref_table2="";
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
                        }
                        $no=$no+1;
                        
                    }
                    //$ref_table="fGeneralKelurahanFgk";
                    
                    
                    echo "            ['attribute' =>'" . $column->name ."', 
                        'type' => DetailView::INPUT_SELECT2, 'value' => \$model->".$ref_table.ucfirst($ref_table_name).ucfirst($ref_table2)."->".$ref_table_name."_name".",
                          'widgetOptions' => [
                            'hideSearch' => true,
                            'data' => ArrayHelper::map(app\\models\\".ucfirst($ref_table)."::find()->all(), '".$ref_table_name."_id"."', '".$ref_table_name."_name"."'),
                            'options' => ['placeholder' => 'select'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        ],\n"; 
 
?>