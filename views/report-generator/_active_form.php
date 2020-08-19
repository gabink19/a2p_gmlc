<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
$q = "SELECT item_name from auth_assignment where user_id='".Yii::$app->user->identity->id."'";
$role = Yii::$app->db->createCommand($q)->queryScalar();
?>


<div class="report-generator-x-form">

    <?
    if ($filter_where==""){
        echo Html::button("<span class='glyphicon glyphicon-filter'></span>", [
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'grid-action',
            'data-toggle' => 'collapse',
            'data-placement' => 'bottom',
            'data-target' => "#demo",
            'title' => 'Filter'
        ]);
    }
    
    
    if ($builder == 0) {
        
        if ($can_update==1 && ($role=='Super admin' || $role=='Developer')){
            echo Html::button("<span class='glyphicon glyphicon-edit'></span>", [
                'value' => Url::to(['//report-generator/get-data-report4','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'builder'=>1,"filter_where"=>$filter_where,"filter_where_df"=>$filter_where_df,'mode'=>$mode,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton2 grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Update mode'
            ]);
        }
    } else {
        if ($can_build==1){
             
        }
        echo Html::button("<span class='glyphicon glyphicon-cog'></span>", [
                   'value' => Url::to(['//report-generator-x/update','mode'=>$mode,'app_mode'=>$app_mode,'id'=>$db_id,
                       'redirect_url'=>Url::to(['//report-generator/get-data-report4','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'builder'=>1,'mode'=>$mode,'app_mode'=>$app_mode])
                       ]),
                   'style' => 'background:none;border:none;padding:5px;color:black',
                   'class' => 'ReportGeneratormodalButton2 grid-action',
                   'data-toggle' => 'tooltip',
                   'data-placement' => 'bottom',
                   'title' => 'modification data cube'
               ]);
        echo Html::button("<span class='glyphicon glyphicon-refresh'></span>", [
                  
                   'value' => Url::to(['//report-generator-builder/refresh-cube','mode'=>$mode, 'folder' => $folder,'report_name' => $report_name,'app_mode'=>$app_mode]),
                
                   'style' => 'background:none;border:none;padding:5px;color:black',
                   'class' => 'ReportGeneratormodalButton grid-action',
                   'data-toggle' => 'tooltip',
                   'data-placement' => 'bottom',
                   'title' => 'refresh data cube'
               ]);
        
        echo Html::button("<span class='glyphicon glyphicon-education'></span>", [
                'value' => Url::to(['//report-generator-builder/update-json','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'builder'=>1,'mode'=>$mode,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'json editor(all)'
            ]);
        echo Html::button("<span class='glyphicon glyphicon-list-alt'></span>", [
                'value' => Url::to(['//report-generator/get-data-report4','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'builder'=>0,'mode'=>$mode,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton2 grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'view mode'
            ]);
        echo "<font color='blue'>page:</font>";

        echo Html::button("<span class='glyphicon glyphicon-th-list'></span>", [
            'value' => Url::to(['//report-generator-builder/change-page','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Change Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder/add-page', 'folder' => $folder,'mode'=>$mode,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Add Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-wrench'></span>", [
            'value' => Url::to(['//report-generator-builder/edit-page', 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Edit Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-remove'></span>", [
            'value' => Url::to(['//report-generator-builder/delete-page','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:red',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Delete Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-education'></span>", [
                'value' => Url::to(['//report-generator-builder/json-page','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'builder'=>1,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'json editor(page)'
            ]);
        echo "<font color='blue'>chart:</font>";
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder/add-report','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Add Report'
        ]);
        if ($dashboard_name=="_dashboard_chart2a") {
            echo Html::button("<span class='glyphicon glyphicon-sort-by-attributes'></span>", [
                'value' => Url::to(['//report-generator-builder/sort-report','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Sort Report'
            ]);
        } else {
            echo Html::button("<span class='glyphicon glyphicon-sort-by-attributes'></span>", [
                'value' => Url::to(['//report-generator-builder/sort-report','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButtonSavePage grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Sort Report'
            ]);
            
        }
        echo "<font color='blue'>filter:</font>";
        
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder/add-filter','mode'=>$mode, 'folder' => $folder, 'report_name' => $report_name,'mode'=>$mode,'app_mode'=>$app_mode]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Add Filter'
        ]);
        
    }
    ?>

    <div id="demo" class="collapse">

    <?php
    if ($ajax_mode==1){
        $form = ActiveForm::begin(['options' => ['class' => "ReportGeneratorSubmitForm"]]);
    } else {
        $form = ActiveForm::begin(['options' => ['class' => "ReportGeneratorSubmitForm2"]]);
    }
    ?>

    <?
    
    
    $ke = 0;
    foreach ($column as $col) {
        $use_col=$use_column[$col['COLUMN_ID']];
        if ($use_col!=null && $use_col['filter_flag'] == 1) {

            $data_type = $col['DATA_TYPE'];
            $ALIAS_NAME = $col['ALIAS_NAME'];
            $COLUMN_COMMENT = $col['COLUMN_COMMENT'];

            echo "<div class='col-md-12'>";
            if ($builder==1){
            
                echo Html::button("<span class='glyphicon glyphicon-remove'></span>", [
                        'value' => Url::to(['//report-generator-builder/delete-filter', 'mode' => $mode, 'folder' => $folder,'report_name' => $report_name,'idx'=>$col['COLUMN_ID']]),
                        'style' => 'background:none;border:none;padding:5px;color:red',
                        'class' => 'ReportGeneratormodalButton grid-action',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'bottom',
                        'title' => 'Delete filter'
                    ]);
            }
            echo "<div class='col-md-2'>";
            
            echo $form->field($model, 'param' . $ke . '_3')->widget(kartik\select2\Select2::classname(), [
                'hideSearch' => false,
                'data' => Yii::$app->params['persamaan'],
                'options' => ['placeholder' => 'select',
                    'options' => ['id' => "reportgenerator-param".$ke . '_3'],
                    
                ],
                'pluginOptions' => [
                    'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
                    ]
            )->label($ALIAS_NAME, ['class' => 'label-class']);
            echo "</div>";
            if ($COLUMN_COMMENT != "") {
                $COLUMN_COMMENT_ARRAY = explode(":", $COLUMN_COMMENT);
                if ($COLUMN_COMMENT_ARRAY[0] == 'ref') {
                    echo "<div class='col-md-3'>";
                    echo $form->field($model, 'param' . $ke)->widget(kartik\select2\Select2::classname(), [
                        'hideSearch' => false,
                        'data' => Yii::$app->params[$COLUMN_COMMENT_ARRAY[1]],
                        'options' => ['placeholder' => 'select',
                            'options' => ['id' => "reportgenerator-param".$ke ],
                    
                        ],
                        'pluginOptions' => [
                            'escapeMarkup' => $escape,
                            'allowClear' => true
                        ],
                            ]
                    )->label(".", ['class' => 'label-class']);
                    echo "</div>";
                } else {
                    echo "<div class='col-md-3'>";
                    echo $form->field($model, 'param' . $ke)->textarea(['rows' => 1,'id' => "reportgenerator-param".$ke . '_1'])->label("", ['class' => 'label-class']);
                    echo "</div>";
                }
            } else
            if ($data_type == 'date') {

                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\date\DatePicker::classname(), [
                    'value' => $model->param1,
                    'options' => ['id' => "reportgenerator-param".$ke],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd 00:00:00',
                        'forceParse' =>false,
                        
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div><div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\date\DatePicker::classname(), [
                    'value' => $model->param1,
                    'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd 23:59:59',
                        'forceParse' =>false,
                        
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            } else if ($data_type == 'datetime') {

                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\datetime\DateTimePicker::classname(), [
                    'value' => $model->param2,
                    'options' => ['id' => "reportgenerator-param".$ke],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii:ss',
                        'forceParse' =>false,
                        
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div><div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\datetime\DateTimePicker::classname(), [
                    'value' => $model->param2,
                    'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii:ss',
                        'forceParse' =>false,
                        
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            } else if ($data_type == 'int' ) {
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\number\NumberControl::classname(), [
                            'options' => ['id' => "reportgenerator-param".$ke ],
                    
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\number\NumberControl::classname(), [
                            'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            } else if ($data_type == 'double') {
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\number\NumberControl::classname(), [
                    'options' => ['id' => "reportgenerator-param".$ke ],
                    
                    'maskedInputOptions' => [
                        'groupSeparator' => '',
                        'digits' => 2,
                        'rightAlign' => false
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\number\NumberControl::classname(), [
                    'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    
                    'maskedInputOptions' => [
                        'groupSeparator' => '',
                        'digits' => 2,
                        'rightAlign' => false
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            //} else if ($data_type == 'varchar') {
            } else {
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->textarea(['rows' => 1,'id' => "reportgenerator-param".$ke])->label(".", ['class' => 'label-class']);
                echo "</div>";
            }
            $ke = $ke + 1;
            echo "</div>";
        }
    };
        if ($ajax_mode==0){
            if (isset($filter_advance)) {
                /*
                $filter_advance_data=[];
                foreach ($filter_advance as $fa) {
                    $filter_advance_data[]
                }*/
                echo "<div class='col-md-12'>";
                echo "<div class='col-md-3'>";

                echo $form->field($model, 'param_adv_filter')->widget(kartik\select2\Select2::classname(), [
                    'hideSearch' => false,
                    'data' =>$filter_advance["data"],
                    'options' => ['placeholder' => 'select',
                    ],
                    'pluginOptions' => [
                        'escapeMarkup' => $escape,
                        'allowClear' => true
                    ],
                        ]
                )->label($filter_advance["label"], ['class' => 'label-class']);
                echo "</div></div>";
            }
        }
    
    echo "<div class='col-md-12'>";
    echo "<div class='col-md-2'>";
    echo $form->field($model, 'limit')->widget(kartik\number\NumberControl::classname(), [
        'options' => ['id' => "reportgenerator-limit"],
                    
    ])->label("limit", ['class' => 'label-class']);
    echo "</div></div>";
    ?>



        <div class="form-group">
            <div class='col-md-12'>
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>



    </div>
    <script>
        var column = <?=json_encode($column)?>;
        var use_column =<?=json_encode($use_column)?>;
        
    </script>
    
    
    <?
$js = <<<js
    function updateParameter(){
           var_andWhere="";
           var_andWhere_df="";
           ke=0;
           for (let idx = 0; idx < column.length; idx++) {
               col=column[idx];
               COLUMN_NAME=col['COLUMN_NAME'];
                use_col=use_column[col['COLUMN_ID']];
                if (use_col!=null && use_col['filter_flag'] == 1) {

                //if (col['filter_flag']==1) {
                   param1=$('#reportgenerator-param'+ke).val();
                   param2=$('#reportgenerator-param'+ke+'_2').val();
                   operation=$('#reportgenerator-param'+ke+'_3').val();
                   console.log('[GIBRAN]'+operation);
                   console.log('[FILTER]'+COLUMN_NAME+" "+ke+" "+param1+" "+param2+" "+operation);
                   if (param1!="") {
                       
                       temp_andWhere="";
                       if (operation==0) {
                                if (param1=="null"){
                                    temp_andWhere=COLUMN_NAME+" is null";
                                } else {
                                    temp_andWhere=COLUMN_NAME+"='"+param1+"'";
                                }
                       } else if (operation==1) {
                                if (param1=="null"){
                                    temp_andWhere=COLUMN_NAME+" is not null";
                                } else {
                                    temp_andWhere=COLUMN_NAME+"!='"+param1+"'";
                                }   
                            } else if (operation==2) {
                                temp_andWhere=COLUMN_NAME+">='"+param1+"'";
                                temp_andWhere=temp_andWhere+" and "+COLUMN_NAME+"<='"+param2+"'";
                            } else if (operation==3) {
                                temp_andWhere="not ("+COLUMN_NAME+">='"+param1+"'";
                                temp_andWhere=temp_andWhere+" and "+COLUMN_NAME+"<='"+param2+"')";
                            } else if (operation==4) {
                                temp_andWhere=COLUMN_NAME+">'"+param1+"'";
                            } else if (operation==5) {
                                temp_andWhere=COLUMN_NAME+">='"+param1+"'";
                            } else if (operation==6) {
                                temp_andWhere=COLUMN_NAME+"<'"+param1+"'";
                            } else if (operation==7) {
                                temp_andWhere=COLUMN_NAME+"<='"+param1+"'";
                            } else if (operation==8) {
                                temp_andWhere=COLUMN_NAME+" like '%"+param1+"%'";
                            } else if (operation==9) {
                                temp_andWhere=COLUMN_NAME+"not like '%"+param1+"%'";



                            }
                    if (temp_andWhere!="") {
                        //df_flag=use_col["ref"]["df_flag"];
                        df_flag=use_col["df_flag"];
                        if (df_flag==1) {
                            if (var_andWhere_df!="") {
                               var_andWhere_df=var_andWhere_df+" and "+temp_andWhere;
                            } else {
                                var_andWhere_df=temp_andWhere;
                            }
                        }  else {
                            
                            if (var_andWhere!="") {
                               var_andWhere=var_andWhere+" and "+temp_andWhere;
                            } else {
                                var_andWhere=temp_andWhere;
                            }
                        }
                    };
                            
                       
                   }
                   ke=ke+1;
               }
           }
            var_andWhere
            param1=$('#reportgenerator-limit').val();
            console.log('[FILTER]'+" var_andWhere_df:"+var_andWhere_df+" var_andWhere:"+var_andWhere);
            console.log('[FILTER] limit'+param1+" where"+var_andWhere);
            limit=param1;
            last_index=-1;
            sql_df_where="";
                                
                   
             
        }    
        
    $(".ReportGeneratormodalButtonSavePage").on('click', function () {
            
        
      
            GridSavePage($(this).attr('value'));
   

    
        });
    $(".ReportGeneratorSubmitForm").submit(function(event) {
                        
        console.log('ReportGeneratorSubmitForm');
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        updateParameter();
        
        clearTimeout(timeout_obj);
        console.log('clearTimeout');
        timeout_obj = setTimeout(function () {
                drawChart();
            }, 1000);
        console.log('drawChart');
        return false;

    });
  
js;
$this->registerJs($js);
?>




