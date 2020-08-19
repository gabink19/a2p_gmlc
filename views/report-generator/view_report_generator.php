
<?      use app\models\ReportGenerator;
        $filter2 = "";
        $builder=0;
        $params = file_get_contents(Yii::$app->basePath."/report/". $folder);
        $json = json_decode($params, true);
        $column=  $json["column"];  
        $filter_advance=$json["filter_advance"]; 
        $timeout=$json["timeout"];
        if ($timeout=="") {
           $timeout=30*60000; 
        }
        $model = new ReportGenerator();
        $model->limit=$json["limit"]; 
        
        echo $this->render('view_report2', [
                             'report' => $json["page"][$report_name]["report"],
                             'report_name' => $report_name,
                             'folder' => $folder,
                             'column'=>$json["column"],
                             'use_column'=>$json["page"][$report_name]["use_column"],
                        
                             'filter2' => $filter2,
                            
                             'model'=>$model,
                             "new_flag"=>false,
                             'andWhere'=> $andWhere,
                             'timeout'=> $timeout,

                             'limit'=>$limit,
                             'builder'=>$builder,
                             'filter_advance'=>$filter_advance,
                             'ajax_mode'=>1,

                 ]); 