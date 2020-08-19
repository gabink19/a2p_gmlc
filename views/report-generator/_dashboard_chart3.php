<?php

use app\helpers\GoogleChart2;
use app\helpers\CustModule;
use yii\helpers\Html;
use yii\helpers\Url;


                if ($builder==1){
                    echo Html::button("<span class='glyphicon glyphicon-wrench'></span>", [
                                                'value' => Url::to(['//report-generator-builder/edit-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                                'style' => 'background:none;border:none;padding:5px;color:black',
                                                'class' => 'ReportGeneratormodalButton grid-action',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',
                                                'title' => 'Edit Report'
                                    ]);
                    echo Html::button("<span class='glyphicon glyphicon-cog'></span>", [
                                                'value' => Url::to(['//report-generator-builder/js-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                                'style' => 'background:none;border:none;padding:5px;color:black',
                                                'class' => 'ReportGeneratormodalButton2 grid-action',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',
                                                'title' => 'Javascript'
                                    ]);
                    echo Html::button("<span class='glyphicon glyphicon-education'></span>", [
                                                'value' => Url::to(['//report-generator-builder/json-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                                'style' => 'background:none;border:none;padding:5px;color:black',
                                                'class' => 'ReportGeneratormodalButton grid-action',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',
                                                'title' => 'Json Editor(Report)'
                                    ]);
                    echo Html::button("<span class='glyphicon glyphicon-remove'></span>", [
                                                'value' => Url::to(['//report-generator-builder/remove-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                                'style' => 'background:none;border:none;padding:5px;color:red',
                                                'class' => 'ReportGeneratormodalButton grid-action',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',
                                                'title' => 'Remove Report'
                                    ]);
                }
                $rep_option=$rep['options'];
                $rep_option_str=json_encode($rep['options']);
                $rep_option_str = str_replace("@@title@@", $rep['name'], $rep_option_str);
                $rep_option=json_decode($rep_option_str,true);
                $report_icons=$rep['report_icons'];
                if ($report_icons!="") {
                    $rep_option['icons']=Yii::$app->params['report_icons'][$report_icons];
                }
                if ($rep["disable"]) {
                    echo CustModule::widget([
                        'visualization' => "",
                        'selection_flag'=> $rep['selection_flag'],
                        'report'=>$rep,
                        'andWhere'=>$andWhere,
                        'andWhere_df'=>$andWhere_df,
                        'filter_where'=>$filter_where,
                        'filter_where_df'=>$filter_where_df,
                        'limit'=>$limit,
                         'url' => $url,
                        'url2' => $url2,
                        'idx'=>$idx,
                        'folder'=>$folder,
                        'options' => $rep_option,
                        'extend_js' => $rep['extend_js'],
                        'timeout'=>$timeout,
                         "page_mode"=>$page_mode,
                
                        ]);
                } else if ($rep_option['report_type']==1) {
                    $rep_option['title']=[];
                    
                    $rep_option['title']['text']=$rep['name'];
                    echo CustModule::widget([
                        'visualization' => $rep['visualization'],
                        'selection_flag'=> $rep['selection_flag'],
                        'report'=>$rep,
                        'andWhere'=>$andWhere,
                        'andWhere_df'=>$andWhere_df,
                        'filter_where'=>$filter_where,
                        'filter_where_df'=>$filter_where_df,
                        'limit'=>$limit,
                         'url' => $url,
                        'url2' => $url2,
                        'idx'=>$idx,
                        'folder'=>$folder,
                        'options' => $rep_option,
                        'extend_js' => $rep['extend_js'],
                        'timeout'=>$timeout,
                         "page_mode"=>$page_mode,
                     
                        ]);
                } else if ($rep_option['report_type']==2) {
                    $rep_option['title']['text']=$rep['name'];
                    echo CustModule::widget([
                        'visualization' => "CMHighCharts",
                        'selection_flag'=> $rep['selection_flag'],
                        'report'=>$rep,
                       
                        'andWhere'=>$andWhere,
                        'andWhere_df'=>$andWhere_df,
                        'filter_where'=>$filter_where,
                        'filter_where_df'=>$filter_where_df,
                        'limit'=>$limit,
                         'url' => $url,
                        'url_b' => $url_b,
                        'url2' => $url2,
                        'idx'=>$idx,
                        'folder'=>$folder,
                        'options' => $rep_option,
                        'timeout'=>$timeout,
                        'extend_js' => $rep['extend_js'],
                         "page_mode"=>$page_mode,
                       
                        ]);    

                } else {
                    
                   
                    $rep['visualization']=strtolower($rep['visualization']);
                    
                    echo GoogleChart2::widget([
                        //'visualization' => 'LineChart',
                        'visualization' => $rep['visualization'],
                        'selection_flag'=> $rep['selection_flag'],
                        'packages' => $rep['packages'], //default is corechart
                        //'packages' => 'table', //default is corechart

                        'loadVersion' => 1, //default is 1.  As for Calendar, you need change to 1.1
                        //'data' => $b,
                        'url' => $url,
                        'url_b' => $url_b,
                        'url2' => $url2,

                        'timeout'=>$timeout,
                        'report'=>$rep,
                        'andWhere'=>$andWhere,
                        'andWhere_df'=>$andWhere_df,
                        'filter_where'=>$filter_where,
                        'filter_where_df'=>$filter_where_df,
                        'limit'=>$limit,

                        'idx'=>$idx,
                        'folder'=>$folder,

                        'options' => $rep_option,
                        'extend_js' => $rep['extend_js'],
                      
                       
                        ]);
                }


                ?>