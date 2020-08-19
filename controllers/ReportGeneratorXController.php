<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\ReportGenerator;
use app\models\ReportGeneratorX;
use app\models\ReportGeneratorXSearch;
use yii\widgets\ActiveForm;


class ReportGeneratorXController extends ReportGeneratorController {
    
    public function behaviors()
    {
    
        return [
            // 'access' => [
        
            //     'class' => AccessControl::className(),
            //     'only' => [
            //             'index','create','update','view','delete','get-all-table-data','get-data-report','save-data-report',
            //             'get-data-report2','get-data-report3', 'get-data-report4', 'create-dashboard'
                    
            //             ],
            //     'rules' => [
                
            //     [
            //     'allow' => true,
            //     'actions' => ['index','create','update','view','delete','get-all-table-data', 'get-data-report', 'create-dashboard'],
            //     'roles' => ['ReportGeneratorController'.'.xx.create'],
            //     ],
            //    [
            //     'allow' => true,
            //     'actions' => ['create-dashboard'],
            //     'roles' => ['ReportGeneratorDashboardController'.'.xx.create'],
            //     ],
        
        
        
            //     ],
            // ],
        
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '_delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($app_mode=null) {
        $params = Yii::$app->request->queryParams;
        // print_r($params);die();
        $searchModel = new ReportGeneratorXSearch();
        $dataProvider = $searchModel->search($params);
        // echo "<pre>";print_r($dataProvider);die();
        $create_flag=true;
        $update_flag=true;
        $delete_flag=true;
        $view_flag=true;
        /*
        if (Yii::$app->user->can(static::class.'.create')) { 
            $create_flag=true;
            
        }
        if (Yii::$app->user->can(static::class.'.update')) { 
            $update_flag=true;
            
        }
        if (Yii::$app->user->can(static::class.'.delete')) { 
            $delete_flag=true;
            
        }
        if (Yii::$app->user->can(static::class.'.view')) { 
            $view_flag=true;
            
        }*/
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        return $this->$command('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'create_flag'=>$create_flag,
            'update_flag'=>$update_flag,
            'delete_flag'=>$delete_flag,
            'view_flag'=>$view_flag,
            'app_mode'=>$app_mode,
            'pjax_enable' => 1,
            'remove_create1'=>1,   
        ]);
    }

    public function actionCreate($app_mode=null) {
        Yii::debug('ReportGeneratorX actionCreate');
        $model = new ReportGeneratorX();
        $currentdb  = Yii::$app->db;
        $connection= explode('dbname=', $currentdb->dsn);
        $table = $this->actionGetAllTableData($connection[1]);
        $listtable = $table['table'];
        
        //if (Yii::$app->request->isAjax) {
        $post_data = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            Yii::debug('ReportGeneratorX actionCreate post');
            $model->tj_file = $model->tj_name.".json";
            $validate = true;
            $message = "";
            $report_post = json_decode($post_data['json'],true);
            $illegal = "#$%^&*()+=-[]';,./{}|:<>?!~@ ";

            if (isset($report_post["column"])) {
                foreach ($report_post["column"] as $key => $value) {
                    if (strpbrk($value["ALIAS_NAME"], $illegal)) {
                        $validate = false;
                        $message = "ALIAS_NAME cannot contain special character except \"_\"";
                    }
                }
            }
            if (!isset($report_post["column"])) {
                $validate = false;
                $message = "Field cannot be blank";
            }

            if ($validate) {
                if ($model->save()) {
                    Yii::debug('ReportGeneratorX actionCreate post 2');
                    $this->actionSaveReport2($model->tj_file,$report_post,$model->getPrimaryKey());
                    $this->actionAuthCreateSecurity($model->tj_file,$model->tj_name);
                    
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => '*Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                } else {
                    Yii::debug('ReportGeneratorX actionCreate post error');
                    return [
                        'data' => [
                            'success' => false,
                            'model' => $model,
                            'message' => 'Model saved error.',
                        ],
                        'code' => 0,
                    ];
                }
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
            Yii::debug('ReportGeneratorX actionCreate normal');
            $command="render";
                    if ($app_mode==1) {
                     $this->layout='main_mobile';
                        $command="render";
                    }
            return $this->$command('create', [
                'model' => $model,
                'view_form'=>'_form',
                'modal_class'=>'comment-form',
                'table' => $listtable,
                'app_mode'=>$app_mode
            ]);
        }
        //}
    }
    
    public function actionCreateAjax() {
        Yii::debug('ReportGeneratorX actionCreate');
        $model = new ReportGeneratorX();
        $schema = "icloud";
        $table = $this->actionGetAllTableData($schema);
        $listtable = $table['table'];
        
        
        
        
        //if (Yii::$app->request->isAjax) {
            $post_data = Yii::$app->request->post();
            if ($model->load(Yii::$app->request->post())) {
                Yii::debug('ReportGeneratorX actionCreate post');
                $model->tj_file = $model->tj_name.".json";

                if ($model->save()) {
                    Yii::debug('ReportGeneratorX actionCreate post 2');
                    $this->actionSaveReport($model->tj_file,$post_data['json']);
                    $this->actionAuthCreateSecurity($model->tj_file,$model->tj_name);
                    
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => '*Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                    
                    /*return $this->redirect(['index',
                    ]);*/
                } else {
                    Yii::debug('ReportGeneratorX actionCreate post error');
                    return [
                        'data' => [
                            'success' => false,
                            'model' => $model,
                            'message' => 'Model saved error.',
                        ],
                        'code' => 0,
                    ];
                    /*return $this->redirect(['index',
                    ]);*/
                }
            } else {
                Yii::debug('ReportGeneratorX actionCreate normal');
                return $this->renderAjax('create', [
                    'model' => $model,
                    'view_form'=>'_form',
                    'modal_class'=>'comment-form',
                    'table' => $listtable,
                ]);
            }
        //}
    }

    public function actionUpdate($id,$redirect_url=null,$app_mode=null) {
        
        $model = $this->findModel($id);
        $oldModel = $this->findModel($id);
        $currentdb  = Yii::$app->db;
        $connection= explode('dbname=', $currentdb->dsn);
        $table = $this->actionGetAllTableData($connection[1]);
        $listtable = $table['table'];

        $params = file_get_contents(dirname(__DIR__) . "/report/" . $model->tj_file);
        $json = json_decode($params, true);

        $post_data = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->tj_file = $model->tj_name.".json";
            $validate = true;
            $message = "";
            $report_post = json_decode($post_data['json'],true);
            $illegal = "#$%^&*()+=-[]';,./{}|:<>?!~@ ";

            if (isset($report_post["column"])) {
                foreach ($report_post["column"] as $key => $value) {
                    if (strpbrk($value["ALIAS_NAME"], $illegal)) {
                        $validate = false;
                        $message = "ALIAS_NAME cannot contain special character except \"_\"";
                    }
                }
            }
            if (!isset($report_post["column"])) {
                $validate = false;
                $message = "Field cannot be blank";
            }

            if ($validate) {
                if ($model->save()) {
                    $json["column"]=$report_post["column"];
                    $this->actionSaveReport2($model->tj_file,$json,$model->getPrimaryKey());
                    $this->actionAuthDeleteSecurity($oldModel->tj_file);
                    $this->actionAuthCreateSecurity($model->tj_file,$model->tj_name);
                    
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => '*Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                    
                    /*return $this->redirect(['index',
                    ]);*/
                } else {
                    return [
                        'data' => [
                            'success' => false,
                            'model' => $model,
                            'message' => 'Model saved error.',
                        ],
                        'code' => 0,
                    ];
                    /*return $this->redirect(['index',
                    ]);*/
                }
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
            $command="render";
                    if ($app_mode==1) {
                     $this->layout='main_mobile';
                        $command="render";
                    }
            return $this->$command('update', [
                'model' => $model,
                'view_form'=>'_form',
                'modal_class'=>'comment-form',
                'table' => $listtable,
                'app_mode'=>$app_mode,
                'json' => $json,
                'redirect_url'=>$redirect_url
            ]);
        }
    }

    public function actionView($id,$app_mode=null) {
        $model = $this->findModel($id);
        $params = file_get_contents(dirname(__DIR__) . "/report/" . $model->tj_file);
        $json = json_decode($params, true);
        $column = $json["column"]; 

        return $this->renderAjax('view', [
            'model' => $model,
            'column' => $column,
        ]);
    }

    public function actionDelete($id) {
        $model=$this->findModel($id);
        $this->actionAuthDeleteSecurity($model->tj_file);
        if (file_exists(dirname(__DIR__) . "/report/" . $model->tj_file)){
             unlink(dirname(__DIR__) . "/report/" . $model->tj_file);
        }
        $model->delete();

        return $this->redirect(['index','app_mode'=>$app_mode
                
        ]);
    }

    public function actionValidation()
    {
        $model = new ReportGeneratorX;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    
    
    protected function findModel($id)
    {
        if (($model = ReportGeneratorX::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
     
    
    // public function actionSaveReport($folder, $obj_data) {
    //     $report_file = dirname(__DIR__) . "/report/" . $folder;
    //     $array = array("data" => [$obj_data], "column" => $obj_column);
    //     $json = json_decode($obj_data,true);
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    //     file_put_contents($report_file, str_replace('\"', '"', json_encode($json,true)));
        
    //     return $json;
    // }

    public function actionSaveReport($folder, $obj_data) {
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        
        $json = json_decode($obj_data,true);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if (file_exists($report_file)){
        rename($report_file,$report_file.".".date('YmdHis'));
        }
        //file_put_contents($report_file, str_replace('\"', '"', json_encode($json,true)));
        file_put_contents($report_file, json_encode($json,true));
      
        
        return $json;
    }
    
    public function actionSaveReport2($folder, $json,$id=null) {
       
        $report_file = dirname(__DIR__) . "/report/" . $folder;
        if (isset($id)) {
            $json["db_id"]=$id;
        }
         //echo json_encode($json);
         //exit();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if (file_exists($report_file)){
            rename($report_file,$report_file.".".date('YmdHis'));
        }
        file_put_contents($report_file, json_encode($json,true));
      
        
        return $json;
    }

    public function actionCreateDashboard($app_mode=null)
    {
        $model = new ReportGeneratorX();
        $currentdb  = Yii::$app->db;
        $connection = explode('dbname=', $currentdb->dsn);
        $table = $this->actionGetAllTableData($connection[1]);
        $listtable = $table['table'];
        $params = file_get_contents(dirname(__DIR__) . "/report/base_report.json");
        $files = \yii\helpers\FileHelper::findFiles(dirname(__DIR__) . "/report");
        $json = json_decode($params, true);
        $a= dirname(__DIR__) . "/report";
        // print("<pre>" . print_r($files, true) . "</pre>");
        // exit;
        if ($model->load(Yii::$app->request->post())) {
            $model->tj_file = $model->tj_name . "-dashboard.json";
                foreach ($files as $file){
                    $simpan=explode(dirname(__DIR__) . "/report/",$file);
                    if ($simpan[1] == $model->tj_file){
                    // Yii::$app->session->setFlash("error", 'This name already exists!');
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => 'fail',
                            'model' => $model,
                            // 'd1' => $simpan,
                            // 'd2' => $model->tj_file
                        ],
                        'code' => 0,
                    ];
                    }
                    }

                $this->actionSaveReport($model->tj_file, $params);
                $this->actionAuthCreateSecurity2($model->tj_file, $model->tj_name);
                $this->actionAuthCreateSecurity($model->tj_file, $model->tj_name);
                // Yii::$app->session->setFlash("success", 'Success create dashboard');
            
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'folder' => $model->tj_file,
                        'message' => '*Model has been saved.',
                    ],
                    'code' => 0,
                // 'd1' => $simpan,
                // 'd2' => $model->tj_file
                ];
            
        } 
        else {
            $command="render";
                    if ($app_mode==1) {
                     $this->layout='main_mobile';
                        $command="render";
                    }
            return $this->$command('create_dashboard', [
                'model' => $model,
                'view_form' => 'create-dashboard',
                'modal_class' => 'comment-form',
                'app_mode'=>$app_mode
                // 'table' => $listtable,
            ]);
        }
        //}
    }
    public function actionUpdateDashboard($folder,$app_mode=null)
    {
        $model = new ReportGeneratorX();
        $currentdb  = Yii::$app->db;
        $connection = explode('dbname=', $currentdb->dsn);
        $table = $this->actionGetAllTableData($connection[1]);
        $listtable = $table['table'];
        $folder_old = $folder . "-dashboard.json";
        $params = file_get_contents(dirname(__DIR__) . "/report/". $folder_old);
        $files = \yii\helpers\FileHelper::findFiles(dirname(__DIR__) . "/report");
        // $json = json_decode($params, true);
        // $a = dirname(__DIR__) . "/report";
        // print("<pre>" . print_r($files, true) . "</pre>");
        // exit;
        if ($model->load(Yii::$app->request->post())) {
            $model->tj_file = $model->tj_name . "-dashboard.json";
            foreach ($files as $file) {
                $simpan = explode(dirname(__DIR__) . "/report/", $file);
                if ($simpan[1] == $model->tj_file) {
                    // Yii::$app->session->setFlash("error", 'This name already exists!');
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => 'fail save',
                            'model' => $model,
                            // 'd1' => $simpan,
                            // 'd2' => $model->tj_file
                        ],
                        'code' => 0,
                    ];
                }
            }
           
            $this->actionSaveReport($model->tj_file, $params);
            $this->actionAuthDeleteSecurity2($folder_old);
            $this->actionAuthDeleteSecurity($folder_old);
            $this->actionAuthCreateSecurity2($model->tj_file, $model->tj_name);
            $this->actionAuthCreateSecurity($model->tj_file, $model->tj_name);
            
            if (file_exists(dirname(__DIR__) . "/report/" . $folder_old)) {
                unlink(dirname(__DIR__) . "/report/" . $folder_old);
            }
            // Yii::$app->session->setFlash("success", 'Success create dashboard');

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'folder' => $model->tj_name,
                    'message' => '*Model has been saved.',
                ],
                'code' => 0,
                // 'd1' => $simpan,
                // 'd2' => $model->tj_file
            ];
        } else {
            $model->tj_name=$folder;
            $command="render";
                    if ($app_mode==1) {
                     $this->layout='main_mobile';
                        $command="render";
                    }
            return $this->$command('create_dashboard', [
                'model' => $model,
                'folder'=>$folder,
                'view_form' => 'update-dashboard',
                'modal_class' => 'comment-form',
                'app_mode'=>$app_mode
                // 'table' => $listtable,
            ]);
        }
        //}
    }

    public function actionAuthCreateSecurity2($folder, $name)
    {

        $url_name = "tree/index&folder=" . $folder;
        $folder_array = explode(".", $folder);
        $app_name = "Dashboard(" . $name . ")";
        $controllerClass = "TreeController";
        $menu1 = 'null';
        $menu2 = 'null';
        $sql = "CALL create_auth_report2('" . $controllerClass . "', '" . $controllerClass . "'," . $menu1 . "," . $menu2 . ",'" . $app_name . "','" . $url_name . "','" . "." . $folder . "');";
        $result = Yii::$app->db->createCommand($sql)
            ->execute();
    }
    public function actionAuthDeleteSecurity2($folder)
    {

        $url_name = "tree/index&folder=" . $folder;
        $folder_array = explode(".", $folder);
        $app_name = "Dashboard(" . $name . ")";
        $controllerClass = "TreeController";
        $result = Yii::$app->db->createCommand("CALL delete_auth_report2('" . $controllerClass . "', '" . $controllerClass . "',null,null,'" . $app_name . "','" . $url_name . "','" . "." . $folder . "');")
            ->execute();
    }

}

//https://yii.apsolusi.com/index.php?r=report-generator%2Fget-data-report4&folder=report3.json&report_name=report
//https://yii.apsolusi.com/index.php?r=report-generator%2Fget-data-report4&folder=report3.json&report_name=report