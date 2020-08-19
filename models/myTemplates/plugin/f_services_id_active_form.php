<?
use yii\helpers\StringHelper;

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
                                $ref_table3=$split_str;
                          
                          
                            } else {
                                $ref_table=$ref_table.ucfirst($split_str);
                                $ref_table3=$ref_table3.'-'.$split_str;
                              }
                        }
                        $no=$no+1;
                        
                    }
                    //$ref_table="fGeneralKelurahanFgk";
                    $javascript_var=$javascript_var."varFServicesWhere='';";
                    
                    echo "    <?= \$form->field(\$model,'".$columnname."')->widget(kartik\select2\Select2::classname(),";
                    echo " [
                            'hideSearch' => false,
                            'initValueText' => \$model->".$ref_table.ucfirst($ref_table_name).ucfirst($ref_table2)."->".$ref_table_name."_name,
                            
                            'options' => ['placeholder' => 'select','id'=>'".$columnname."'.\$model->".$primary_key.",],".($val['js']===null?"":$val['js'])."
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                        'errorLoading' => new yii\web\JsExpression('function () { return \"Waiting for results...\"; }'),
                                        ],
                                  'ajax' => [
                                    'url' => yii\helpers\Url::to(['g-services/g-services-name']),
                                    'dataType' => 'json',
                                    'data' => new yii\web\JsExpression('function(params) { return {q:params.term,where:varFServicesWhere}; }')
                                ],
                                'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new yii\web\JsExpression('function(city) { return city.text; }'),
                                'templateSelection' => new yii\web\JsExpression('function (city) { return city.text; }'),       
                                                      
                            ],
                            ]
                        
                        )\n?>"; 
 
?>