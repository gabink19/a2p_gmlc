<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\ReportGenerator;

class ReportGeneratorController extends XxReportGeneratorController {
    private $var_ref=-1;
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'create', 'get-all-table-data', 'get-data-report', 'save-data-report',
                    'get-data-report2', 'get-data-report3', 'get-data-report4',
                ],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['create', 'get-all-table-data', 'get-data-report'],
                        'roles' => ['ReportGeneratorController' . '.xx.create'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['get-data-report2', 'get-data-report3', 'get-data-report4'],
                        'roles' => ["ReportGeneratorController." . Yii::$app->request->get('folder') . ".view"],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '_delete' => ['POST'],
                ],
            ],
        ];
    }

   
    public function actionGetDataReport3sub($folder,$report_name,$values, $val, $COLUMN_COMMENT_array, $d1, $master_detail_index_str, $master_detail_index2_str, &$master_detail_index_str_b, &$master_detail_index2_str_b) {
        if ($COLUMN_COMMENT_array[0] == "ref2") {
            if ($d1 != null) {
                $val4 = $values[$master_detail_index_str_b];
                //$val6 = $values[$master_detail_index2_str];
                //$val5 = $d1[$val5][$val6];
                $val5 = $d1[$val4];
                //$val3 = $val5[$COLUMN_COMMENT_array[1]];
                if ($this->var_ref==-1) {
                    foreach ($d1[0] as $key=>$val_d1){
                        if ($val_d1==$COLUMN_COMMENT_array[1]) {
                            $this->var_ref=$key;
                            break;
                        }
                    }
                    
                }
                $val3 = $val5[$this->var_ref];
                    
                
                //$val3 = $values[$COLUMN_COMMENT_array[1]];
            } else {
                $val3 = $values[$COLUMN_COMMENT_array[1]];
            }
            //echo $COLUMN_COMMENT_array[0]." ".$master_detail_index_str_b." $this->var_ref 3:".$val3." 4:".$val4." 5:".json_encode($d1);
            //exit();
            $val2 = $values[$val['ALIAS_NAME']];
            switch ($val3) {
                case 1:
                    $ref_id = $value[$COLUMN_COMMENT_array[2]];
                    $res_value2 = Yii::$app->params['customized2_type_' . $ref_id][intval($val2)];
                    return $res_value2;

                    break;
                case 2:
                    $res_value2 = Yii::$app->params['configure2_type_2'][intval($val2)];
                    if ($res_value2 == "")
                        $res_value2 = "(value:" . $val2 . ")";
                    return $res_value2;

                    break;
                default:
                    return $val2;
            }
        }
        return "";
    }

    /*
      var $DateSoObj=[];

      public function actionGetDataReport3sub($values, $val, $COLUMN_COMMENT_array, $d1, $master_detail_index_str, $master_detail_index2_str, &$master_detail_index_str_b, &$master_detail_index2_str_b) {

      $date = new DateTime($values["Date"]);
      $date->modify('-1 day');
      $SONumber = $values["SONumber"];

      $DateSoObj_date=$this->DateSoObj[$date];
      if (!isset($DateSoObj_date)) {

      $DateSoObj_date=[];
      $this->DateSoObj[$date]=$DateSoObj_date;
      }
      $DateSoObj_date_so=$DateSoObj_date[$SONumber];
      if (!isset($DateSoObj_date_so)) {
      // [select berdasarkan key dan date untk mencari nilai sebelumnya . misalnya 1000]
      // tambahkan phpcode untk ambil tanggal kemarin berdasrakan date dan so number
      $DateSoObj_date_so=1000;
      $DateSoObj_date[$SONumber]=$DateSoObj_date_so;

      }
      return $DateSoObj_date_so;





      }

     */

    /*

      public function actionGetDataReportAdd( &$d1,$d2,$values,$master_detail_index_str,$master_detail_index2_str,&$master_detail_index_str_b, &$master_detail_index2_str_b) {

      $d_array= $d1[$values[$master_detail_index_str]][$values[$master_detail_index2_str]] = $d2;


      }
      public function actionGetDataReport3Reg($res,&$master_detail_index_str,&$master_detail_index2_str,&$master_detail_index_str_b, &$master_detail_index2_str_b){
      $master_detail_index_str=$res["where_df"][0][0]["ALIAS_NAME"];
      $master_detail_index2_str="sensor_port";
      $master_detail_index_str_b=$res["where_df"][0][1]["ALIAS_NAME"];
      $master_detail_index2_str="sensor_port";
      return 2;
      }

     */

    function processFile($filename, $start_date, $stop_date, $list_channel, &$output_str, $rec_map, &$return, $limit) {

        // $return = [];
        $myfile = fopen($filename, "r");
        $breakFlag = false;
        // Output one line until end-of-file
        while (!feof($myfile)) {
            $line_str = fgets($myfile);
            if ($line_str != "") {
                $line = explode("|", str_replace("\n", '', $line_str));
                //$line=explode("|",$line_str);
                foreach ($line as $key => $val) {
                    if ($key == 0) {
                        $master = explode(",", $val);
                    } else {
                        if ($val != "") {
                            $detail = explode(",", $val);
                            $res = $list_channel[$detail[0]];
                            if ($res == 1) {
                                //$output_str=$output_str. "process :".$master[0]." ".$detail[0]."<br>";
                                $return2 = [];
                                foreach ($rec_map as $key2 => $val2) {
                                    $rec_no = $val2["rec_no"];
                                    if ($rec_no < 100) {
                                        
                                        if ($rec_no==2) {
                                            $php_date=intval($master[$rec_no])/1000;
                                            $val_res = date("Y-m-d G:i:s",$php_date );
                                        } else {
                                            $val_res = $master[$rec_no];
                                        }
                                        //    $val_res = $master[$rec_no];
                                        
                                    } else {
                                        $rec_no = $rec_no - 100;
                                        $val_res = $detail[$rec_no];
                                    }
                                    $COLUMN_COMMENT = $val2["ref"]["COLUMN_COMMENT"];
                                    
                                    $ALIAS_NAME=$val2["ref"]["ALIAS_NAME"];
                                    
                                    $return2[$ALIAS_NAME] = $val_res;
                                    
                                }
                                $return[] = $return2;

                                if (count($return) >= $limit) {
                                    $breakFlag = true;
                                    break;
                                }
                            } else {
                                /*
                                  $output_str=$output_str. "not found:".$detail[0]." val:".$key."=>".$val. "<br>";
                                  echo $output_str;
                                  exit(); */
                            }
                        }
                    }
                }
            }
            if ($breakFlag)
                break;
        }
        fclose($myfile);
        //$output_str=$output_str. "process :".$filename."<br>";
        // return $return;
    }

    public function actionConvertToCdr($page, $last_page = 1) {
        $dir = Yii::$app->params["cdr_dir"];
        //$sql = "SELECT t.*,d.* FROM icloud.t_sensor_history t inner join t_sensor_channel_history d on t.tsh_id =d.t_sensor_history_tsh_id order by t.first_update limit 1000 offset 0";

        $last_page = $page + $last_page;
        $record_count = 0;
        $record_detail_count = 0;
        $connection = Yii::$app->db;
        while ($page < $last_page) {
            $sql = "SELECT t.* FROM icloud.t_sensor_history t order by t.first_update limit 10000 offset " . ($page * 10000);


            $command = $connection->createCommand($sql);
            $data = $command->queryAll();

            if (count($data) <= 0) {
                break;
            }
            $page++;
            foreach ($data as $val) {
                $record_count++;
                $datetime = $val["first_update"];
                $datetime_arr = explode(" ", $datetime);
                $dir_filename = $dir . str_replace("-", "", $datetime_arr[0]);

                if (!file_exists($dir_filename)) {
                    mkdir($dir_filename, 0777);
                }
                $filename = $dir_filename . "/" . $val["g_sensor_db_gsd_id"];

                $rec = $datetime . "," . $val["tsh_long"] . "," . $val["tsh_lat"] . "|";
                /*
                  if ($record_count<10) {
                  foreach ($val as $key=>$val2){
                  echo $key."=".$val2." ";
                  }
                  echo "<br>";
                  } */

                $sql2 = "SELECT d.* FROM  t_sensor_channel_history d where d.t_sensor_history_tsh_id=" . $val["tsh_id"]; //." limit 100 offset 0";

                $record_flag = false;
                $command2 = $connection->createCommand($sql2);
                $data2 = $command2->queryAll();
                foreach ($data2 as $val_a) {
                    $record_flag = true;
                    $record_detail_count++;
                    /* if ($record_count<10) {
                      echo "detail ";
                      foreach ($val_a as $key=>$val2){
                      echo $key."=".$val2." ";
                      }
                      echo "<br>";
                      } */
                    $rec = $rec . $val_a["g_sensor_channel_gsc_id"] . "," . $val_a["tsch_value"] . "," . $val_a["tsch_status"] . "|";
                }
                if ($record_flag) {
                    $rec = $rec . "\n";
                    $data2 = null;
                    $fp = fopen($filename, 'a');
                    fwrite($fp, $rec);
                    $rec = null;
                    fclose($fp);
                }
            }
            $data = null;
        }
        echo "page" . $page . "<br>";
        echo "record_count" . $record_count . "<br>";
        echo "record_detail_count=" . $record_detail_count . "<br>";
        echo "<a href='https://icloud.icode.id/index.php?r=report-generator%2Fconvert-to-cdr&page=" . $page . "'>next page " . $page . "</a>";
        exit();
    }

    public function actionGetDataReport3Detail($folder,$report_name,$d1, $sql_df, $column_df, $table_df, $where, $in_where, $where2, $order_by_df, $limit_df) {
        date_default_timezone_set("Asia/Bangkok");
        $rec_map_db = [
            "first_update" => 2,
            "tsh_long" => 3,
            "tsh_lat" => 4,
            "g_sensor_channel_gsc_id" => 100,
            "tsch_value" => 101,
            "tsch_status" => 102,
            "tsch_status_detail" => 103,
        ];
        $return = [];
        $output_str = "";

        $output_str = $output_str . $sql_df . "<br>";
        $output_str = $output_str . "column_df:" . json_encode($column_df) . "<br>";
        $output_str = $output_str . "table_df:" . json_encode($table_df) . "<br>";
        $output_str = $output_str . "where:" . json_encode($where) . "<br>";
        $output_str = $output_str . "in_where:" . json_encode($in_where) . "<br>";
        $output_str = $output_str . "where2:" . json_encode($where2) . "<br>";
        $output_str = $output_str . "order_by_df:" . json_encode($order_by_df) . "<br>";
        $output_str = $output_str . "limit_df:" . json_encode($limit_df) . "<br>";
        $output_str = $output_str . "others:" . json_encode($others) . "<br>";


        /*
         * 
          column_df:[{"COLUMN_ID":"t2.g_sensor_channel_gsc_id","COLUMN_NAME":"t2.g_sensor_channel_gsc_id","ALIAS_NAME":"hist_channel_id","COLUMN_COMMENT":"","COLUMN_INDEX":0,"DATA_TYPE":"int","filter_flag":null,"test":"1"},{"COLUMN_ID":"t3.first_update","COLUMN_NAME":"t3.first_update","ALIAS_NAME":"hist_datetime","COLUMN_COMMENT":"","COLUMN_INDEX":7,"DATA_TYPE":"datetime","filter_flag":null,"test":"1"},{"COLUMN_ID":"t2.tsch_value","COLUMN_NAME":"t2.tsch_value","ALIAS_NAME":"hist_value","COLUMN_COMMENT":"","COLUMN_INDEX":8,"DATA_TYPE":"double","filter_flag":null,"test":"1"}]
          table_df:["g_sensor_channel t1","t_sensor_channel_history t2"," inner join t_sensor_history t3 on t2.t_sensor_history_tsh_id=t3.tsh_id"]
          where:""
          in_where:[[0,"sensor_id"],[2,"1"],[3,"1"],[123,"1"],[5,"2"],[6,"2"],[7,"2"],[8,"3"],[9,"3"],[10,"4"],[11,"4"],[12,"4"],[13,"5"],[14,"5"],[15,"5"],[16,"5"],[17,"6"],[18,"6"],[19,"6"],[20,"6"],[21,"7"],[22,"7"],[23,"7"],[24,"7"],[25,"7"],[26,"7"],[27,"7"],[28,"7"],[29,"7"],[30,"8"],[31,"8"],[32,"8"],[33,"9"],[34,"9"],[35,"10"],[36,"11"],[37,"12"],[38,"12"],[39,"12"],[40,"12"],[41,"13"],[42,"14"],[43,"15"],[44,"15"],[45,"15"],[46,"15"],[47,"15"],[48,"15"],[49,"15"],[50,"15"],[51,"15"],[52,"15"],[53,"15"],[54,"15"],[55,"16"],[56,"16"],[57,"16"],[58,"16"],[59,"17"],[60,"18"],[61,"18"],[62,"18"],[63,"29"],[64,"35"],[65,"37"],[66,"39"],[67,"40"],[68,"41"],[69,"42"],[70,"43"],[71,"44"],[72,"46"],[73,"47"],[74,"48"],[75,"49"],[76,"62"],[77,"62"],[78,"63"],[79,"63"],[80,"64"],[81,"64"],[82,"65"],[83,"65"],[84,"66"],[85,"66"],[86,"67"],[87,"67"],[88,"68"],[89,"68"],[90,"69"],[91,"69"],[92,"70"],[93,"70"],[94,"71"],[95,"75"],[96,"75"],[97,"76"],[98,"76"],[99,"76"],[100,"76"],[101,"76"],[102,"76"],[103,"76"],[104,"76"],[105,"76"],[106,"76"],[107,"76"],[108,"76"],[109,"77"],[110,"77"],[111,"77"],[112,"77"],[113,"77"],[114,"77"],[115,"77"],[116,"77"],[117,"77"],[118,"77"],[119,"77"],[120,"77"],[121,"78"],[122,"78"],[124,"79"],[125,"82"],[126,"82"],[127,"82"]]
          where2:[]
          others:" limit 1000"
         */
        $output_str = $output_str . "debug<br>";
        $dir = Yii::$app->params["cdr_dir"];
        //$res=$this->readFile($dir."GoogleChart2.php");
        //filter sensordb gsd_id, chanel id 
        $master_key = [];
        foreach ($in_where as $val) {
            if ($val[0] != 0) {
                $master_key[$val[1]][$val[0]] = 1;
            }
        }
        $output_str = $output_str . "master_key:" . json_encode($master_key) . "<br>";
        //
        $rec_map = [];
        foreach ($column_df as $col) {
            $col_id = $col["COLUMN_ID"];
            $col_id_arr = explode(".", $col_id);
            $col_id_arr_1 = $col_id_arr[1];
            $res_val = $rec_map_db[$col_id_arr_1];
            if ($res_val === null) {
                $rec_map[] = ["rec_no" => -1];
            } else {
                $res_val2 = ["ref" => $col];
                $res_val2["rec_no"] = $res_val;
                $rec_map[] = $res_val2;
            }
        }
        $output_str = $output_str . "rec_map:" . json_encode($rec_map) . "<br>";
        
        $start_date = strtotime("now");
        //echo date("Y-m-d G:i:s", $start_date)."(".$start_date.") ";
        //exit();
        
        //$stop_date=strtotime ( '-1 year' ,  $start_date );
        //$stop_date = strtotime(0);
        $stop_date = strtotime('-1 year', $start_date);
        //filter time 
        if ($where != "") {
            $where_arr = explode("and", $where);

            foreach ($where_arr as $where_value) {

                if (strpos($where_value, '<=') !== false) {
                    $where_param = explode('<=', $where_value);
                    $param1_temp = explode(".", $where_param[0]);
                    $param1 = trim($param1_temp[1]);
                    $param2 = trim(str_replace("\"", "", $where_param[1]));
                    $param2 = trim(str_replace("'", "", $param2));
                    $paramOp = "[";
                } else if (strpos($where_value, '>=') !== false) {
                    $where_param = explode('>=', $where_value);
                    $param1_temp = explode(".", $where_param[0]);
                    $param1 = trim($param1_temp[1]);
                    $param2 = trim(str_replace("\"", "", $where_param[1]));
                    $param2 = trim(str_replace("'", "", $param2));
                    $paramOp = "]";
                } else if (strpos($where_value, '=') !== false) {
                    $where_param = explode("=", $where_value);
                    $param1_temp = explode(".", $where_param[0]);
                    $param1 = trim($param1_temp[1]);
                    $param2 = trim(str_replace("\"", "", $where_param[1]));
                    $param2 = trim(str_replace("'", "", $param2));
                    $paramOp = "=";
                } else if (strpos($where_value, '<') !== false) {
                    $where_param = explode('<', $where_value);
                    $param1_temp = explode(".", $where_param[0]);
                    $param1 = trim($param1_temp[1]);
                    $param2 = trim(str_replace("\"", "", $where_param[1]));
                    $param2 = trim(str_replace("'", "", $param2));
                    $paramOp = "<";
                } else if (strpos($where_value, '>') !== false) {
                    $where_param = explode('>', $where_value);
                    $param1_temp = explode(".", $where_param[0]);
                    $param1 = trim($param1_temp[1]);
                    $param2 = trim(str_replace("\"", "", $where_param[1]));
                    $param2 = trim(str_replace("'", "", $param2));
                    $paramOp = ">";
                }
                if ($param1 == "first_update") {
                    if ($paramOp == "=") {
                        $start_date = strtotime($param2);
                        $stop_date = strtotime($param2);
                        $output_str = $output_str . "param1 $param1 param2 $param2 paramOp $paramOp end" . date("Y-m-d", $stop_date) . "<br>";
                    } else if ($paramOp == "]") {
                        $stop_date = strtotime($param2);
                        $output_str = $output_str . "param1 $param1 param2 $param2 paramOp $paramOp end<br>";
                    } else if ($paramOp == ">") {
                        $stop_date = strtotime($param2);
                        $stop_date = strtotime("1 day", $stop_date);
                        $output_str = $output_str . "param1 $param1 param2 $param2 paramOp $paramOp end " . date("Y-m-d", $stop_date) . "<br>";
                    } else if ($paramOp == "<") {
                        $start_date = strtotime($param2);
                        $start_date = strtotime("-1 day", $start_date);
                        $output_str = $output_str . "param1 $param1 param2 $param2 paramOp $paramOp end<br>";
                    } else if ($paramOp == "[") {
                        $start_date = strtotime($param2);
                        $output_str = $output_str . "param1 $param1 param2 $param2 paramOp $paramOp end<br>";
                    } else {
                        $output_str = $output_str . "not match param1 $param1 param2 $param2 paramOp $paramOp end<br>";
                    }
                }
            }
        }

        //$stop_date=$start_date->modify("-1 day");
        $output_str = $output_str . "filter date:" . date("Y-m-d", $start_date) . " until " . date("Y-m-d", $stop_date) . "<br>";
        //echo $output_str;
        //exit();
        //limit
        if ($limit_df == "") {
            $limit = 100;
        } else {
            $limit_arr = explode(" ", trim($limit_df));
            $limit = $limit_arr[1];
        }
        $output_str = $output_str . "limit:" . $limit . "<br>";
        $rec_counter = 0;
        $cur_time = $start_date;
        $breakFlag = false;
        //echo json_encode($master_key);
        
        
        //echo $output_str."\n";
        //exit();
        $counter_temp=0;
        while (!$breakFlag) {


            foreach ($master_key as $key => $val) {
                if (count($return) >= $limit) {
                    $output_str = $output_str . "limit over";
                    $breakFlag = true;
                    break;
                }
                if ($stop_date > $cur_time) {
                    $output_str = $output_str . "time over";
                    $breakFlag = true;
                    
                    break;
                }
                $filename = $dir . date("Ymdh", $cur_time) . "/" . $key;
                if (file_exists($filename)) {
                    
                    $output_str = $output_str . "proces date:" . $filename . " found<br>";
                    $this->processFile($filename, $start_date, $stop_date, $val, $output_str, $rec_map, $return, $limit);
                    //array_push($return,$res);
                    
                
                    $output_str = $output_str . "proces date:" . $filename . " found " . count($return) . "<br>";
                } else {
                    //echo "proces date:".$filename." not found<br>";
                }
            }
            

            $cur_time = strtotime('-1 hour', $cur_time);
            $rec_counter++;
            /*
            $counter_temp=$counter_temp+1;
            if ($counter_temp%100==0){
                echo date("Y-m-d", $cur_time)."(".$cur_time.") ";
                echo date("Y-m-d", $stop_date)."(".$stop_date.") ";
                if ($stop_date > $cur_time) {
                    echo "time over \n";
                } else {
                    echo " 0\n";
                }
                
            }
            //exit();
            if ($counter_temp>100000) {
                    exit();
                }*/
        }
        
        //echo json_encode($return);
        //echo $output_str;
        //exit();
        return $return;
    }
    
    public function _actionGetDataReportDataTable($folder,$report_name,$datatable_start,$length,&$data2){
        $data2=[
                [
                  "sensor_name"=> "18:1:f1:69:a2:52"
                ],
                [
                  "sensor_name"=> "18c617053c9647189064c301ed1cb4b5"
                ],
                [
                  "sensor_name"=> "2117febe6b354efe94dbe8a65221061e"
                ],
                [
                  "sensor_name"=> "27ef1aafe20d4ed0b4f2c6468bd43ff8"
                ],
                [
                  "sensor_name"=> "28:31:66:8c:d2:65"
                ],
                [
                  "sensor_name"=> "28:8c:b8:55:b7:49"
                ],
                [
                  "sensor_name"=> "28:8c:b8:55:b7:69"
                ],
                [
                  "sensor_name"=> "28:8c:b8:55:b7:ab"
                ],
                [
                  "sensor_name"=> "374dd021523f491a9ed752cb1c08b018"
                ],
                [
                  "sensor_name"=> "111"
                ]
              ];
        return false;
        
    }

}
