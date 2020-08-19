<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
?>


<div class="report-generator-x-form">

    <?
    echo Html::button("<span class='glyphicon glyphicon-filter'></span>", [
        'style' => 'background:none;border:none;padding:5px;color:black',
        'class' => 'grid-action',
        'data-toggle' => 'collapse',
        'data-placement' => 'bottom',
        'data-target' => "#demo",
        'title' => 'Filter'
    ]);
    if ($builder == 0) {
        
        if ($can_update==1){
            echo Html::button("<span class='glyphicon glyphicon-edit'></span>", [
                'value' => Url::to(['//report-generator-x/get-data-report4', 'folder' => $folder, 'report_name' => $report_name,'builder'=>1]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton2 grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Update mode'
            ]);
        }
    } else {
        if ($can_build==1){
            echo Html::button("<span class='glyphicon glyphicon-cog'></span>", [
                'value' => Url::to(['//report-generator-x/get-data-report4', 'folder' => $folder, 'report_name' => $report_name,'builder'=>1]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton2 grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'modification data cube'
            ]);
        }
        echo Html::button("<span class='glyphicon glyphicon-list-alt'></span>", [
                'value' => Url::to(['//report-generator-x/get-data-report4', 'folder' => $folder, 'report_name' => $report_name,'builder'=>0]),
                'style' => 'background:none;border:none;padding:5px;color:black',
                'class' => 'ReportGeneratormodalButton2 grid-action',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'view mode'
            ]);
        echo "<font color='blue'>page:</font>";

        echo Html::button("<span class='glyphicon glyphicon-th-list'></span>", [
            'value' => Url::to(['//report-generator-builder-x/change-page', 'folder' => $folder, 'report_name' => $report_name,]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Change Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder-x/add-page', 'folder' => $folder]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Add Page'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-remove'></span>", [
            'value' => Url::to(['//report-generator-builder-x/delete-page', 'folder' => $folder, 'report_name' => $report_name,]),
            'style' => 'background:none;border:none;padding:5px;color:red',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Delete Page'
        ]);
        echo "<font color='blue'>chart:</font>";
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder-x/add-report', 'folder' => $folder, 'report_name' => $report_name,]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Add Report'
        ]);
        echo Html::button("<span class='glyphicon glyphicon-sort-by-attributes'></span>", [
            'value' => Url::to(['//report-generator-builder-x/sort-report', 'folder' => $folder, 'report_name' => $report_name,]),
            'style' => 'background:none;border:none;padding:5px;color:black',
            'class' => 'ReportGeneratormodalButton grid-action',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => 'Sort Report'
        ]);
        echo "<font color='blue'>filter:</font>";
        
        echo Html::button("<span class='glyphicon glyphicon-plus'></span>", [
            'value' => Url::to(['//report-generator-builder-x/add-filter', 'folder' => $folder, 'report_name' => $report_name,]),
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
                        'value' => Url::to(['//report-generator-builder-x/delete-filter', 'folder' => $folder,'report_name' => $report_name,'idx'=>$col['COLUMN_ID']]),
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
                            'options' => ['id' => "reportgenerator-param".$ke . '_1'],
                    
                        ],
                        'pluginOptions' => [
                            'escapeMarkup' => $escape,
                            'allowClear' => true
                        ],
                            ]
                    )->label("", ['class' => 'label-class']);
                    echo "</div>";
                }
            } else
            if ($data_type == 'date') {

                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\widgets\DatePicker::classname(), [
                    'value' => $model->param1,
                    'options' => ['id' => "reportgenerator-param".$ke."_1"],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div><div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\widgets\DatePicker::classname(), [
                    'value' => $model->param1,
                    'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            } else if ($data_type == 'datetime') {

                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\widgets\DateTimePicker::classname(), [
                    'value' => $model->param2,
                    'options' => ['id' => "reportgenerator-param".$ke."_1"],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii:ss'
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div><div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke . '_2')->widget(kartik\widgets\DateTimePicker::classname(), [
                    'value' => $model->param2,
                    'options' => ['id' => "reportgenerator-param".$ke . '_2'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii:ss'
                    ],
                        ]
                )->label("", ['class' => 'label-class']);
                echo "</div>";
            } else if ($data_type == 'int') {
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->widget(kartik\number\NumberControl::classname(), [
                            'options' => ['id' => "reportgenerator-param".$ke . '_1'],
                    
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
                    'options' => ['id' => "reportgenerator-param".$ke . '_1'],
                    
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
            } else if ($data_type == 'varchar') {
                echo "<div class='col-md-3'>";
                echo $form->field($model, 'param' . $ke)->textarea(['rows' => 1,'id' => "reportgenerator-param".$ke . '_1'])->label("", ['class' => 'label-class']);
                echo "</div>";
            }
            $ke = $ke + 1;
            echo "</div>";
        }
    };
        if ($ajax_mode==0){
            if ($filter_advance != "") {
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
        <?= Html::submitButton('Refresh', ['class' => 'btn btn-success']) ?>
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
           ke=0;
           for (let idx = 0; idx < column.length; idx++) {
               col=column[idx];
               COLUMN_NAME=col['COLUMN_NAME'];
                use_col=use_column[col['COLUMN_ID']];
                if (use_col!=null && use_col['filter_flag'] == 1) {

                //if (col['filter_flag']==1) {
                   param1=$('#reportgenerator-param'+ke+'_1').val();
                   param2=$('#reportgenerator-param'+ke+'_2').val();
                   operation=$('#reportgenerator-param'+ke+'_3').val();
                   console.log('[FILTER]'+ke+" "+param1+" "+param2+" "+operation);
                   if (param1!="") {
                       if (var_andWhere!="") {
                           var_andWhere=var_andWhere+" and";
                       };
                       if (operation==0) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+"='"+param1+"'";
                       } else if (operation==1) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+"!='"+param1+"'";
                            } else if (operation==2) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+">='"+param1+"'";
                                var_andWhere=var_andWhere+" and "+COLUMN_NAME+"<='"+param2+"'";
                            } else if (operation==3) {
                                var_andWhere=var_andWhere+"  not ("+COLUMN_NAME+">='"+param1+"'";
                                var_andWhere=var_andWhere+" and "+COLUMN_NAME+"<='"+param2+"')";
                            } else if (operation==4) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+">'"+param1+"'";
                            } else if (operation==5) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+">='"+param1+"'";
                            } else if (operation==6) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+"<'"+param1+"'";
                            } else if (operation==7) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+"<='"+param1+"'";
                            } else if (operation==8) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+" like '%"+param1+"%'";
                            } else if (operation==9) {
                                var_andWhere=var_andWhere+" "+COLUMN_NAME+"not like '%"+param1+"%'";



                            }
                            
                       
                   }
                   ke=ke+1;
               }
           }
            param1=$('#reportgenerator-limit').val();
            console.log('[FILTER] limit'+param1+" where"+var_andWhere);
            limit=param1;
        last_index=-1
                                
                   
             
        }    
        
        
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




