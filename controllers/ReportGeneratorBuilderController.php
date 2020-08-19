<?php

namespace app\controllers;

use Yii;
use app\models\ReportGenerator;
use yii\web\UploadedFile;

class ReportGeneratorBuilderController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAddPage($folder) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $page = $json["page"];
        /*
          $display_str="";
          $idx=0;
          foreach ($page as $p){
          $display_str=$display_str." page $idx:".$p["name"]."<br>";
          $idx++;
          }; */

        //untuk save 
        /*
          $json["page"]=$page;
          rename($report_file,$report_file.".".date('YmdHis'));
          file_put_contents($report_file, json_encode($json)); */


        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            $page[] = [
                "name" => $model->param0,
                "report" => []
            ];
            $json["page"] = $page;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'message' => 'Model has been saved.',
                ],
                'code' => 0,
            ];
        } else {
            $display_str = "add page?";
            return $this->renderAjax('_active_form_add_page', [
                        "action_name" => "actionAddPage",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model
            ]);
        }
        /*
          return $this->renderAjax('view_ajax',[
          "action_name"=>"actionAddPage",
          "folder"=>$folder,
          "display_str"=>$display_str,



          ]); */
    }

    public function actionChangePage($folder, $report_name) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $page = $json["page"];
        $display_str = "";
        $idx = 0;
        $page2 = [];
        foreach ($page as $key => $p) {
            $page2[$key] = $key . " " . $p["name"];
            $display_str = $display_str . " page $idx:" . $p["name"] . "<br>";
            $idx++;
        }
       
        //remove page 
        /*
          unset($page[$report_name]);
          $json["page"]=$page;
          rename($report_file,$report_file.".".date('YmdHis'));
          file_put_contents($report_file, json_encode($json));
         */


        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $model->param0, 'builder' => 1
            ]);
        } else {
            $display_str = "change page";
            return $this->renderAjax('_active_form_change_page', [
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model,
                        "page" => $page2
            ]);
        }
    }
    
    
    
    public function actionUpdateJson($folder){
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
       /*
        $report_config_json = dirname(__DIR__) . "/config/report_config.json";
        $params_config = file_get_contents($report_config_json);
        $params_config_json = json_decode($params_config,true);
        $clientOptions=[];
        $page=$params_config_json["page"];
        $report=$params_config_json["report"];
        $clientOptions['schema']=json_encode($params_config_json["all"]);
        $clientOptions['modes']= ['code', 'tree'];   
        $clientOptions['schemaRefs']=json_encode(['page'=>$page, 'report'=>$report]);
       */
       
        
       
        $model = new ReportGenerator();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $json=json_decode($model->param6,true);
            $json = $this->fReformat($folder,  $json);
           /*
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                     
                        'json'=>$json,
                      
                    ],
                    'code' => 0,
                ];
            
            */
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
            
        } else {
             $json = json_decode($params,true);
           
            
            
           
            
            $report_config_json = dirname(__DIR__) . "/config/report_config.json";
            $params_config = file_get_contents($report_config_json);
            $params_config_json = json_decode($params_config,true);
            
            $clientOptions=[];
            $params_template=$params_config_json["template"];
             $page_schema=$params_config_json["page"];
            $report_schema=$params_config_json["report"];
            $options=$params_config_json["options"];
            $key=$params_config_json["key"];
            $field=$params_config_json["field"];
            $filter=$params_config_json["filter"];
            $params_report=$params_config_json["all"];
            
            $column1 = [];
            foreach (Yii::$app->params['visual_param'] as $p=>$v) {
                $column1[] = $p;
              
            }
            $report_schema["properties"]["visualization"]["enum"]=$column1;
                    
            $COLUMN_ID=$params_config_json["COLUMN_ID"];
            $use_column=$json["column"];
            $column2 = [];
            
            foreach ($use_column as $p) {
                $column2[] = $p["COLUMN_ID"];
              
            }
            
            
            $COLUMN_ID["enum"]=$column2;
            $data_type=$params_config_json["data_type"];
            $column3 = [];
            foreach (Yii::$app->params['data_type'] as $p=>$v) {
                $column3[] = $p;
              
            }
            $data_type["enum"]=$column3;
            $data_type2=$params_config_json["data_type2"];
            $column4 = [];
            
            foreach (Yii::$app->params['data_type2'] as $p=>$v) {
                $column4[] = $p;
              
            }
            $data_type2["enum"]=$column4;

            $clientOptions['schema']=json_encode($params_report);
            $clientOptions['modes']= ['code', 'tree'];  
            
            $table_alias_array=[];
            $table_alias_array_temp=$json["table_alias_array"];
            foreach ($table_alias_array_temp as $val){
                $table_alias_array[]="t".$val["alias"].".".$val["table_name"];
            }
            
            $page_schema["properties"]["table_join_type"]["items"]["properties"]["table"]["enum"]=$table_alias_array;
            $clientOptions['templates']=json_encode($params_template);
            $clientOptions['schemaRefs']=json_encode([
                    'page'=>$page_schema,
                    'report'=>$report_schema,
                    'options'=>$options, 'key'=>$key,'field'=>$field,
                    'filter'=>$filter,
                    'COLUMN_ID'=>$COLUMN_ID,
                    'data_type'=>$data_type,
                    'data_type2'=>$data_type2,
                ]);
            
            
           
            $model->param6=$params;
           
            return $this->renderAjax('_active_form_edit_json', [
                        "folder" => $folder,
                        "model" => $model,
                        "clientOptions"=>$clientOptions
                   
            ]);
        }
    }

    public function actionJsonReport($folder,$report_name,$idx){
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $json = json_decode(file_get_contents($report_file),true);
        
        
       /*
        $clientOptions['autocomplete']=
        "{
       
            getOptions: function (text, path, input, editor) {

              return ['apple', 'cranberry', 'raspberry', 'pie', 'mango', 'mandarine', 'melon', 'appleton'];
            }
          }";*/
       
        

        $model = new ReportGenerator();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $report=json_decode($model->param6,true);
            $json["page"][$report_name]["report"][$idx]=$report;
            $json = $this->fReformat($folder,  $json);
           /*
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                     
                        'json'=>$json,
                      
                    ],
                    'code' => 0,
                ];
            
            */
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
            
        } else {
            $page = $json["page"][$report_name];
            $report = $page["report"][$idx];
            
            
            $report_config_json = dirname(__DIR__) . "/config/report_config.json";
            $params_config = file_get_contents($report_config_json);
            $params_config_json = json_decode($params_config,true);
            $clientOptions=[];
            $options=$params_config_json["options"];
            $key=$params_config_json["key"];
            $field=$params_config_json["field"];
            $filter=$params_config_json["filter"];
            $params_report=$params_config_json["report"];
            
            $column1 = [];
            foreach (Yii::$app->params['visual_param'] as $p=>$v) {
                $column1[] = $p;
              
            }
            $params_report["properties"]["visualization"]["enum"]=$column1;
                    
            $COLUMN_ID=$params_config_json["COLUMN_ID"];
            $use_column=$json["column"];
            $column2 = [];
            
            foreach ($use_column as $p) {
                $column2[] = $p["COLUMN_ID"];
              
            }
            
            
            
            
            $COLUMN_ID["enum"]=$column2;
            $data_type=$params_config_json["data_type"];
            $column3 = [];
            foreach (Yii::$app->params['data_type'] as $p=>$v) {
                $column3[] = $p;
              
            }
            $data_type["enum"]=$column3;
            $data_type2=$params_config_json["data_type2"];
            $column4 = [];
            
            foreach (Yii::$app->params['data_type2'] as $p=>$v) {
                $column4[] = $p;
              
            }
            $data_type2["enum"]=$column4;

            $clientOptions['schema']=json_encode($params_report);
            $clientOptions['modes']= ['code', 'tree'];  
            $clientOptions['schemaRefs']=json_encode(['options'=>$options, 'key'=>$key,'field'=>$field,
                    'filter'=>$filter,
                    'COLUMN_ID'=>$COLUMN_ID,
                    'data_type'=>$data_type,
                    'data_type2'=>$data_type2,
                ]);
            
            $report_str = json_encode($report);
            $model->param6=$report_str;
           
            return $this->renderAjax('_active_form_edit_json', [
                        "folder" => $folder,
                        "model" => $model,
                        "clientOptions"=>$clientOptions
                   
            ]);
        }
    }  
    
    
    public function actionJsReport($folder,$report_name,$idx){
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $json = json_decode(file_get_contents($report_file),true);
        
        
        

        $model = new ReportGenerator();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $extend_js=$model->param6;
            $json["page"][$report_name]["report"][$idx]["extend_js"]=$extend_js;
           $json = $this->fReformat($folder,  $json);
           /*
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                     
                        'json'=>$extend_js,
                      
                    ],
                    'code' => 0,
                ];
            */
            
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
            
        } else {
            $extend_js = $json["page"][$report_name]["report"][$idx]["extend_js"];
            $use_column = $json["page"][$report_name]["use_column"];
            $param7="//variable list\n";
            foreach ($use_column as $key=>$val) {
                $param7=$param7."//data[".$val["COLUMN_INDEX"]."] ==> ".$val["ref"]["ALIAS_NAME"] ." (id:".$key .")\n";
                
                
            }
            $model->param6=$extend_js;
            $model->param7=$param7."\n\n".'function final_process_report(idx,report,rec_pertama,result_data) {
                console.log("[" + idx + ":load_report] extended java for table init rec_pertama: ",rec_pertama,",rec_data : ", result_data);
                result_data2 = [];
                rec_pertama2 = [];
                    for (let i2 = 0; i2 < report.key.length; i2++) {
                    rec_pertama2.push(rec_pertama[i2]);
                }
                for (let i2 = 0; i2 < report.field.length; i2++) {
                    rec_pertama2.push(rec_pertama[i2 + report.key.length]);
                }
                    for (let i3 = 0; i3 < result_data.length; i3++) {
                    var_value = result_data[i3];
                    result_detail2 = [];
                            for (let i2 = 0; i2 < report.key.length; i2++) {
                                    result_detail2.push(var_value[i2]);
                    }
                    for (let i2 = 0; i2 < report.field.length; i2++) {
                            result_detail2.push(var_value[i2 + report.key.length]);
                    }
                            result_data2.push(result_detail2);
                }
                    result_data = result_data2;
                rec_pertama = rec_pertama2;
                    console.log("[" + idx + ":load_report] extended java for table result: rec_pertama: ",rec_pertama,",rec_data : ", result_data);
               return {
                  rec_pertama:rec_pertama, 
                  result_data:result_data 
               }
            }';
           
            return $this->render('_active_form_edit_js', [
                        "folder" => $folder,
                        "model" => $model,
                        "return_url"=>['//report-generator/get-data-report4',
                                    'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
                                        ]
                   
            ]);
        }
    }  
    
    public function actionJsonPage($folder,$report_name){
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $json = json_decode(file_get_contents($report_file),true);
        
        /*
        
        $report_config_json = dirname(__DIR__) . "/config/report_config.json";
        $params_config = file_get_contents($report_config_json);
        $params_config_json = json_decode($params_config,true);
        $clientOptions=[];
        
        $report=$params_config_json["report"];
        $clientOptions['schema']=json_encode($params_config_json["page"]);
        $clientOptions['modes']= ['code', 'tree'];   
        $clientOptions['schemaRefs']=json_encode([ 'report'=>$report]);*/
        

        $model = new ReportGenerator();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $report=json_decode($model->param6,true);
            $json["page"][$report_name]=$report;
            $json = $this->fReformat($folder,  $json);
           /*
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                     
                        'json'=>$json,
                      
                    ],
                    'code' => 0,
                ];
            
            */
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
            
        } else {
            
           
           
            
            
           
            
            $report_config_json = dirname(__DIR__) . "/config/report_config.json";
            $params_config = file_get_contents($report_config_json);
            $params_config_json = json_decode($params_config,true);
            
            $clientOptions=[];
            $params_template=$params_config_json["template"];
             $page_schema=$params_config_json["page"];
            $report_schema=$params_config_json["report"];
            $options=$params_config_json["options"];
            $key=$params_config_json["key"];
            $field=$params_config_json["field"];
            $filter=$params_config_json["filter"];
            
            
            $column1 = [];
            foreach (Yii::$app->params['visual_param'] as $p=>$v) {
                $column1[] = $p;
              
            }
            $report_schema["properties"]["visualization"]["enum"]=$column1;
                    
            $COLUMN_ID=$params_config_json["COLUMN_ID"];
            $use_column=$json["column"];
            $column2 = [];
            
            foreach ($use_column as $p) {
                $column2[] = $p["COLUMN_ID"];
              
            }
            
            
            $COLUMN_ID["enum"]=$column2;
            $data_type=$params_config_json["data_type"];
            $column3 = [];
            foreach (Yii::$app->params['data_type'] as $p=>$v) {
                $column3[] = $p;
              
            }
            $data_type["enum"]=$column3;
            $data_type2=$params_config_json["data_type2"];
            $column4 = [];
            
            foreach (Yii::$app->params['data_type2'] as $p=>$v) {
                $column4[] = $p;
              
            }
            $data_type2["enum"]=$column4;
            
            $table_alias_array=[];
            $table_alias_array_temp=$json["table_alias_array"];
            foreach ($table_alias_array_temp as $val){
                $table_alias_array[]="t".$val["alias"].".".$val["table_name"];
            }
            
            $page_schema["properties"]["table_join_type"]["items"]["properties"]["table"]["enum"]=$table_alias_array;
            $clientOptions['schema']=json_encode($page_schema);
            $clientOptions['modes']= ['code', 'tree'];  
            $clientOptions['templates']=json_encode($params_template);
            $clientOptions['schemaRefs']=json_encode([
                   
                    'report'=>$report_schema,
                
                    'options'=>$options, 'key'=>$key,'field'=>$field,
                    'filter'=>$filter,
                    'COLUMN_ID'=>$COLUMN_ID,
                    'data_type'=>$data_type,
                    'data_type2'=>$data_type2,
                ]);
            
            
            $report = json_encode($json["page"][$report_name]);
            $model->param6=$report;
           
            return $this->renderAjax('_active_form_edit_json', [
                        "folder" => $folder,
                        "model" => $model,
                        "clientOptions"=>$clientOptions
                   
            ]);
        }
    }   
    public function actionEditPage($folder, $report_name) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $column=$json["column"];
        $table_alias_array=$json["table_alias_array"];
        $page=$json["page"][$report_name];
        $predefine_column=$page["predefine_column"];
        //echo json_encode($predefine_column)."<br>";
        
        $selection_column=[];
        
        //$selected_column=[];
        foreach ($table_alias_array as $val){
            $table_alias='t'.$val['alias'].'.'.$val['table_name'];
            $selection_table[$table_alias]=$table_alias;
            
        }
        foreach ($column as $key=>$val){
            $selection_column[$val["COLUMN_ID"]]=$val["ALIAS_NAME"];
            /*
            $res=array_search($val["COLUMN_ID"],$predefine_column);
            
            if ($res===FALSE) {
                //echo $val["COLUMN_ID"]." not found ".$res." ".$key."<br>";
            } else {
                //echo $val["COLUMN_ID"]." found ".$res." ".$key."<br>";
                $selected_column[]=$key;
            }*/
            
        }
        //echo json_encode($selected_column)."<br>";
        //exit();
        $display_str = "";
        
        

        $model = new ReportGenerator();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $json["page"][$report_name]["name"]=$model->param0;
            $json["page"][$report_name]["limit"]=$model->param1;
            $json["page"][$report_name]["add_where"]=$model->param2;
            $json["page"][$report_name]["order_by"]=$model->param3;
            $json["page"][$report_name]["realtime_url"]=$model->param4;
            $json["page"][$report_name]["dashboard_name"]=$model->param5;
             $json["page"][$report_name]["limit_df"]=$model->param9;
            $json["page"][$report_name]["add_where_df"]=$model->param10;
            $json["page"][$report_name]["order_by_df"]=$model->param11;
            $json["page"][$report_name]["index_field"]=$model->param12;
            $json["page"][$report_name]["detail_table"]=$model->param13;
           
            $image = UploadedFile::getInstance($model, 'param7');
            if ($image!=null) {
                

                //$model->filename = $image->name;
                $ext = end((explode(".", $image->name)));

                $avatar = Yii::$app->security->generateRandomString().".{$ext}";

                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                $path = Yii::$app->params['uploadPath'] . $avatar;
                /*echo $path."<br>";
                echo  $image->name ."<br>";
                exit();*/

                $image->saveAs($path);
                $json["page"][$report_name]["dashboard_backgrond"]='/images/'.$avatar;
            } else {
                //$json["page"][$report_name]["dashboard_backgrond"]="";
            }
            
            
            $json["page"][$report_name]["dashboard_option"]=$model->param6;
           
            $predefine_column=[];
            if ($model->param8!=null){
                foreach ($model->param8 as $val){
                    $predefine_column[]=$val;
                }
            }
            $json["page"][$report_name]["predefine_column"]=$predefine_column;
            $json = $this->fReformat($folder,  $json);
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            /*
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                        'path' => $path,
                        'name'=>$image->name,
                        'image'=>$image,
                    ],
                    'code' => 0,
                ];*/
            
            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
            
        } else {
            $dashboard_list=["_dashboard_chart2a"=>"bootstrap","_dashboard_chart2b"=>"gstack","_dashboard_chart2c"=>"free"];
            $model->param0=$page["name"];
            $model->param1=$page["limit"];
            $model->param2=$page["add_where"];
            $model->param3=$page["order_by"];
            $model->param4=$page["realtime_url"];
            $model->param5=$page["dashboard_name"];
            $model->param6=$page["dashboard_option"];
            $model->param7=$page["dashboard_backgrond"];
            $model->param8=$predefine_column;
            $model->param9=$page["limit_df"];
            $model->param10=$page["add_where_df"];
            $model->param11=$page["order_by_df"];
            $model->param12=$page["index_field"];
            $model->param13=$page["detail_table"];
            $display_str = "change page";
            return $this->renderAjax('_active_form_edit_page', [
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model,
                        "selection_column" => $selection_column,
                        "dashboard_list"=>$dashboard_list,
                        "selection_table"=>$selection_table
            ]);
        }
    }

    public function actionDeletePage($folder, $report_name) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $page = $json["page"];
        $display_str = "";
        $idx = 0;
        $page2 = [];
        foreach ($page as $key => $p) {
            if ($report_name == $key) {
                
            } else {
                $page2[$key] = $key . " " . $p["name"];
            }
            $display_str = $display_str . " page $key:" . $p["name"] . "<br>";
            $idx++;
        }

        //remove page 
        /*
          unset($page[$report_name]);
          $json["page"]=$page;
          rename($report_file,$report_file.".".date('YmdHis'));
          file_put_contents($report_file, json_encode($json));
         */


        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            unset($page[$report_name]);
            $json["page"] = $page;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));

            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $model->param0, 'report_name2' => $report_name, 'builder' => 1
            ]);
        } else {
            $display_str = "change page";
            return $this->renderAjax('_active_form_change_page', [
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model,
                        "page" => $page2
            ]);
        }
    }
    
    public function actionRefreshCube($folder, $report_name) {
        

        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            

            return $this->redirect(['//report-generator/get-data-report4',
                        'folder' => $folder, 'report_name' => $report_name, 'builder' => 1
            ]);
        } else {
            $display_str = "refresh cube";
            return $this->renderAjax('_active_form_confirmation', [
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model
                       
            ]);
        }
    }
    
   
   

    public function actionAddReport($folder, $report_name = 0) {
        $general_param = Yii::$app->params["general_param"];
        $visual_param = Yii::$app->params["visual_param"];
        $data_type = Yii::$app->params["data_type"];
        $data_type2 = Yii::$app->params["data_type2"];
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $page = [];
        foreach ($json["page"] as $key => $value) {
            array_push($page, $value["name"]);
        }
        $report = $json["page"][$report_name]["report"];
        $column = $json["column"];
        $display_str = "Dummy:<br>";
        $idx = 0;
        foreach ($report as $p) {
            $display_str = $display_str . " report $idx:" . $p["name"] . "<br>";
            $idx++;
        }
        // echo "<pre>";print_r($page);die();
        $post_data = Yii::$app->request->post();
        if ($post_data) {
            $report_post = $post_data;
            // echo"<pre>";print_r($report_file);print_r($report_post);die();
            $validate = true;
            $message = "";

            if (isset($report_post["filter"])) {
                foreach ($report_post["filter"] as $key => $value) {
                    if (!isset($value["value"])) {
                        $validate = false;
                        $message = "Filter value cannot be blank";
                    }
                }
            }
            if (!isset($report_post["field"])) {
                $validate = false;
                $message = "Field cannot be blank";
            }
            if (!isset($report_post["key"])) {
                $validate = false;
                $message = "Key cannot be blank";
            }

            if ($report_post["visualization"] != "" && $validate) {
                $vis_var = strtolower($report_post["visualization"]);
                $package = $visual_param[$vis_var];
                if ($package == null) {
                    $package = $visual_param["piechart"];
                };
                $report_post['packages'] = $package["package"];

                $option = $report_post["options"];
                //if ($option==null){
                $report_post["options"] = $package["options"];
                //};
                $report[] = $report_post;
                $json["page"][$report_name]["report"] = $report;
                $json = $this->fReformat($folder,  $json);
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                    ],
                    'code' => 0,
                ];
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => false,
                        'message' => $message,
                    ],
                    'code' => 0,
                ];
            }
        } else {
            $new_report = ["name" => "test", "visualization" => "PieChart", "packages" => "corechart", "size" => 4, "selection_flag" => 1, "data_option" => 1, "sorted" => 0, "sorted_method" => 0, "max_display" => 0, "options" => ["title" => "Real-time chat 2", "chartArea" => ["width" => "80%", "height" => "60%"], "curveType" => "function", "legend" => ["position" => "bottom"], "width" => "100%", "height" => "100%"], "key" => [["name" => "test", "field_no" => 6]], "field" => [["name" => "test", "field_no" => 12, "data_type" => "int", "data_type2" => "count"]]];

            return $this->renderAjax('_active_form_add_report', [
                        "action_name" => "actionAddReport",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "display_str" => $display_str,
                        "column" => $column,
                        "general_param" => $general_param,
                        "visual_param" => $visual_param,
                        "data_type" => $data_type,
                        "data_type2" => $data_type2,
                        "page" => $page,
                        'report' => $new_report,
            ]);
        }
    }

    public function actionAddFilter($folder, $report_name) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);

        $column = $json["page"][$report_name]["use_column"];
        $display_str = "";
        $column2 = [];
        // $idx = 0;
        foreach ($column as $p => $val) {
            if ($val["filter_flag"] == 0) {
                $column2[$p] = $val["ref"]["ALIAS_NAME"];
            }
            //$display_str = $display_str . " column $idx:" . $p["ALIAS_NAME"] . " filter " . $p["filter_flag"] . "<br>";
            // $idx++;
        }
        //Add filter
        /*
          $column[3]["filter_flag"]=1;
          $json["column"]=$column;

          rename($report_file,$report_file.".".date('YmdHis'));
          file_put_contents($report_file, json_encode($json)); */

        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            $column[$model->param0]["filter_flag"] = 1;
            $json["page"][$report_name]["use_column"] = $column;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'message' => 'Model has been saved.',
                ],
                'code' => 0,
            ];
        } else {
            $display_str = "add filter?";
            return $this->renderAjax('_active_form_add_filter', [
                        "action_name" => "actionAddPage",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        //"display_str" => $display_str,
                        "model" => $model,
                        "column" => $column2
            ]);
        }
    }

    public function actionSortReport($folder, $report_name = "report") {

        //var_dump(Yii::$app->request->post());
        //exit();
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $dashboard_name = $json["page"][$report_name]["dashboard_name"];
        $report = $json["page"][$report_name]["report"];
        if ($dashboard_name == "_dashboard_chart2b") {
            $post_data = Yii::$app->request->post();
            $data = $post_data["data"];
            foreach ($data as $dat) {
                $id = $dat["id"];
                $report[$id]["position_x"] = $dat["x"];
                $report[$id]["position_y"] = $dat["y"];
                $report[$id]["size"] = $dat["width"];
                $report[$id]["size2"] = $dat["height"];
            };
            $json["page"][$report_name]["report"] = $report;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'message' => "ok",
                ],
                'code' => 0,
            ];
        } else if ($dashboard_name == "_dashboard_chart2c") {
            $post_data = Yii::$app->request->post();
            $data = $post_data["data"];
            foreach ($data as $dat) {
                $id = $dat["id"];
                $report[$id]["position_x"] = $dat["x"];
                $report[$id]["position_y"] = $dat["y"];
            };
            $json["page"][$report_name]["report"] = $report;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'message' => "ok",
                ],
                'code' => 0,
            ];
        } else {

            $display_str = "";
            $idx = 0;
            $chart = [];
            foreach ($report as $p) {
                $display_str = $display_str . "$idx:" . $p["name"] . "<br>";
                $chart[] = "$idx:" . $p["name"];
                $idx++;
            }
            $post_data = Yii::$app->request->post();
            if ($post_data) {
                $selection = $post_data["selection"];
                $selection_array = explode(",", $selection);
                if (count($report) <= count($selection_array)) {
                    $report2 = [];
                    $idx = 0;
                    foreach ($report as $p) {
                        $report2[] = $report[$selection_array[$idx]];
                        $idx++;
                    }

                    //sort 
                    $json["page"][$report_name]["report"] = $report2;
                    rename($report_file, $report_file . "." . date('YmdHis'));
                    file_put_contents($report_file, json_encode($json));
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'message' => 'Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                } else {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => false,
                            'message' => $selection,
                        ],
                        'code' => 0,
                    ];
                }
            } else {
                return $this->renderAjax('view_sort_chart', [
                            "action_name" => "actionSortReport",
                            "folder" => $folder,
                            "report_name" => $report_name,
                            "display_str" => $display_str,
                            "chart" => $chart,
                ]);
            }
        }
    }

    public function actionEditReport($folder, $report_name = "report", $idx = 0) {
        $general_param = Yii::$app->params["general_param"];
        $visual_param = Yii::$app->params["visual_param"];
        $data_type = Yii::$app->params["data_type"];
        $data_type2 = Yii::$app->params["data_type2"];
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $page = [];
        foreach ($json["page"] as $key => $value) {
            array_push($page, $value["name"]);
        }
        $report = $json["page"][$report_name]["report"];
        $column = $json["column"];
        $display_str = "";
        $display_str = json_encode($report[$idx]);
        // echo "<pre>";print_r($idx);die();

        $post_data = Yii::$app->request->post();
        if ($post_data) {
            $report_post = $post_data;
            // echo"<pre>";print_r($report_file);print_r($report_post);die();
            $validate = true;
            $message = "";

            if (isset($report_post["filter"])) {
                foreach ($report_post["filter"] as $key => $value) {
                    if (!isset($value["value"])) {
                        $validate = false;
                        $message = "Filter value cannot be blank";
                    }
                }
            }
            if (!isset($report_post["field"])) {
                $validate = false;
                $message = "Field cannot be blank";
            }
            if (!isset($report_post["key"])) {
                $validate = false;
                $message = "Key cannot be blank";
            }

            if ($report_post["visualization"] != "" && $validate) {
                $vis_var = strtolower($report_post["visualization"]);
                $package = $visual_param[$vis_var];
                if ($package == null) {
                    $package = $visual_param["piechart"];
                };
                $report_post['packages'] = $package["package"];
                $option = $report_post["options"];
                if ($option == null) {
                    $report_post["options"] = $package["options"];
                };
                $report[$idx] = $report_post;
                $json["page"][$report_name]["report"] = $report;
                $json = $this->fReformat($folder,  $json);
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Model has been saved.',
                    ],
                    'code' => 0,
                ];
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => false,
                        'message' => $message,
                    ],
                    'code' => 0,
                ];
            }
        } else {
            $new_report = $report[$idx];

            return $this->renderAjax('_active_form_edit_report', [
                        "action_name" => "actionEditReport",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "column" => $column,
                        "general_param" => $general_param,
                        "visual_param" => $visual_param,
                        "data_type" => $data_type,
                        "data_type2" => $data_type2,
                        "page" => $page,
                        'report' => $new_report,
            ]);
        }
    }

    public function actionRemoveReport($folder, $report_name = "report", $idx = 0) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $report = $json["page"][$report_name]["report"];
        $display_str = "delete this chart page:" . $report_name . "[" . $report[$idx]["name"] . ":" . $idx . "] ?";
        //$display_str=json_encode($report[$idx]);
        //remove report
        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            //unset($report[$idx]);
            $temp_idx = 0;
            $report2 = [];
            foreach ($report as $rep) {
                if ($temp_idx != $idx) {
                    $report2[] = $rep;
                }
                $temp_idx++;
            }
            $json["page"][$report_name]["report"] = $report2;

            $json = $this->fReformat($folder,  $json);
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            /*
              return $this->renderAjax('_active_form_confirmation_ok',[
              ]); */
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'message' => 'Model has been saved.',
                ],
                'code' => 0,
            ];
        } else {
            return $this->renderAjax('_active_form_confirmation', [
                        "action_name" => "actionRemoveReport",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model
            ]);
        }
    }

    public function actionDeleteFilter($folder, $report_name = "report", $idx = 0) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $column = $json["page"][$report_name]["use_column"];

        $display_str = "";


        //remove report
        $model = new ReportGenerator();

        if ($model->load(Yii::$app->request->post())) {
            $column[$idx]["filter_flag"] = 0;

            $json["page"][$report_name]["use_column"] = $column;
            rename($report_file, $report_file . "." . date('YmdHis'));
            file_put_contents($report_file, json_encode($json));
            /*
              return $this->renderAjax('_active_form_confirmation_ok',[
              ]); */
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'message' => 'Model has been saved.',
                ],
                'code' => 0,
            ];
        } else {
            $display_str = "delete filter?";

            return $this->renderAjax('_active_form_confirmation', [
                        "action_name" => "actionRemoveFilter",
                        "folder" => $folder,
                        "report_name" => $report_name,
                        "idx" => $idx,
                        "display_str" => $display_str,
                        "model" => $model
            ]);
        }
    }

    public function actionReformat($folder) {
        $res = $this->Reformat($folder);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res["page"];
    }

    function Reformat($folder) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        $json = json_decode($params, true);
        $json = $this->fReformat($folder, $json);
        rename($report_file, $report_file . "." . date('YmdHis'));
        file_put_contents($report_file, json_encode($json));
        return $json;
    }

    function fReformat($folder, $json) {
         $chartNo=-1;
        $column = $json["column"];
        foreach ($json["page"] as $report_name => $page) {
            $repall = $page["report"];
            $idx = 0;
            $columnMap = [];
            $columnUse = [];
            $predefine_column = $page["predefine_column"];
            $old_columnUse=$page["use_column"];
            

            foreach ($column as $col) {
                //$col["COLUMN_INDEX"]=$idx;
                $columnMap[$col["COLUMN_ID"]] = $col;
                $idx++;
            }
            $last_field_seq_no = 0;
            if ($predefine_column != null) {
                /*
                  foreach ($predefine_column as $key) {

                  $field_seq_no=$last_field_seq_no;
                  $last_field_seq_no++;
                  $columnUse[$key]=["COLUMN_INDEX"=>$field_seq_no,
                  "ref"=>$columnMap[$key]];

                  } */

                foreach ($predefine_column as $key => $val) {
                    if (is_numeric($key)) {

                        $field_seq_no = $last_field_seq_no;
                        $last_field_seq_no++;
                        $columnUse[$val] = ["COLUMN_INDEX" => $field_seq_no,
                            "ref" => $columnMap[$val],
                            'filter_flag'=>$old_columnUse[$val]['filter_flag'],
                            'df_flag'=>$old_columnUse[$val]['df_flag'],
                            ];
                    } else {
                        $field_seq_no = $last_field_seq_no;
                        $last_field_seq_no++;
                        $columnUse[$key] = ["COLUMN_INDEX" => $field_seq_no,
                            "ref" => $columnMap[$key],
                            'filter_flag'=>$old_columnUse[$key]['filter_flag'],
                            'df_flag'=>$old_columnUse[$key]['df_flag'],];
                    }
                }
            }

           $col_id = $page["index_field"];
           if ($col_id!=null) {
               $col_use = $columnUse[$col_id];
               $col_ref = $columnMap[$col_id];
               if ($col_use === null) {
                    $field_seq_no = $last_field_seq_no;
                    $last_field_seq_no++;
                    $columnUse[$col_id] = ["COLUMN_INDEX" => $field_seq_no,
                            "ref" => $col_ref,
                            'filter_flag'=>$old_columnUse[$col_id]['filter_flag'],
                        'df_flag'=>$old_columnUse[$col_id]['df_flag'],];
                } else {
                    $field_seq_no = $col_use["COLUMN_INDEX"];
                }
           }
            
            
            foreach ($repall as $id_report => $rep) {
                $visualization = strtolower($rep["visualization"]);
                if ($visualization == "cmtable2") {
                    //$repall[$id_report]["selection_flag"] = 0;
                    $repall[$id_report]["view_zone"] = -1;
                    $chartNo=$id_report;
                };
                if ($rep["extend"]==2){
                    $datatable_item_flag="";
                    $datatable_item_data_type="";
                    foreach ($rep["key"] as $id => $key) {
                        if ($key["data_type"]=="date"){
                            $datatable_item_flag=$key["COLUMN_ID"];
                            $datatable_item_data_type=$key["data_type"];
                        }
                    }
                    $repall[$id_report]["datatable_item_flag"]=$datatable_item_flag;
                    $repall[$id_report]["datatable_item_data_type"]=$datatable_item_data_type;
                }

                foreach ($rep["key"] as $id => $key) {
                    $col_id = $key["COLUMN_ID"];
                    if ($col_id == "") {
                        $col_id = $column[$key["field_no"]]["COLUMN_ID"];
                        $repall[$id_report]["key"][$id]["COLUMN_ID"] = $col_id;
                    };
                    $col_use = $columnUse[$col_id];
                    $col_ref = $columnMap[$col_id];
                    if ($col_use === null) {
                        $field_seq_no = $last_field_seq_no;
                        $last_field_seq_no++;
                        $columnUse[$col_id] = ["COLUMN_INDEX" => $field_seq_no,
                            "ref" => $col_ref,
                            'filter_flag'=>$old_columnUse[$col_id]['filter_flag'],
                            'df_flag'=>$old_columnUse[$col_id]['df_flag'],];
                    } else {
                        $field_seq_no = $col_use["COLUMN_INDEX"];
                    }

                    $repall[$id_report]["key"][$id]["field_seq"] = $field_seq_no;
                    if (!isset($repall[$id_report]["key"][$id]["COLUMN_NAME"])) {
                        $repall[$id_report]["key"][$id]["COLUMN_NAME"] = $col_ref["COLUMN_NAME"];
                    }
                    $repall[$id_report]["key"][$id]["df_flag"] = $col_ref["df_flag"];
                }
                foreach ($rep["field"] as $id => $field) {
                    $col_id = $field["COLUMN_ID"];
                    if ($col_id == "") {
                        $col_id = $column[$field["field_no"]]["COLUMN_ID"];
                        $repall[$id_report]["field"][$id]["COLUMN_ID"] = $col_id;
                    };
                    $col_use = $columnUse[$col_id];
                    $col_ref = $columnMap[$col_id];
                    if ($col_use === null) {
                        $field_seq_no = $last_field_seq_no;
                        $last_field_seq_no++;
                        $columnUse[$col_id] = ["COLUMN_INDEX" => $field_seq_no,
                            "ref" => $col_ref,
                            'filter_flag'=>$old_columnUse[$col_id]['filter_flag'],
                            'df_flag'=>$old_columnUse[$col_id]['df_flag'],];
                    } else {
                        $field_seq_no = $col_use["COLUMN_INDEX"];
                    }
                    $repall[$id_report]["field"][$id]["field_seq"] = $field_seq_no;
                    if (!isset($repall[$id_report]["field"][$id]["COLUMN_NAME"])) {
                        $repall[$id_report]["field"][$id]["COLUMN_NAME"] = $col_ref["COLUMN_NAME"];
                    }
                    $repall[$id_report]["field"][$id]["df_flag"] = $col_ref["df_flag"];


                    if ($field["filter"] != null) {
                        foreach ($field["filter"] as $id2 => $filter) {
                            $col_id = $filter["COLUMN_ID"];
                            if ($col_id == "") {
                                $col_id = $column[$filter["field_no"]]["COLUMN_ID"];
                                $repall[$id_report]["field"][$id]["filter"][$id2]["COLUMN_ID"] = $col_id;
                            };
                            $col_use = $columnUse[$col_id];
                            $col_ref = $columnMap[$col_id];
                            if ($col_use === null) {
                                $field_seq_no = $last_field_seq_no;
                                $last_field_seq_no++;
                                $columnUse[$col_id] = ["COLUMN_INDEX" => $field_seq_no,
                                    "ref" => $col_ref,
                                    'filter_flag'=>$old_columnUse[$col_id]['filter_flag'],
                                        'df_flag'=>$old_columnUse[$col_id]['df_flag'],];
                            } else {
                                $field_seq_no = $col_use["COLUMN_INDEX"];
                            }
                            $repall[$id_report]["field"][$id]["filter"][$id2]["field_seq"] = $field_seq_no;
                            if (!isset($repall[$id_report]["field"][$id]["filter"][$id2]["COLUMN_NAME"])) {
                                $repall[$id_report]["field"][$id]["filter"][$id2]["COLUMN_NAME"] = $col_ref["COLUMN_NAME"];
                            }
                            $repall[$id_report]["field"][$id]["filter"][$id2]["df_flag"] = $col_ref["df_flag"];
                        }
                    }
                }
                if ($rep["filter"] != null) {

                    foreach ($rep["filter"] as $id => $filter) {
                        $col_id = $filter["COLUMN_ID"];
                        if ($col_id == "") {
                            $col_id = $column[$filter["field_no"]]["COLUMN_ID"];
                            $repall[$id_report]["filter"][$id]["COLUMN_ID"] = $col_id;
                        };
                        $col_use = $columnUse[$col_id];
                        $col_ref = $columnMap[$col_id];
                        if ($col_use === null) {
                            $field_seq_no = $last_field_seq_no;
                            $last_field_seq_no++;
                            $columnUse[$col_id] = ["COLUMN_INDEX" => $field_seq_no,
                                "ref" => $col_ref,
                                'filter_flag'=>$old_columnUse[$col_id]['filter_flag'],
                                'df_flag'=>$old_columnUse[$col_id]['df_flag'],
                                ];
                        } else {
                            $field_seq_no = $col_use["COLUMN_INDEX"];
                        }
                        $repall[$id_report]["filter"][$id]["field_seq"] = $field_seq_no;
                        if (!isset($repall[$id_report]["filter"][$id]["COLUMN_NAME"])) {
                            $repall[$id_report]["filter"][$id]["COLUMN_NAME"] = $col_ref["COLUMN_NAME"];
                        }
                        $repall[$id_report]["filter"][$id]["df_flag"] = $col_ref["df_flag"];
                    }
                }
            }
            if ($chartNo>=0){
                $json["page"][$report_name]["page_mode"]=1;
                $json["page"][$report_name]["chart_no"]=$chartNo;
                
            } else {
                $json["page"][$report_name]["page_mode"]=0;
            }
            $json["page"][$report_name]["report"] = $repall;
            
            
            $json["page"][$report_name]["use_column"] = $columnUse;
        }
        return $json;
    }

}
