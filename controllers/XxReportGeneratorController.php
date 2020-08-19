<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\ReportGenerator;

class XxReportGeneratorController extends \yii\web\Controller {
//t114.g_group_gg_id
//t16.g_group_gg_id
    
    public function actionIndex2() {
        $url_name = "report-generator-x/index";
        $app_name = "report(create)";
        $controllerClass = "ReportGeneratorController";
        $menu1 = 'null';
        $menu2 = 'null';

        $result = Yii::$app->db->createCommand("CALL create_auth_report('" . $controllerClass . "', '" . $controllerClass . "'," . $menu1 . "," . $menu2 . ",'" . $app_name . "','" . $url_name . "');")
                ->execute();
        echo "ok";
        exit();
    }

    public function actionAuthCreateSecurity($folder, $name) {

        $url_name = "report-generator/get-data-report4&folder=" . $folder;
        $folder_array = explode(".", $folder);
        $app_name =  $name ;
        $controllerClass = "ReportGeneratorController";
        $menu1 = 'Reporting';
        $menu2 = 'Report';
        $sql = "CALL create_auth_report2('" . $controllerClass . "', '" . $controllerClass . "','" . $menu1 . "','" . $menu2 . "','" . $app_name . "','" . $url_name . "','" . "." . $folder . "');";
        $result = Yii::$app->db->createCommand($sql)
                ->execute();
    }

    public function actionAuthDeleteSecurity($folder) {

        $url_name = "report-generator/get-data-report4&folder=" . $folder;
        $folder_array = explode(".", $folder);
        $app_name = $folder_array[0];
        $controllerClass = "ReportGeneratorController";
        $result = Yii::$app->db->createCommand("CALL delete_auth_report2('" . $controllerClass . "', '" . $controllerClass . "','Reporting','Report','" . $app_name . "','" . $url_name . "','" . "." . $folder . "');")
                ->execute();
    }

    public function actionGetAllTableData($schema) {
        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = '" . $schema . "';";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll();


        //$val=rand(0,100);
        $d_ref = [];
        foreach ($data as $values) {
            $d_ref[] = $values['table_name'];
        };
        //ii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //$val=rand(0,10)/10*0.01;
        return [
            'table' => $d_ref,
            'code' => 1
        ];
    }

    function getTableData($schema, $table_name, $ke, $ref_column, $detail, &$table_alias, &$table_alias_array, $ref_table_alias,$reculsive_flag=false) {
        $d1 = [];
        $current_table_alias = $table_alias;

        if ($detail == 1) {
            $sql = "SELECT 
                TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND
                REFERENCED_TABLE_NAME = '" . $table_name . "';";
                
            $sql = "SELECT 
                TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND
                TABLE_NAME = '" . $table_name . "';";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sql);
            $data = $command->queryAll();


            //$val=rand(0,100);
            foreach ($data as $values) {
                $alarm_flag = 0;
                $no = $no + 1;
                //$d2=[];
                $table_alias++;
                $val_table_alias = $table_alias;

                $table_alias_array[] = ["table_name" => $values['TABLE_NAME'],
                    "alias" => $val_table_alias,
                ];

                if ($ke < 20) {
                    if ($reculsive_flag) {
                       $d2 = []; 
                    } else {
                        if ($values['TABLE_NAME'] != $table_name) {
                            $d2 = $this->getTableData($schema, $values['TABLE_NAME'], $ke + 1, $values['COLUMN_NAME'], 1, $table_alias, $table_alias_array, $val_table_alias);
                        } else {
                            $d2 = $this->getTableData($schema, $values['TABLE_NAME'], $ke + 1, $values['COLUMN_NAME'], 1, $table_alias, $table_alias_array, $val_table_alias,true);
                        }
                    }
                } else {
                    $d2 = [];
                }
                $d1[] = [
                    'TYPE' => 1,
                    'TABLE_NAME' => $values['TABLE_NAME'],
                    'COLUMN_NAME' => $values['COLUMN_NAME'],
                    'CONSTRAINT_NAME' => $values['CONSTRAINT_NAME'],
                    'REFERENCED_TABLE_NAME' => $values['REFERENCED_TABLE_NAME'],
                    'REFERENCED_COLUMN_NAME' => $values['REFERENCED_COLUMN_NAME'],
                    'ALIAS' => $val_table_alias,
                    'data' => $d2];
                //$d3[]= (int)$values->tsh_param_3;
            };
        };

        $sql = "SELECT 
            TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
        FROM
            INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE
            REFERENCED_TABLE_SCHEMA = '" . $schema . "' AND
            TABLE_NAME = '" . $table_name . "';";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll();


        //$val=rand(0,100);
        $d_ref = [];
        foreach ($data as $values) {
            $alarm_flag = 0;
            $no = $no + 1;
            if ($values['COLUMN_NAME'] != $ref_column) {
                $table_alias++;
                $val_table_alias = $table_alias;
                $table_alias_array[] = ["table_name" => $values['REFERENCED_TABLE_NAME'],
                    "alias" => $val_table_alias,
                ];

                if ($ke < 20) {
                    if ($reculsive_flag) {
                       $d2 = []; 
                    } else {
                        if ($values['REFERENCED_TABLE_NAME'] != $table_name) {
                            $d2 = $this->getTableData($schema, $values['REFERENCED_TABLE_NAME'], $ke + 1, $values['REFERENCED_COLUMN_NAME'], 0, $table_alias, $table_alias_array, $val_table_alias);
                        } else {

                            $d2 = $this->getTableData($schema, $values['REFERENCED_TABLE_NAME'], $ke + 1, $values['REFERENCED_COLUMN_NAME'], 0, $table_alias, $table_alias_array, $val_table_alias,true);
                        }
                    }
                } else {
                    $d2 = [];
                }
                $d_ref[] = [
                    'TABLE_NAME' => $values['TABLE_NAME'],
                    'COLUMN_NAME' => $values['COLUMN_NAME'],
                    'CONSTRAINT_NAME' => $values['CONSTRAINT_NAME'],
                    'REFERENCED_TABLE_NAME' => $values['REFERENCED_TABLE_NAME'],
                    'REFERENCED_COLUMN_NAME' => $values['REFERENCED_COLUMN_NAME'],
                    'ALIAS' => $val_table_alias,
                    'data' => $d2];
            }
            //$d3[]= (int)$values->tsh_param_3;
        };

        $sql = "SELECT COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $schema . "' AND TABLE_NAME = '" . $table_name . "';";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll();


        //$val=rand(0,100);
        foreach ($data as $values) {
            $alarm_flag = 0;
            $no = $no + 1;
            $d_ref_select = [];
            //if ($values['COLUMN_NAME'] != $ref_column) {
            {
                $found = 0;
                foreach ($d_ref as $d_ref_values) {
                    if ($d_ref_values["COLUMN_NAME"] == $values['COLUMN_NAME']) {
                        $d_ref_select = $d_ref_values;
                        $found = 1;
                        break;
                    }
                }
                if ($found == 1) {
                    $d1[] = [
                        'TYPE' => 2,
                        'COLUMN_NAME' => "t" . $current_table_alias . "." . $values['COLUMN_NAME'],
                        'USE' => 0,
                        'COLUMN_TYPE' => "",
                        'ALIAS_NAME' => $table_name . "__" . $values['COLUMN_NAME'],
                        'COLUMN_ID' => "t" . $current_table_alias . "." . $values['COLUMN_NAME'],
                        'DATA_TYPE' => $values['DATA_TYPE'],
                        'COLUMN_COMMENT' => $values['COLUMN_COMMENT'],
                        //'ref'=>$d_ref_select,
                        'REF.TABLE_NAME' => $d_ref_select['TABLE_NAME'],
                        'REF.COLUMN_NAME' => $d_ref_select['COLUMN_NAME'],
                        'REF.CONSTRAINT_NAME' => $d_ref_select['CONSTRAINT_NAME'],
                        'REF.REFERENCED_TABLE_NAME' => $d_ref_select['REFERENCED_TABLE_NAME'],
                        'REF.REFERENCED_COLUMN_NAME' => $d_ref_select['REFERENCED_COLUMN_NAME'],
                        'REF.ALIAS' => $d_ref_select['ALIAS'],
                        'data' => $d_ref_select['data']
                    ];
                } 
                //else {
                    $d1[] = [
                        'TYPE' => 3,
                        'COLUMN_NAME' => "t" . $current_table_alias . "." . $values['COLUMN_NAME'],
                        'ALIAS_NAME' => $table_name . "__" . $values['COLUMN_NAME'],
                        'COLUMN_ID' => "t" . $current_table_alias . "." . $values['COLUMN_NAME'],
                        'USE' => 0,
                        'COLUMN_TYPE' => "",
                        'DATA_TYPE' => $values['DATA_TYPE'],
                        'COLUMN_COMMENT' => $values['COLUMN_COMMENT'],
                    ];
                //}
            }
            //$d3[]= (int)$values->tsh_param_3;
        };
        return $d1;
    }

    public function getSQLData($array_data, $table_name, $table_alias, $detail, &$detail_flag, $selectdistinct, $columnmap, &$LAST_COLUMN_INDEX, $report_restriction, $report_restriction_no,$detail_table,$table_join_type) {
        $val = [];
        $where = [];
        $table = [];
        $val_df = [];
        $where_df = [];
        $table_df = [];
        $table[] = $table_name . " t" . $table_alias;
        $table_df[] = $table_name . " t" . $table_alias;

        foreach ($array_data as $values) {

            $type = $values["TYPE"];
            if ($type == 2) {

                /*
                 
                 bikin duplicate
                $temp_val2 = $columnmap[$values["COLUMN_ID"]];
                if ($temp_val2 != null) {
                    $val[] = [
                        "COLUMN_ID" => $values["COLUMN_ID"],
                        "COLUMN_NAME" => $temp_val2["COLUMN_NAME"],
                        "ALIAS_NAME" => $temp_val2["ALIAS_NAME"],
                        "COLUMN_COMMENT" => $temp_val2["COLUMN_COMMENT"],
                        "COLUMN_INDEX" => $temp_val2["COLUMN_INDEX"],
                        "DATA_TYPE" => $values["DATA_TYPE"],
                        "filter_flag" => $temp_val2["filter_flag"],
                        "test"=>2
                    ];
                };*/
                


                //check
                $report_restriction_param = $report_restriction;
                $temp_add_where = "";
                if ($report_restriction != null) {
                    $report_restriction_table = $report_restriction["table"];
                    if ($report_restriction_table != null) {
                        if (count($report_restriction_table) > $report_restriction_no) {

                            if ($report_restriction_table[$report_restriction_no] == $values["REF.REFERENCED_TABLE_NAME"]) {
                                $report_restriction_no++;
                                if (count($report_restriction_table) == $report_restriction_no) {
                                    //add where
                                    $temp_add_where = 't' . $values['REF.ALIAS'] . "." . $report_restriction['field_name'];
                                    $where[] = $temp_add_where;
                                    $report_restriction_param = null;
                                    //echo $temp_add_where;
                                    //exit();
                                }
                                $report_restriction = null;
                            } else {
                                $report_restriction_param = null;
                            }
                        } else {
                            $report_restriction_param = null;
                        }
                    }
                }
                $res = $this->getSQLData($values['data'], $values["REF.REFERENCED_TABLE_NAME"], $values['REF.ALIAS'], 0, $detail_flag, $selectdistinct, $columnmap, $LAST_COLUMN_INDEX, $report_restriction_param, $report_restriction_no,$detail_table,$table_join_type);
                $flag = 0;
                foreach ($res['column'] as $val_value) {
                    $val[] = $val_value;
                    $flag = 1;
                }
                if ($flag == 1 || $temp_add_where != "") {
                    
                    
                    $where_temp='t' . $table_alias . "." . $values["REF.COLUMN_NAME"] . "=t" . $values["REF.ALIAS"] . "." . $values["REF.REFERENCED_COLUMN_NAME"];
                    $table_temp="t" . $values['REF.ALIAS'].".".$values["REF.REFERENCED_TABLE_NAME"];
                    //echo $table_temp;
                    //exit();
                    $table_join_type_rec=$table_join_type[$table_temp];
                    if (isset($table_join_type_rec)) {
                        $res['table'][0]=$res['table'][0]." on ".$where_temp;
                    } else {
                        //$where[] =$where_temp ;
                        $res['table'][0]=" inner join ".$res['table'][0]." on ".$where_temp;
                    }
                    //$where[] =$where_temp ;
                    foreach ($res['where'] as $val_value) {
                        $where[] = $val_value;
                    }
                    foreach ($res['table'] as $val_value) {
                        $table[] = $val_value;
                    }
                }
            } else if ($type == 3) {

                $temp_val2 = $columnmap[$values["COLUMN_ID"]];
                if ($temp_val2 != null) {
                    if ($selectdistinct != "") {
                        if ($selectdistinct == $temp_val2["COLUMN_NAME"]) {
                            $val[] = [
                                "COLUMN_ID" => $values["COLUMN_ID"],
                                "COLUMN_NAME" => $temp_val2["COLUMN_NAME"],
                                "ALIAS_NAME" => $temp_val2["ALIAS_NAME"],
                                "COLUMN_COMMENT" => $temp_val2["COLUMN_COMMENT"],
                                "COLUMN_INDEX" => $temp_val2["COLUMN_INDEX"],
                                "DATA_TYPE" => $values["DATA_TYPE"],
                                "filter_flag" => $temp_val2["filter_flag"]
                            ];
                        }
                    } else {
                        $val[] = [
                            "COLUMN_ID" => $values["COLUMN_ID"],
                            "COLUMN_NAME" => $temp_val2["COLUMN_NAME"],
                            "ALIAS_NAME" => $temp_val2["ALIAS_NAME"],
                            "COLUMN_COMMENT" => $temp_val2["COLUMN_COMMENT"],
                            "COLUMN_INDEX" => $temp_val2["COLUMN_INDEX"],
                            "DATA_TYPE" => $values["DATA_TYPE"],
                            "filter_flag" => $temp_val2["filter_flag"],
                            "test"=>"1"
                        ];
                    }
                };
            } else if ($type == 1) {
                $add_where = $values["WHERE"];
                if ($detail == 1 || $add_where != "") {
                    $add_where = $values["WHERE"];
                    if ($detail_flag == 0 || $add_where != "") {
                        //if ($values["detail_flag"] == 1) {
                        if ($detail_table=="t".$values['ALIAS'].".".$values["TABLE_NAME"]) { 
                            
                            $res = $this->getSQLData($values['data'], $values["TABLE_NAME"], $values['ALIAS'], 1, $detail_flag, $selectdistinct, $columnmap, $LAST_COLUMN_INDEX, null, 0,$detail_table,$table_join_type);
                            $flag = 0;
                            
                            foreach ($res['column'] as $val_value) {
                                $val_df[] = $val_value;
                                $flag = 1;
                            }
                            if ($flag == 1) {
                                //echo json_encode($res);
                                //exit();
                                $master_detail_id_str = 't' . $table_alias . "." . $values["REFERENCED_COLUMN_NAME"];
                                if (strpos($values["ALIAS"], ".")) {
                                    $master_detail_id_str2 = $values["COLUMN_NAME"];
                                } else {
                                    $master_detail_id_str2 = "t" . $values["ALIAS"] . "." . $values["COLUMN_NAME"];
                                }
                                /*
                                echo $master_detail_id_str."<br>";
                                echo $master_detail_id_str2."<br>";
                                exit();*/
                                


                                $where_df[] = [$columnmap[$master_detail_id_str], $columnmap[$master_detail_id_str2]];
                                foreach ($res['where'] as $val_value) {
                                    $where_df[] = $val_value;
                                }
                                foreach ($res['table'] as $val_value) {
                                    $table_df[] = $val_value;
                                }
                                $detail_flag = 1;
                                //var_dump($where_df);
                                //exit();
                            }
                        } else {
                            $res = $this->getSQLData($values['data'], $values["TABLE_NAME"], $values['ALIAS'], 1, $detail_flag, $selectdistinct, $columnmap, $LAST_COLUMN_INDEX, null, 0,$detail_table,$table_join_type);
                            $flag = 0;
                            $temp_column_df=$res["column_df"];
                            if (isset($temp_column_df)) {
                                $val_df=$res["column_df"];
                                $where_df=$res["where_df"];
                                $table_df=$res["table_df"];       
                            }
                            
                            foreach ($res['column'] as $val_value) {
                                $val[] = $val_value;
                                $flag = 1;
                            }
                            if ($flag == 1) {
                                if (strpos($values["ALIAS"], ".")) {
                                    $where_temp = 't' . $table_alias . "." . $values["REFERENCED_COLUMN_NAME"] . "=" . $values["COLUMN_NAME"];
                                } else {
                                    $where_temp = 't' . $table_alias . "." . $values["REFERENCED_COLUMN_NAME"] . "=t" . $values["ALIAS"] . "." . $values["COLUMN_NAME"];
                                }
                                
                                $table_temp="t" . $values['ALIAS'].".".$values["TABLE_NAME"];
                                
                                $table_join_type_rec=$table_join_type[$table_temp];
                                if (isset($table_join_type_rec)) {
                                    $res['table'][0]=" ".$table_join_type_rec["join_type"]." join ".$res['table'][0]." on ".$where_temp;
                                    //unset($res['table'][0]);
                                } else {
                                    //$where[] =$where_temp ;
                                    //$res['table'][0]=",".$res['table'][0];
                                    $res['table'][0]=" inner join ".$res['table'][0]." on ".$where_temp;
                                    
                                }
                                
                                
                                

                                foreach ($res['where'] as $val_value) {
                                    $where[] = $val_value;
                                }
                                foreach ($res['table'] as $val_value) {
                                    $table[] = $val_value;
                                }
                               //echo json_encode($table)."<br>";
                               // echo json_encode($where)."<br>";
                                
                                //exit();
                                if ($add_where == "") {
                                    $detail_flag = 1;
                                } else {
                                    foreach ($add_where as $add_where_detail) {
                                        $temp_add_where = 't' . $values['ALIAS'] . "." . $add_where_detail[0] . "=" . $add_where_detail[1];
                                        $where[] = $temp_add_where;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        return [
            'column' => $val,
            'where' => $where,
            'table' => $table,
            'column_df' => $val_df,
            'where_df' => $where_df,
            'table_df' => $table_df,
            'code' => 1,
        ];
    }
    
    public function actionRefreshCube($folder){
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $json = json_decode(file_get_contents($report_file),true);
        
        if ($json["table_name"]!="") {
            $res=$this->actionGetDataReport("",$json["table_name"]);
            if (isset($res)) {
                $table_alias_array=$json["table_alias_array"];
                foreach ($res["table_alias_array"] as $key=>$val){
                    $val2=$table_alias_array[$key];
                    
                    if ($val2["table_name"]!=$val["table_name"]) {
                        return [
                            "code"=>-4,
                            "old"=>$val,
                            "new"=>$val2

                        ];
                        
                    };
                    if ($val2["alias"]!=$val["alias"]) {
                        return [
                            "code"=>-4,
                            "old"=>$val,
                            "new"=>$val2

                        ];
                        
                    };
                }
                $json["data"]=$res["data"];
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));
                
                /*
                if (json_encode($res["table_alias_array"])==json_encode($json["table_alias_array"])) {
                    return $res; 
                } else {
                    
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        "code"=>-3,
                        "old"=>$json["table_alias_array"],
                        "new"=>$res["table_alias_array"]
                            
                    ];
                }*/
                return $res;
            } else {
                $res_code=-2;
            }
        } else {
           $res_code=-1; 
        };
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            "code"=>$res_code
        ];
    }
    

    public function actionGetDataReport($schema="", $table_name, $detail = 1, $table_alias = 1, $folder = "", $replace_flag = 0) {
        $start_table_alias = $table_alias;
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        if ($schema=="") $schema= Yii::$app->params["report_schema"];
        if ($folder == "" or ! file_exists($report_file)) {
            $no = 0;
            $table_alias_array[] = ["table_name" => $table_name,
                "alias" => $table_alias,
            ];
            $d1 = $this->getTableData($schema, $table_name, 0, "", $detail, $table_alias, $table_alias_array, 1);


            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            //$val=rand(0,10)/10*0.01;
            $val = 0;
            $param = [
                'data' => $d1,
                'code' => 1,
                'table_name' => $table_name,
                'table_name_alias' => $start_table_alias,
                'total_table_alias' => $table_alias,
                'table_alias_array' => $table_alias_array,
            ];
            if ($folder != "") {
                file_put_contents($report_file, json_encode($param));
            }
            return $param;
        } else {
            $params = file_get_contents($report_file);
            $json = json_decode($params, true);
            if ($replace_flag == 1) {
                $d1 = $this->getTableData($schema, $table_name, 0, "", $detail, $table_alias, $table_alias_array, 1);
                $json['data'] = $d1;
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $json;
        }
    }

    public function actionConvertMap() {

        $report_file = dirname(__DIR__) . "/config/mapbox_geo_source.json";
        $report_file2 = dirname(__DIR__) . "/config/mapbox_geo.json";
        $params2 = file_get_contents($report_file);
        $json2 = json_decode($params2, true);
        $json_array=$json2["features"];
        $json=[];
        foreach ($json_array as $val){
            $coor=$val["geometry"];
            $name=$val["properties"]["STATE_NAME"];
            $json[$name]=$coor;
        };
        
        
        file_put_contents($report_file2, json_encode($json));
        
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
    }
    public function actionSaveDataReport($folder, $obj_name) {

        $report_file = dirname(__DIR__) . "/report/" . $folder;

        $request = Yii::$app->request;
        $params2 = file_get_contents($report_file);
        //$params    = $request->post();
        //$params = $request->getRawBody();
        $params = $request->getRawBody();
        $json = json_decode($params, true);
        $json2 = json_decode($params2, true);
        $json2[$obj_name] = $json;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        rename($report_file, $report_file . "." . date('YmdHis'));
        file_put_contents($report_file, json_encode($json2));

        return $json2;
    }

    public function actionSaveDataReport2($folder, $obj_name, $param) {

        $report_file = dirname(__DIR__) . "/report/" . $folder;

        $request = Yii::$app->request;
        $params2 = file_get_contents($report_file);
        $json2 = json_decode($params2, true);
        $json2[$obj_name] = $param;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        rename($report_file, $report_file . "." . date('YmdHis'));
        file_put_contents($report_file, json_encode($json2));

        return $json2;
    }

    public function actionGetDataReport2($folder, $selectdistinct = "", $report_name, $add_where2 = "", $limit = "", $save_flag = 0, $select_no = 0, $last_index = -1, $add_where2_df = "",$debug_flag=0) {

        if ($debug_flag==1) Yii::debug("[actionGetDataReport2]");
        
        $request = Yii::$app->request;
        $detail_flag = 0;
        //$params    = $request->post();
        //$params = $request->getRawBody();
        if ($folder == "") {
            $params = $request->getRawBody();
        } else {
            $report_file = dirname(__DIR__) . "/report/" . $folder;
            $params = file_get_contents($report_file);
        }



        $json = json_decode($params, true);
        
        $dump_data=$json["dump_data"];
        if (isset($dump_data)) {
            return $json;
        }

        $use_column = $json["page"][$report_name]["use_column"];
        //echo "use_column:".$use_column;
        //exit();
        $table_name = $json['table_name'];
        $table_name_alias = $json['table_name_alias'];
        if ($table_name_alias == 0) {
            $table_name_alias = 1;
        }
        $select_no = \Yii::$app->session["select_no"];
        if ($select_no == "") {
            $select_no = 0;
        }
        //$select_no=1;
        //\Yii::$app->session["select_value"]=3;


        $report_restriction = Yii::$app->params["report_restriction"][$table_name][$select_no];
        $array_data = $json['data'];
        //$limit = $json['limit'];
        
        $add_where = $json["page"][$report_name]['add_where'];
        $add_where_df = $json["page"][$report_name]['add_where_df'];
        $order_by = $json["page"][$report_name]['order_by'];
        $order_by_df = $json["page"][$report_name]['order_by_df'];
        $index_field = $json["page"][$report_name]['index_field'];
        $detail_table= $json["page"][$report_name]['detail_table'];
        $table_join_type_temp= $json["page"][$report_name]['table_join_type'];
        $table_join_type=[];
        if (isset($table_join_type_temp)) {
            foreach ( $table_join_type_temp as $val){
                $table_join_type[$val["table"]]=$val;
            }
        }
        $column = $json['column'];
        $columnmap = array();
        $not_use_columnmap = array();
        $LAST_COLUMN_INDEX = 0;

        if ($column != null) {
            foreach ($column as $val) {
                if ($val["COLUMN_INDEX"] > $LAST_COLUMN_INDEX) {
                    $LAST_COLUMN_INDEX = $val["COLUMN_INDEX"];
                }

                if ($use_column != null) {
                    $temp_use_column = $use_column[$val["COLUMN_ID"]];
                    if ($temp_use_column === null) {
                        //$val['COLUMN_NAME']="1";
                        //$not_use_columnmap[] = $val; 
                    } else {
                        $val["COLUMN_INDEX"] = $temp_use_column["COLUMN_INDEX"];
                        $columnmap[$val["COLUMN_ID"]] = $val;
                        //$val['COLUMN_NAME']="1";
                        //$not_use_columnmap[] = $val;
                    }
                } else {

                    $columnmap[$val["COLUMN_ID"]] = $val;
                }

                //if not use set to 0
            }
        }
        /*
          if ($add_where != "")
          $add_where = " and " . $add_where;

          if ($add_where2 != ""){
          $add_where = $add_where." and " . $add_where2;

          }
          if ($last_index>0 && $index_field!="") {
          $add_where = $add_where." and ".$index_field.">".$last_index;

          }; */


        if ($add_where2 != "") {
            if ($add_where == "") {
                $add_where = $add_where2;
            } else {
                $add_where = $add_where . " and " . $add_where2;
            }
        }
        $add_where_index = "";
        if ($last_index > 0 && $index_field != "") {
            $add_where_index = $index_field . ">" . $last_index;
        };

        if ($order_by != "")
            $order_by = " order by " . $order_by;

        $report_restriction_where = null;
        $report_restriction_table = $report_restriction["table"];
        //if ($report_restriction != null && $report_restriction_table != null) {
        if ($report_restriction != null) {
            if (count($report_restriction_table) == 0) {
                if ($report_restriction["field_name"] != "") {
                    $report_restriction_where = 't' . $table_name_alias . "." . $report_restriction['field_name'];
                    //echo $report_restriction_where;
                    //exit();               
                }
                $report_restriction = null;
            }
        }
        /*
          if ($report_restriction_table != null){
          echo "report_restriction_table!=null<br>";
          }
          echo $report_restriction_table."<br>";
          echo $table_name. " : ".$select_no." <br>";
          echo $table_name_alias." <br>";
          echo json_encode($report_restriction)." <br>";
          echo $report_restriction_where;
          exit(); */

        $res = $this->getSQLData($array_data, $table_name, $table_name_alias, 1, $detail_flag, $selectdistinct, $columnmap, $LAST_COLUMN_INDEX, $report_restriction, 0,$detail_table,$table_join_type);
        //echo json_encode($res)."<br>";
        //exit();
        
        //add column not used.
        foreach ($not_use_columnmap as $val) {
            $res["column"][] = $val;
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($selectdistinct != "") {
            $select = "select distinct ";
        } else {
            $select = "select ";
        }



        usort($res["column"], function($a, $b) {
            return $a['COLUMN_INDEX'] <=> $b['COLUMN_INDEX'];
        });
        $select_arr = [];
        foreach ($res["column"] as $val) {

            if ($first == 0) {
                
            } else {
                $select = $select . ",";
            }
            $first = 1;
            $select = $select . $val['COLUMN_NAME'] . " " . $val['ALIAS_NAME'];

            $select_arr[] = ['name' => $val['COLUMN_NAME'],
                'alias' => $val['ALIAS_NAME']];
        };
        $select2 = " from ";
        $first = 0;

        foreach ($res["table"] as $val) {
            /*
            if ($first == 0) {
                
            } else {
                
                $select2 = $select2 . ",";
            }
            $first = 1;*/
            $select2 = $select2 . $val;
        };
        if ($report_restriction_where != null) {
            $res["where"][] = $report_restriction_where;
        }
        if (count($res["where"]) > 0) {
            $select2 = $select2 . " where ";
            $first = 0;
            foreach ($res["where"] as $val) {
                if ($first == 0) {
                    
                } else {
                    $select2 = $select2 . " and ";
                }
                $first = 1;
                $select2 = $select2 . $val;
            };
        }
        if ($selectdistinct != "") {
            
        } else {
            if (count($res["column_df"]) == 0) {
                if ($add_where_index != "") {
                    if ($add_where != "") {
                        $add_where = $add_where . " and " . $add_where_index;
                    } else {
                        $add_where = $add_where_index;
                    }
                }

                if ($index_field != "") {
                    if ($order_by == "") {
                        $order_by = " order by " . $index_field . " desc";
                    } else {
                        $order_by = $order_by . "," . $index_field . " desc";
                    }
                }
            }
            if (count($res["where"]) == 0) {
                if ($add_where != "") {
                    $select2 = $select2 . " where ";
                }
            } else {
                if ($add_where != "") {
                    $select2 = $select2 . " and ";
                }
            }

            $limit_str = $limit;
            if ($limit_str == "")
                $limit_str = $json["page"][$report_name]["limit"];
            if ($limit_str != "")
                $limit_str = " limit " . $limit_str;
            $select2 = $select2 . $add_where;
            $select3 = $order_by . $limit_str;
        }
        //update detail 
        if (count($res["column_df"]) > 0) {
            $select_df = "select ";
            usort($res["column_df"], function($a, $b) {
                return $a['COLUMN_INDEX'] <=> $b['COLUMN_INDEX'];
            });


            /*
              $first = 0;

              foreach ($res["column_df"] as $val) {

              if ($first == 0) {

              } else {

              $select_df = $select_df . ",";
              }
              $first = 1;
              $select_df = $select_df . $val['COLUMN_NAME'] . " " . $val['ALIAS_NAME'];
              //$select_df[]=['name'=>$val['COLUMN_NAME'],'alias'=> $val['ALIAS_NAME']];
              };
              $select_df = $select_df . " from ";
             */
            $select_df = [];
            foreach ($res["column_df"] as $val) {

                $select_df[] = ['name' => $val['COLUMN_NAME'], 'alias' => $val['ALIAS_NAME']];
            };

            $select_df4="";
            $first = 0;
            foreach ($res["table_df"] as $val) {
                /*
                  if ($first == 0) {

                  } else {
                  $select_df = $select_df . ",";
                  } */

                if ($first == 1) {
                    //if ($select_df4!="") $select_df4=$select_df4.",";
                    $select_df4 = $select_df4 . $val;
                    //$select_df4 = $val;
                }
                
                $first = 1;
            };
            /*
              if ($report_restriction_where != null) {
              $res["where"][] = $report_restriction_where;
              } */
            /*
              if (count($res["where_df"]) > 0) {
              $select_df = $select_df . " where ";
              $first = 0;
              foreach ($res["where_df"] as $val) {
              if ($first == 0) {

              } else {
              $select_df = $select_df . " and ";
              }
              $first = 1;
              $select_df = $select_df . $val;
              };
              } */
            if ($add_where_index != "") {
                if ($add_where_df != "") {
                    $add_where_df = $add_where_df . " and " . $add_where_index;
                } else {
                    $add_where_df = $add_where_index;
                }
            }
            if ($order_by_df != "")
                $order_by_df = " order by " . $order_by_df;
            if ($index_field != "") {
                if ($order_by_df == "") {
                    $order_by_df = " order by " . $index_field . " desc";
                } else {
                    $order_by_df = $order_by_df . " " . $index_field . " desc";
                }
            }

            if ($add_where2_df != "") {
                if ($add_where_df == "") {
                    $add_where_df = $add_where2_df;
                } else {
                    $add_where_df = $add_where_df . " and " . $add_where2_df;
                }
            }
            if ($selectdistinct != "") {
                
            } else {
                /*
                  if (count($res["where"]) == 0) {
                  if ($add_where != "") {
                  $select = $select . " where ";
                  }
                  } else {
                  if ($add_where != "") {
                  $select = $select . " and ";
                  }
                  } */

                $limit_df = $limit;
                if ($limit_df == "")
                    $limit_df = $json["page"][$report_name]["limit_df"];
                if ($limit_df != "")
                    $limit_df = " limit " . $limit_df;


                //$select_df3 = $order_by_df . $limit_df;
            }
        }

        $json["column"] = $res["column"];
        $json["where"] = $res["where"];
        $json["table"] = $res["table"];
        $json["column_df"] = $res["column_df"];
        $json["where_df"] = $res["where_df"];
        $json["table_df"] = $res["table_df"];

        $json["select"] = $select;
        $json["select2"] = $select2;
        $json["select3"] = $select3;

        $json["select_df"] = $select_df;
        $json["select_df2"] = $add_where_df;
        //$json["select_df3"] = $select_df3;
        $json["order_by_df"] = $order_by_df;
        $json["limit_df"] = $limit_df;
        
        $json["select_df4"] = $select_df4;
        $json["use_column"] = $use_column;
        $json["select_arr"] = $select_arr;
        $json["extend"]=$json["page"][$report_name]["extend"];
        $json["extend_value"]=$json["page"][$report_name]["extend_value"];
        if ($folder != "") {

            if ($save_flag == 1) {
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));
            }
        }

        return $json;
    }

    public function actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, $d1, $master_detail_index_str, $master_detail_index2_str,&$master_detail_index_str_b, &$master_detail_index2_str_b) {
        return $values[$val['ALIAS_NAME']];
    }

    public function actionGetDataReportAdd(&$d1, $d2, $values, $master_detail_index_str, $master_detail_index2_str,&$master_detail_index_str_b, &$master_detail_index2_str_b) {

        $d1[$values[$master_detail_index_str]] = $d2;
    }

    public function actionGetDataReport3Reg($res, &$master_detail_index_str, &$master_detail_index2_str,&$master_detail_index_str_b, &$master_detail_index2_str_b) {
        $master_detail_index_str = $res["where_df"][0][0]["ALIAS_NAME"];
        $master_detail_index_str_b = $res["where_df"][0][1]["ALIAS_NAME"];
        return 1;
    }

    //https://icloud.icode.id/index.php?r=report-generator%2Fget-data-report3&folder=test_bulk_data.json&report_name=0&datatableflag=1&draw=2&columns%5B0%5D%5Bdata%5D=0&columns%5B0%5D%5Bname%5D=&columns%5B0%5D%5Bsearchable%5D=false&columns%5B0%5D%5Borderable%5D=false&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=1&columns%5B1%5D%5Bname%5D=&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=2&columns%5B2%5D%5Bname%5D=&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=3&columns%5B3%5D%5Bname%5D=&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=4&columns%5B4%5D%5Bname%5D=&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=5&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=6&columns%5B6%5D%5Bname%5D=&columns%5B6%5D%5Bsearchable%5D=false&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&start=0&length=10&search%5Bvalue%5D=&search%5Bregex%5D=false&_=1587005006484

    public function actionGetDataReport3($folder = "", $selectdistinct = "", $report_name = 0, $filter_where = "", $filter_where_df = "", $add_where2 = "", $add_where2_df = "", $limit = "", $last_index = -1, $sql_df_where = "", $datatableflag = 0, $simul = 0,$debug_flag=0) {
        /*
          $request = Yii::$app->request;
          $params    = $request->post();
          $datatable_start=$params["start"];
          $datatable_length=$params["length"]; */
       if ($debug_flag==1) Yii::debug("[actionGetDataReport3]");
                
        $df_flag = 0;



        if ($filter_where != "") {
            if ($add_where2 != "")
                $filter_where = $filter_where . " and " . $add_where2;
        } else {
            if ($add_where2 != "")
                $filter_where = $add_where2;
        }
        if ($filter_where_df != "") {
            if ($add_where2_df != "")
                $filter_where_df = $filter_where_df . " and " . $add_where2_df;
        } else {
            if ($add_where2_df != "")
                $filter_where_df = $add_where2_df;
        }

        $res = $this->actionGetDataReport2($folder, $selectdistinct, $report_name, $filter_where, $limit, 0, 0, $last_index, $filter_where_df,$debug_flag);
        $dump_data=$res["dump_data"];
        if (isset($dump_data)){
            if ($datatableflag == 1) {
                $request = Yii::$app->request;
                $params = $request->post();
                if (isset($params)) {
                    $start = $params['start'];
                    $length = $params['length'];
                    if ($length>0) {
                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        $report_file_data = dirname(__DIR__) . "/report/" . "data_table_".$folder;
                        $params_data = file_get_contents($report_file_data);
                        $json_data = json_decode($params_data, true);
                        return  $json_data;
                    
                    }
               
                }
            };
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $report_file_data = dirname(__DIR__) . "/report/" . "data_".$folder;
            $params_data = file_get_contents($report_file_data);
            $json_data = json_decode($params_data, true);
            return  $json_data;
            
        }



       
        
        
        $report = $res["page"][$report_name]["report"];

        /* echo $res["select_df2"]."<br>";
          echo $filter_where_df."<br>";
          exit(); */
        $index_field = $res['index_field'];
        $new_last_index = -1;

        $d1 = [];
        $d1_df = [];
        $d2 = [];
        //echo \Yii::$app->session["select_value"];
        //exit();

        foreach ($res["column"] as $val) {
            $d2[] = $val['ALIAS_NAME'];
        };
        $d1[] = $d2;

        $d2 = [];
        foreach ($res["column_df"] as $val) {
            $d2[] = $val['ALIAS_NAME'];
        };
        $d1_df[] = $d2;


        $sql_array = [];
        $variable_param = $res['variable_param'];
        if ($variable_param == "") {
            $variable_param = [];
            $variable_param[] = ["@@test@@" => "1"];
        }
        $sql_array_df = null;
        /*
          if ((count($res["column_df"]))>0){
          $d1_df = [];
          $d2_df = [];
          //echo \Yii::$app->session["select_value"];
          //exit();

          foreach ($res["column_df"] as $val) {
          $d2_df[] = $val['ALIAS_NAME'];
          };
          $d1_df[] = $d2_df;

          $sql_array_df = [];


          } */
        $sql_df = $res['select_df'];
        if ($sql_df != "") {
            $df_flag = $this->actionGetDataReport3Reg($res, $master_detail_index_str, $master_detail_index2_str,$master_detail_index_str_b, $master_detail_index2_str_b);
        }
        if ($sql_df_where == "") {
            $select_arr = $res["select_arr"];
            $old_sql = "";
            $sql_result_extra_record = 100;
            if ($datatableflag == 1) {
                $request = Yii::$app->request;
                $params = $request->post();
                $start = $params['start'];
                $length = $params['length'];

                $order = $params['order'];
                $search = $params['search']['value'];
                if ($search == null)
                    $search = "";
                if ($simul == 1) {

                    $length = 10;
                    $start = 0;


                    $order = [];
                } /*

                  $search="Temp"; */

                $datatable_start = $start;
                $datatable_length = $start + $length;
                $datatable_start = $datatable_start / count($variable_param);
                $datatable_length = $datatable_length / count($variable_param);
            }
            foreach ($variable_param as $vp) {
                if ($datatableflag == 1) {

                    if ($length > 0) {
                        //get master 
                        $chart_no = $res["page"][$report_name]["chart_no"];
                        if ($chart_no == null)
                            $chart_no = 0;
                        $current_record = $report[$chart_no];
                        $first = 0;
                        $sql = "select ";
                        $group_by = " group by ";
                        $search_str = "";
                        foreach ($current_record['key'] as $key => $value) {
                            if ($first != 0) {
                                $sql = $sql . ",";
                                $group_by = $group_by . ",";
                            }


                            $seq = $value["field_seq"];
                            $data_type = $value["data_type"];
                            $name = $select_arr[$seq]["name"];
                            $alias = $select_arr[$seq]["alias"];
                            if ($data_type == "date") {
                                $name = "DATE(" . $name . ")";
                            } else if ($data_type == "yy") {
                                $name = "YEAR(" . $name . ")";
                            } else if ($data_type == "mm") {
                                $name = "MONTH(" . $name . ")";
                            } else if ($data_type == "dd") {
                                $name = "DAY(" . $name . ")";
                            } else if ($data_type == "hh") {
                                $name = "HOUR(" . $name . ")";
                            } else if ($data_type == "nn") {
                                $name = "MINUTE(" . $name . ")";
                            } else if ($data_type == "ss") {
                                $name = "SECOND(" . $name . ")";
                            } else if ($data_type == "time") {
                                $name = "CONVERT(" . $name . ",TIME)";
                            } else if ($data_type == "5n") {
                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(5 * 60))";
                            } else if ($data_type == "15n") {
                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(15 * 60))";
                            } else if ($data_type == "30n") {
                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(30 * 60))";
                            } else if ($data_type == "1h") {
                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(60 * 60))";
                            } else if ($data_type == "varchar" or $data_type == "string") {
                                if ($search != "") {
                                    if ($search_str == "") {
                                        $search_str = " and (";
                                    } else {
                                        $search_str = $search_str . " or ";
                                    }
                                    $search_str = $search_str . $name . " like '%" . $search . "%' ";
                                }
                            }


                            $sql = $sql . $name . " " . $alias;
                            $group_by = $group_by . $alias;
                            $first++;
                        };
                        if ($search_str != "") {
                            $search_str = $search_str . ") ";
                        }
                        $order_by = "";
                        $first = 0;
                        foreach ($order as $ord) {
                            $column_no = $ord['column'];
                            if ($column_no > 0) {
                                $column_no = $column_no - 1;
                                $ky = $current_record['key'][$column_no];
                                $seq = $ky["field_seq"];
                                $alias = $select_arr[$seq]["alias"];
                                if ($first == 1) {
                                    $order_by = $order_by . ",";
                                } else {
                                    $order_by = " order by ";
                                }
                                $first = 1;
                                $order_by = $order_by . $alias . " " . $ord['dir'];
                            }
                        }
                        $sql1 = $sql . $res['select2'] . $search_str . $group_by . $order_by;
                        $sql2 = "select count(*) customer_name " . $res['select2'] . $res['select3'] . $search_str . $group_by;
                        foreach ($vp as $key => $value) {
                            $sql1 = str_replace($key, $value, $sql1);
                        }
                        //\Yii::$app->session["select_value"]="Pelindo";
                        $sql1 = str_replace("@@session@@", '"' . \Yii::$app->session["select_value"] . '"', $sql1);
                        $sql_array[] = $sql1;
                        if ($old_sql != $sql1) {
                            $old_sql = $sql1;

                            //exit();


                            $connection = Yii::$app->db;
                            $sql_result_record_counter = $datatable_start;
                            $sql_df_arr = $res['select_df'];
                            $where_df = $res['where_df'];
                            $continue_flag = true;
                            while ($continue_flag) {
                                $command = $connection->createCommand($sql1 . " limit " . $length . " OFFSET " . $sql_result_record_counter);
                                //echo "sql1:".$sql1." limit ".$length." OFFSET ".$sql_result_record_counter."<br>";
                                //exit();

                                $data2 = $command->queryAll();

                                $sql_result_record = count($data2);
                                if ($sql_result_record <= 0) {
                                    $sql_result_extra_record = 0;
                                    $continue_flag = false;
                                } else {

                                    foreach ($data2 as $values2) {
                                        $sql_result_record_counter++;
                                        if ($sql_result_record_counter <= $datatable_start) {

                                            continue;
                                        }
                                        if ($sql_result_record_counter > $datatable_length) {
                                            $continue_flag = false;
                                            break;
                                        }

                                        $sql3 = $res['select'] . $res['select2'];
                                        $no=0;
                                        foreach ($current_record['key'] as $key => $values3) {
                                            $seq = $values3["field_seq"];
                                            $name = $select_arr[$seq]["name"];
                                            $data_type = $values3["data_type"];
                                            if ($data_type == "date") {
                                                $name = "DATE(" . $name . ")";
                                            } else if ($data_type == "yy") {
                                                $name = "YEAR(" . $name . ")";
                                            } else if ($data_type == "mm") {
                                                $name = "MONTH(" . $name . ")";
                                            } else if ($data_type == "dd") {
                                                $name = "DAY(" . $name . ")";
                                            } else if ($data_type == "hh") {
                                                $name = "HOUR(" . $name . ")";
                                            } else if ($data_type == "nn") {
                                                $name = "MINUTE(" . $name . ")";
                                            } else if ($data_type == "ss") {
                                                $name = "SECOND(" . $name . ")";
                                            } else if ($data_type == "time") {
                                                $name = "CONVERT(" . $name . ",TIME)";
                                            } else if ($data_type == "5n") {
                                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(5 * 60))";
                                            } else if ($data_type == "15n") {
                                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(15 * 60))";
                                            } else if ($data_type == "30n") {
                                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(30 * 60))";
                                            } else if ($data_type == "1h") {
                                                $name = "FLOOR(UNIX_TIMESTAMP(" . $name . ")/(60 * 60))";
                                            }

                                            if ($no==0 && strpos($sql3, 'where') === false) {
                                               $sql3 = $sql3 . " WHERE ";
                                            }
                                            if (strpos($sql3, 'and') !== false || $no>0) {
                                                $sql3 = $sql3 . " and " . $name . "='" . $values2[$select_arr[$seq]["alias"]] . "' ";
                                            }else{
                                                $sql3 = $sql3 . " " . $name . "='" . $values2[$select_arr[$seq]["alias"]] . "' ";
                                            }
                                            $no++;
                                        };
                                        $sql3 = $sql3 . $res['select3'];
                                        foreach ($vp as $key => $value) {
                                            $sql3 = str_replace($key, $value, $sql3);
                                        }
                                        //\Yii::$app->session["select_value"]="Pelindo";
                                        $sql3 = str_replace("@@session@@", '"' . \Yii::$app->session["select_value"] . '"', $sql3);

                                        $command = $connection->createCommand($sql3);
                                        //echo "sql3= " . $sql3."<br>";
                                        //exit();
                                        $data = $command->queryAll();
                                        foreach ($data as $values) {
                                            $d2 = [];
                                            foreach ($res["column"] as $val) {
                                                if ($df_flag == 0) {
                                                    if ($index_field != "") {

                                                        if ($val['COLUMN_ID'] == $index_field) {

                                                            $temp_val = $values[$val['ALIAS_NAME']];
                                                            if ($temp_val > $new_last_index) {
                                                                $new_last_index = $temp_val;
                                                            }
                                                        }
                                                    }
                                                }

                                                $COLUMN_COMMENT = $val['COLUMN_COMMENT'];
                                                if ($COLUMN_COMMENT != "") {

                                                    $COLUMN_COMMENT_array = explode(":", $COLUMN_COMMENT);
                                                    if (count($COLUMN_COMMENT_array) >= 2) {
                                                        if ($COLUMN_COMMENT_array[0] == "ref") {
                                                            $param2 = $COLUMN_COMMENT_array[1];
                                                            $val2 = $values[$val['ALIAS_NAME']];
                                                            $d2[] = Yii::$app->params[$param2][$val2];
                                                            continue;
                                                        /*} else if ($COLUMN_COMMENT_array[0] == "ref2") {
                                                            $d2[] = $this->actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, null, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);

                                                            continue;
                                                        } else {*/
                                                             $d2[] = $this->actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, null, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);
                                                             continue;
                                                        }
                                                    }
                                                }
                                                $d2[] = $values[$val['ALIAS_NAME']];
                                            };
                                            if ($sql_df_arr != null) {
                                                $this->actionGetDataReportAdd($d1, $d2, $values, $master_detail_index_str, $master_detail_index2_str,$master_detail_index_str_b, $master_detail_index2_str_b);
                                                //$d1[$values["master_detail_index"]] = $d2;
                                                //$d1[] = $d2;
                                            //
                                            } else {
                                                $d1[] = $d2;
                                            }
                                        }
                                    };
                                }
                            }
                            if ($df_flag > 0) {
                                
                                
                                    $sql_df_where = "";
                                    foreach ($d1 as $key => $value) {
                                        if ($sql_df_where == "") {
                                            $sql_df_where = " " . $where_df[0][1]["COLUMN_ID"] . " in (";
                                        } else {
                                            $sql_df_where = $sql_df_where . ",";
                                        }
                                        $sql_df_where = $sql_df_where . $key;
                                    }
                                    if ($sql_df_where != "") {
                                        $sql_df_where = $sql_df_where . ") ";
                                    }
                                
                            }
                        };
                    }
                    //exit();
                } else {
                    $sql = $res['select'] . $res['select2'] . $res['select3'];

                    foreach ($vp as $key => $value) {
                        $sql = str_replace($key, $value, $sql);
                    }
                    //\Yii::$app->session["select_value"]="Pelindo";
                    $sql = str_replace("@@session@@", '"' . \Yii::$app->session["select_value"] . '"', $sql);
                    $sql_array[] = $sql;
                    if ($old_sql != $sql) {
                        $old_sql = $sql;
                        //echo "sql:".$sql;
                        //exit();
                        $connection = Yii::$app->db;
                        $command = $connection->createCommand($sql);
                        $data = $command->queryAll();

                        $sql_df_arr = $res['select_df'];


                        $where_df = $res['where_df'];
                        $sql_result_record = count($data);
                        $sql_result_record_counter = 0;
                        foreach ($data as $values) {
                            $d2 = [];
                            foreach ($res["column"] as $val) {
                                if ($df_flag == 0) {
                                    if ($index_field != "") {

                                        if ($val['COLUMN_ID'] == $index_field) {

                                            $temp_val = $values[$val['ALIAS_NAME']];
                                            if ($temp_val > $new_last_index) {
                                                $new_last_index = $temp_val;
                                            }
                                        }
                                    }
                                }

                                $COLUMN_COMMENT = $val['COLUMN_COMMENT'];
                                if ($COLUMN_COMMENT != "") {

                                    $COLUMN_COMMENT_array = explode(":", $COLUMN_COMMENT);
                                    if (count($COLUMN_COMMENT_array) >= 2) {
                                        if ($COLUMN_COMMENT_array[0] == "ref") {
                                            $param2 = $COLUMN_COMMENT_array[1];
                                            $val2 = $values[$val['ALIAS_NAME']];
                                            $d2[] = Yii::$app->params[$param2][$val2];
                                            continue;
                                        } else  {
                                            $d2[] = $this->actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, null, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);

                                            continue;
                                        }
                                    }
                                }
                                $d2[] = $values[$val['ALIAS_NAME']];
                            };
                            if ($sql_df_arr != null) {
                                $this->actionGetDataReportAdd($d1, $d2, $values, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);
                                //$d1[$values["master_detail_index"]] = $d2;
                                //$d1[] = $d2;
                            //
                            } else {
                                $d1[] = $d2;
                            }
                            $sql_result_record_counter++;
                        };
                        if ($df_flag > 0) {
                            
                            if ($res["extend"]=="1") {
                                $sql_df_where_array=[];
                            
                                if (isset($res["extend_value"])){
                                    $extend_value=$res["extend_value"];
                                    $value=$d1[0];
                                    $extend_no=1;
                                    $idx=0;
                                    foreach ($value as $key) {
                                        if ($key==$extend_value) {
                                            $extend_no=$idx;
                                            break;
                                        }
                                        $idx++;
                                        
                                    }
                                    foreach ($d1 as $key => $value) {

                                        $sql_df_where_array[] = [$key,$value[$extend_no]];
                                    }
                                } else {
                                    foreach ($d1 as $key => $value) {

                                        $sql_df_where_array[] = $key;
                                    }
                                
                                }
                                
                                
                                $sql_df_where_array2=[];
                                for ($i=1;$i<count($where_df);$i++){
                                    $sql_df_where_array2[]=$where_df[$i];
                                }

                            } else {
                                $sql_df_where = "";
                                foreach ($d1 as $key => $value) {
                                    if ($sql_df_where == "") {
                                        $sql_df_where = " " . $where_df[0][1]["COLUMN_ID"] . " in (";
                                    } else {
                                        $sql_df_where = $sql_df_where . ",";
                                    }
                                    $sql_df_where = $sql_df_where . $key;
                                }
                                if ($sql_df_where != "") {
                                    $sql_df_where = $sql_df_where . ") ";
                                }
                                for ($i=1;$i<count($where_df);$i++){
                                    $sql_df_where=$sql_df_where." and ".$where_df[$i];
                                }
                            }
                            
                            
                        }
                    };
                }
            }
        }
        if ($df_flag > 0) {
            foreach ($variable_param as $vp) {

                $sql_df = "select ";
                $first = 0;
                foreach ($sql_df_arr as $values) {
                    if ($first == 0) {
                        $first = 1;
                    } else {
                        $sql_df = $sql_df . ',';
                    }
                    $sql_df = $sql_df . $values['name'] . " " . $values['alias'];
                }
                $sql_df = $sql_df . " from " . $res['select_df4'];


                if ($res['select_df2'] == "") {
                    $sql_df = $sql_df . " where " . $sql_df_where . $res['order_by_df'].$res['limit_df'];
                } else {
                    $sql_df = $sql_df . " where " . $res['select_df2'] . " and " . $sql_df_where . $res['order_by_df'].$res['limit_df'];
                }


                foreach ($vp as $key => $value) {
                    $sql_df = str_replace($key, $value, $sql_df);
                }
                //\Yii::$app->session["select_value"]="Pelindo";
                $sql_df = str_replace("@@session@@", '"' . \Yii::$app->session["select_value"] . '"', $sql_df);
                $sql_df_array[] = $sql_df;
                //echo "sql_df:".$sql_df;
                //exit();
                if ($res["extend"]=="1") {
                    //echo "extend";
                    //exit();
                    
                     
                     
                            
                            
                    //column $res["column_df"]
                    // table $res["table_df"]
                    // where $res['select_df2']
                    // where in $sql_df_where
                    // limit        $res['select_df3'], 
                    
                        
                    $data_df=$this->actionGetDataReport3Detail($d1,$sql_df,$res["column_df"],$res["table_df"],$res['select_df2'],$sql_df_where_array,$sql_df_where_array2, $res['order_by_df'],$res['limit_df']);
                  //  $data_df=[];$column_df,$table_df,$where,$in_where,$others
                    //foreach ($data_df as $val_data_df){
                    //    $d1_df[]=$val_data_df;
                    //}
                       //$d1_df=array_merge($d1_df,$data_df);
                    
                    foreach ($data_df as $values) {
                        $d2 = [];
                        foreach ($res["column_df"] as $val) {

                            if ($index_field != "") {

                                if ($val['COLUMN_ID'] == $index_field) {

                                    $temp_val = $values[$val['ALIAS_NAME']];
                                    if ($temp_val > $new_last_index) {
                                        $new_last_index = $temp_val;
                                    }
                                }
                            }

                            $COLUMN_COMMENT = $val['COLUMN_COMMENT'];
                            if ($COLUMN_COMMENT != "") {

                                $COLUMN_COMMENT_array = explode(":", $COLUMN_COMMENT);
                                if (count($COLUMN_COMMENT_array) >= 2) {
                                    if ($COLUMN_COMMENT_array[0] == "ref") {
                                        $param2 = $COLUMN_COMMENT_array[1];
                                        $val2 = $values[$val['ALIAS_NAME']];
                                        $d2[] = Yii::$app->params[$param2][$val2];
                                        continue;
                                    } else  {
                                        $d2[] = $this->actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, $d1, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);

                                        continue;
                                    }
                                }
                            }
                            $d2[] = $values[$val['ALIAS_NAME']];
                        };
                        $d1_df[] = $d2;
                    }
                } else {
                    $connection = Yii::$app->db;
                    $command = $connection->createCommand($sql_df);
                    $data_df = $command->queryAll();
                    foreach ($data_df as $values) {
                        $d2 = [];
                        foreach ($res["column_df"] as $val) {

                            if ($index_field != "") {

                                if ($val['COLUMN_ID'] == $index_field) {

                                    $temp_val = $values[$val['ALIAS_NAME']];
                                    if ($temp_val > $new_last_index) {
                                        $new_last_index = $temp_val;
                                    }
                                }
                            }

                            $COLUMN_COMMENT = $val['COLUMN_COMMENT'];
                            if ($COLUMN_COMMENT != "") {

                                $COLUMN_COMMENT_array = explode(":", $COLUMN_COMMENT);
                                if (count($COLUMN_COMMENT_array) >= 2) {
                                    if ($COLUMN_COMMENT_array[0] == "ref") {
                                        $param2 = $COLUMN_COMMENT_array[1];
                                        $val2 = $values[$val['ALIAS_NAME']];
                                        $d2[] = Yii::$app->params[$param2][$val2];
                                        continue;
                                    } else  {
                                        $d2[] = $this->actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, $d1, $master_detail_index_str, $master_detail_index2_str, $master_detail_index_str_b, $master_detail_index2_str_b);

                                        continue;
                                    }
                                }
                            }
                            $d2[] = $values[$val['ALIAS_NAME']];
                        };
                        $d1_df[] = $d2;
                    }
                }
                
                
                
            }
            $idx = 0;
            foreach ($res["column_df"] as $value) {
                $res["use_column"][$value["COLUMN_ID"]]["df_flag"] = 1;
                $res["use_column"][$value["COLUMN_ID"]]["df_index"] = $idx;
                $res["use_column"][$value["COLUMN_ID"]]["ALIAS_NAME"] = $value["ALIAS_NAME"];
                if ($value["ALIAS_NAME"] == $master_detail_index_str_b) {
                    $master_detail_index = $idx;
                } else if ($value["ALIAS_NAME"] == $master_detail_index2_str_b) {
                    $master_detail_index2 = $idx;
                }
                $idx = $idx + 1;
            };
            $idx = 0;
            foreach ($res["column"] as $value) {
                $res["use_column"][$value["COLUMN_ID"]]["df_flag"] = 0;
                $res["use_column"][$value["COLUMN_ID"]]["df_index"] = $idx;
                $res["use_column"][$value["COLUMN_ID"]]["ALIAS_NAME"] = $value["ALIAS_NAME"];
                $idx = $idx + 1;
            }
        }



        if ($df_flag == 0) {
            $return = [
                'data' => $d1,
                'code' => 1,
                'column' => $res["column"],
                'report' => $report,
                'filter_where' => $filter_where,
                'param_key' => $param_key,
                'param_var' => $param_var,
                'sql_array' => $sql_array,
                'last_index' => $new_last_index,
                'df_flag' => $df_flag,
                'sql_df_where' => "",
                'sql_result_record' => $sql_result_record,
                'sql_result_record_counter' => $sql_result_record_counter
            ];
        } else {
            if ($last_index == -1) {
                $return = [
                    'data_lookup' => $d1,
                    'data_df' => $d1_df,
                    'code' => 1,
                    'column' => $res["use_column"],
                    'column_lookup' => $res["column"],
                    'column_df' => $res["column_df"],
                    'report' => $report,
                    'filter_where' => $filter_where,
                    'param_key' => $param_key,
                    'param_var' => $param_var,
                    'sql_array' => $sql_array,
                    'sql_df_array' => $sql_df_array,
                    'last_index' => $new_last_index,
                    'sql_df_where' => $sql_df_where,
                    'df_flag' => $df_flag,
                    "master_detail_index" => $master_detail_index,
                    "master_detail_index2" => $master_detail_index2,
                ];
            } else {
                $return = [
                    //    'data_lookup' => $d1,
                    'data_df' => $d1_df,
                    'code' => 1,
                    //    'column' => $res["use_column"],
                    //   'column_lookup' => $res["column"],
                    //    'column_df' => $res["column_df"],
                    //    'report' => $report,
                    //    'filter_where' => $filter_where,
                    //    'param_key' => $param_key,
                    //    'param_var' => $param_var,
                    //    'sql_array' => $sql_array,
                    //    'sql_df_array' => $sql_df_array,
                    'last_index' => $new_last_index,
                    //    'sql_df_where' => $sql_df_where,
                    'df_flag' => $df_flag,
                        //    "master_detail_index" => $master_detail_index,
                        //    "master_detail_index2" => $master_detail_index2,
                ];
            }
        }
        if ($datatableflag == 1) {
            if ($length > 0) {
                $return2 = [];
                $return2["data"] = $return;

                $return = $return2;
            };
            $return["recordsTotal"] = ($sql_result_record_counter + $sql_result_extra_record) * count($variable_param);
            $return["recordsFiltered"] = ($sql_result_record_counter + $sql_result_extra_record) * count($variable_param);
            $return["datatable_start"] = $datatable_start;
            $return["datatable_length"] = $datatable_length;
            $return["order"] = $order_by;
            $return["data2"] = $data2;
        };
        return $return;
    }
    
    public function actionGetDataReport3Detail($d1,$sql_df,$column_df,$table_df,$where,$in_where,$where2,$order_by_df,$limit_df){
        
        echo $sql_df."<br>";
        echo "column_df:".json_encode($column_df)."<br>";
        echo "table_df:".json_encode($table_df)."<br>";
        echo "where:".json_encode($where)."<br>";
        echo "in_where:".json_encode($in_where)."<br>";
         echo "where2:".json_encode($where2)."<br>";
        echo "order_by_df:".json_encode($order_by_df)."<br>";
        echo "limit_df:".json_encode($limit_df)."<br>";
        exit();
       
    }

    public function actionGetDataReport5() {

        return $this->render('view_report3');
    }

    public function actionGetDataReport6() {


        return $this->render('//report-generator/view_report_generator', [
                    "folder" => "report10.json",
                    "report_name" => 0,
        ]);
    }

    public function actionGetDataReport4($mode=null,$folder, $report_name = 0, $filter_where = "", $filter_where_df = "", $builder = 0, $debug_flag=0,$app_mode=null) {
        if($app_mode==1){$mode=2;}
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        $params = file_get_contents($report_file);
        
        $json = json_decode($params, true);
        
        if ($debug_flag==1) {
                Yii::debug("[actionGetDataReport4] load");
            }
        
        $column = $json["column"];
        
        $use_column = $json["page"][$report_name]["use_column"];
        
        
        
        /*
          $can_build=Yii::$app->user->can("ReportGeneratorController.".$folder.".build");
          $can_update=Yii::$app->user->can("ReportGeneratorController.".$folder.".update");
         * 
         */
        $can_build = 1;
        $can_update = 1;
        if ($builder == 1) {
            if (!$can_update) {
                $builder = 0;
            }
        };
        
        $model = new ReportGenerator();
        
        
        
       
        
        //$model->load_session(Yii::$app->session['ReportGenerator_'.$folder."_".$report_name]);
        $model->load_session($json["page"][$report_name]["model"]);
        
        if ($model->load(Yii::$app->request->post())) {
            if ($debug_flag==1) {
                Yii::debug("load session",Yii::$app->session['ReportGenerator_'.$folder."_".$report_name]);
            }
            //echo " ".json_encode(Yii::$app->session['ReportGenerator_'.$folder."_".$report_name]);
            //exit();
            if ($builder==1){
                $json["page"][$report_name]["model"]=$model->get_session();
                rename($report_file, $report_file . "." . date('YmdHis'));
                file_put_contents($report_file, json_encode($json));
                
                //Yii::$app->session['ReportGenerator_'.$folder."_".$report_name]=$model->get_session();
            }
            
        } else {
            
        };
        
        
        
        if ($model->param_adv_filter != "") {
            $report_name = $model->param_adv_filter;
            $use_column = $json["page"][$report_name]["use_column"];
            $model->load_session($json["page"][$report_name]["model"]);
            
            //echo $report_name;
            //exit();
        }
        
        $ajax_mode = 0;
        $filter_advance=null;
        $filter_advance_temp = $json["page"][$report_name]["filter_advance"];
        if (isset($filter_advance_temp)) {
            $filter_advance_data=[];
            foreach ($filter_advance_temp["data"] as $val){
                $filter_advance_data[$val["report"]]=$val["label"];
            }
            $filter_advance=[
                "label"=>$filter_advance_temp["title"],
                "data"=>$filter_advance_data
            ];
                
            
        } else {
            $ajax_mode = 1;
        }
        
        $ajax_mode = 0;
        
        $timeout = $json["timeout"];
        if ($timeout == "") {
            $timeout = 30 * 60000;
        }
        $model->limit = $json["page"][$report_name]["limit"];
        $andWhere = "";
        $andWhere_df = "";
        $limit = "";
        $page_mode = $json["page"][$report_name]["page_mode"];
        if ($page_mode == null)
            $page_mode = 0;
        
        
        
        $ke = 0;
        //$andWhere="";
        foreach ($column as $col) {
            $data_type = $col['DATA_TYPE'];
            $COLUMN_COMMENT = $col['COLUMN_COMMENT'];
            $COLUMN_NAME = $col['COLUMN_ID'];
            $use_col = $use_column[$col['COLUMN_ID']];
            if ($use_col != null && $use_col['filter_flag'] == 1) {
                $param_name = 'param' . $ke;
                $param_name_3 = 'param' . $ke . "_3";
                $param_name_2 = 'param' . $ke . "_2";
                $operation = $model->$param_name_3;
                $param1 = $model->$param_name;
                $param2 = $model->$param_name_2;
                $limit = $model->limit;
                if ($param1 != "") {
                    /* if ($COLUMN_COMMENT!="") {
                      $COLUMN_COMMENT_ARRAY=explode(":",$COLUMN_COMMENT);
                      if ($COLUMN_COMMENT_ARRAY[0]=='ref') {
                      }
                      } else if ($data_type=='xyz') {
                      } else */ {
                        $temp_andWhere = "";
                        $quote="'";
                        $quote2="'";
                        if ($data_type=="datetime" or $data_type=="date") {
                            if ($builder==1) {
                                if (strpos($param1,"(")) {
                                    $quote="";
                                };
                                if (strpos($param2,"(")) {
                                    $quote2="";
                                };
                            } else {
                                if (strpos($param1,"(")) {
                                    $sql = "SELECT ".$param1." res";
                                    $connection = Yii::$app->db;
                                    $command = $connection->createCommand($sql);
                                    $data = $command->queryOne();
                                    $param1=$data["res"];
                                    $model->$param_name=$param1;
                                    //echo json_encode($data)."<br> ".$param1;
                                    //exit();
                                    
                                };
                                if (strpos($param2,"(")) {
                                    $sql = "SELECT ".$param2." res";
                                    $connection = Yii::$app->db;
                                    $command = $connection->createCommand($sql);
                                    $data = $command->queryOne();
                                    $param2=$data["res"];
                                     $model->$param_name_2=$param2;
                                };
                            }
                          
                            
                        };
                        if ($operation == 0) {
                            if ($param1 == "null") {
                                $temp_andWhere = $COLUMN_NAME . " is null";
                            } else {
                                $temp_andWhere = $COLUMN_NAME . "=".$quote . $param1 .$quote;
                            }
                        } else if ($operation == 1) {
                            if ($param1 == "null") {
                                $temp_andWhere = $COLUMN_NAME . " is not null";
                            } else {
                                $temp_andWhere = $COLUMN_NAME . "!=" . $quote . $param1 .$quote;
                            }
                        } else if ($operation == 2) {
                            $temp_andWhere = $COLUMN_NAME . ">=" .$quote . $param1 .$quote;
                            $temp_andWhere = $temp_andWhere . " and " . $COLUMN_NAME . "<=" .$quote2 . $param2 .$quote2;
                        } else if ($operation == 3) {
                            $temp_andWhere = "not (" . $COLUMN_NAME . ">=" .$quote . $param1 .$quote;
                            $temp_andWhere = $temp_andWhere . " and " . $COLUMN_NAME . "<=" .$quote2 . $param2 .$quote2. ")";
                        } else if ($operation == 4) {
                            $temp_andWhere = $COLUMN_NAME . ">" .$quote . $param1 .$quote;
                        } else if ($operation == 5) {
                            $temp_andWhere = $COLUMN_NAME . ">=" .$quote . $param1 .$quote;
                        } else if ($operation == 6) {
                            $temp_andWhere = $COLUMN_NAME . "<" .$quote . $param1 .$quote;
                        } else if ($operation == 7) {
                            $temp_andWhere = $COLUMN_NAME . "<=" .$quote . $param1 .$quote;
                        } else if ($operation == 8) {
                            $temp_andWhere = $COLUMN_NAME . " like '%" . $param1 . "%'";
                        } else if ($operation == 9) {
                            $temp_andWhere = $COLUMN_NAME . "not like '%" . $param1 . "%'";
                        }
                        if ($temp_andWhere != "") {
                            //$df_flag = $use_col["ref"]["df_flag"];
                            $df_flag = $use_col["df_flag"];
                            if ($df_flag == 0) {
                                if ($andWhere != "") {
                                    $andWhere = $andWhere . " and " . $temp_andWhere;
                                } else {
                                    $andWhere = $temp_andWhere;
                                }
                            } else {
                                if ($andWhere_df != "") {
                                    $andWhere_df = $andWhere_df . " and " . $temp_andWhere;
                                } else {

                                    $andWhere_df = $temp_andWhere;
                                }
                            }
                        }
                    }
                }


                $ke++;
            }
        }
        

        //echo $model->getAttributeLabel('param0');
        //echo $andWhere;
        //exit();
        // $this->layout = 'main_iframe';
        //echo $andWhere;
        //exit();
        
        if ($mode!=null) {
            $this->layout = 'main_iframe';
        }
        
        //echo "filter_where=".$filter_where."<br>";
        //exit();
        
        return $this->render('view_report2', [
                    'report' => $json["page"][$report_name]["report"],
                    'report_name' => $report_name,
                    'folder' => $folder,
                    'column' => $json["column"],
                    'use_column' => $use_column,
                    'filter_where' => $filter_where,
                    'filter_where_df' => $filter_where_df,
                    'model' => $model,
                    "new_flag" => false,
                    'andWhere' => $andWhere,
                    'andWhere_df' => $andWhere_df,
                    'timeout' => $timeout,
                    'limit' => $limit,
                    'builder' => $builder,
                    'filter_advance' => $filter_advance,
                    'ajax_mode' => $ajax_mode,
                    'can_update' => $can_update,
                    'can_build' => $can_build,
                    'realtime_url' => $json["page"][$report_name]["realtime_url"],
                    'dashboard_name' => $json["page"][$report_name]["dashboard_name"],
                    'dashboard_option' => $json["page"][$report_name]["dashboard_option"],
                    'dashboard_backgrond' => $json["page"][$report_name]["dashboard_backgrond"],
                    "page_mode" => $page_mode,
                    'mode'=>$mode,
                    'db_id'=>$json["db_id"],
                    'report_db_id'=>0,
                    'debug_flag'=>$debug_flag
        ]);
    }

    

}
