<?php

namespace app\controllers;

use Yii;
use app\models\AuthLogin;
use yii\filters\AccessControl;

use app\models\AuthLoginSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthLoginController implements the CRUD actions for AuthLogin model.
 */
class XxAuthLoginController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
        
                'class' => AccessControl::className(),
                'only' => ['index','index-ajax','index-listview','index-listview2',
                        'create','create-ajax','create2',
                        'update','update-ajax','update2',
                        'delete','delete-ajax','delete2',
                        'view','view-only'],
                'rules' => [
                [
                'allow' => true,
                'actions' => ['index','index-ajax','index-listview','index-listview2'],
                'roles' => [static::class.'.index'],
                ],
                [
                'allow' => true,
                'actions' => ['create','create-ajax','create2'],
                'roles' => [static::class.'.create'],
                ],
                [
                'allow' => true,
                'actions' => ['update','update-ajax','update2'],
                'roles' => [static::class.'.update'],
                ],
                [
                'allow' => true,
                'actions' => ['delete','delete-ajax','delete2'],
                'roles' => [static::class.'.delete'],
                ],
                [
                'allow' => true,
                'actions' => ['view','view-only'],
                'roles' => [static::class.'.view'],
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

    /**
     * Lists all AuthLogin models.
     * @return mixed
     */
     
public function actionIndex($app_mode=null)    {
    
        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['AuthLoginSearch'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['AuthLoginSearch'];
                if ($Search_params!=null){        
                    $params['AuthLoginSearch']=$Search_params;
                }
            } else {
               Yii::$app->session['AuthLoginSearch']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['AuthLoginSearch_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['AuthLoginSearch_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['AuthLoginSearch_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['AuthLoginSearch_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['AuthLoginSearch'];
            if ($Search_params!=null){        
               $params['AuthLoginSearch']=$Search_params;
            }
            $page_params=Yii::$app->session['AuthLoginSearch_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['AuthLoginSearch_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
        $searchModel = new AuthLoginSearch();
                
        $dataProvider = $searchModel->search($params
    );        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        $create_flag=false;
        $update_flag=false;
        $delete_flag=false;
        $view_flag=false;
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
            
        }
            
        
        return $this->$command('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'app_mode'=>$app_mode,
            'create_flag'=>$create_flag,
            'update_flag'=>$update_flag,
            'delete_flag'=>$delete_flag,
            'view_flag'=>$view_flag,
       
            'pjax_enable' => 1,
            'remove_create1'=>1,            
                        
            
        ]);
    }
    
public function actionIndexAjax($app_mode=null)    
    {

        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['AuthLoginSearch'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['AuthLoginSearch'];
                if ($Search_params!=null){        
                    $params['AuthLoginSearch']=$Search_params;
                }
            } else {
               Yii::$app->session['AuthLoginSearch']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['AuthLoginSearch_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['AuthLoginSearch_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['AuthLoginSearch_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['AuthLoginSearch_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['AuthLoginSearch'];
            if ($Search_params!=null){        
               $params['AuthLoginSearch']=$Search_params;
            }
            $page_params=Yii::$app->session['AuthLoginSearch_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['AuthLoginSearch_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
                $searchModel = new AuthLoginSearch();
                
        
        
        $dataProvider = $searchModel->search($params
    );
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modal_mode'=>1,
            'pjax_enable' => 1,
            'app_mode'=>$app_mode,

            'remove_create2'=>1,
                            
            
        ]);
    }
public function actionIndexListview($app_mode=null)    
    {
        $searchModel = new AuthLoginSearch();
                
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
        );        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        

        return $this->$command('index_listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 0,
            'remove_create1'=>1,
            'app_mode'=>$app_mode,

                                    
        ]);
    }
    public function actionIndexListview2($app_mode=null)
    {
        $searchModel = new AuthLoginSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    );        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        return $this->$command('index_listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'pjax_enable2' => 0,
            'update_action'=>'update-ajax',
            'delete_action'=>'delete-ajax',
            'remove_update'=>2,
            'remove_delete'=>2,
            'app_mode'=>$app_mode,
            'remove_create2'=>1,
                            
        ]);
    }
    
    //mode 3 
    public function actionViewOnly($app_mode=null,$id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'remove_title'=> 1,
            'remove_delete'=>1,
            'remove_update'=>1,
                                
        ]);
    }
    
    
    public function actionUpdateAjax($app_mode=null,$id)
    {
        $model = $this->findModel($id);


        if (Yii::$app->request->isAjax) {
            
            if ($model->load(Yii::$app->request->post()) ) {
            
                if ($filter!="") {
                    $split_array = explode("#", $filter);
                    echo "\$temp_master_id= ".$split_array[0].";
                        if (\$temp_master_id!=null){
                            \$model->".$split_array[1]."=".$split_array[0].";

                        }";

                }

                if ($model->save()){
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => 'Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                };
            }
        }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'pjax_enable' => 0,
            'view_form'=>'_active_form',
            'remove_title'=> 1,
            'remove_update'=>1,
            'remove_delete'=>1,
            'view_form2'=>'update-ajax',
            'modal_class'=>'comment-form',
            'remove_detail'=>1,
                        
    
                
        ]);
    }
    
public function actionCreateAjax($app_mode=null)   {
        $model = new AuthLogin();

        if (Yii::$app->request->isAjax) {
            
            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => 'Model has been saved.',
                        ],
                        'code' => 0,
                    ];
                }
            }
        }
        
        return $this->renderAjax('create', [
            'model' => $model,
            'view_form'=>'_active_form',
            'pjax_enable'=>0,
            'view_form2'=>'create-ajax',
            'modal_class'=>'comment-form',
            'remove_title'=> 1,
                        
    
            
        ]);
    }
    

    /**
     * Displays a single AuthLogin model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($app_mode=null,$id)
    {
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        //update rights
        
        if (Yii::$app->user->can(static::class.'.update')) { 
            $update_flag=true;
            
        }
        if (Yii::$app->user->can(static::class.'.delete')) { 
            $delete_flag=true;
            
        }
        

        return $this->$command('view', [
            'model' => $this->findModel($id),
            'app_mode'=>$app_mode,
            'update_flag'=>$update_flag,
            'delete_flag'=>$delete_flag,
            'tipe'=>1,
        
                    ]);
    }

    /**
     * Creates a new AuthLogin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
public function actionCreate($app_mode=null)     
    {
        $model = new AuthLogin();
        $model->scenario="signup";

        if ($model->load(Yii::$app->request->post())) {
            // $model->tl_user_status_ref=0;
            $comp_password=Yii::$app->id.$model->tl_username.$model->tl_password_new;
            $hash_password = Yii::$app->getSecurity()->generatePasswordHash($comp_password);
        
            $model->tl_password=$hash_password;
            $model->user_id=Yii::$app->getSecurity()->generateRandomString();
            if ($model->save()) {
                return $this->redirect(['index',
                    'app_mode'=>$app_mode,
                                        ]);
            }
        }
        
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('create', [
            'model' => $model,
            'app_mode'=>$app_mode,
            'tipe'=>2,

                        
                            
        ]);
    }
public function actionCreate2($app_mode=null)    
    {
        $model = new AuthLogin();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->user_id]);

            if ($model->save()) {
            
                return $this->redirect(['index-listview',
                        'app_mode'=>$app_mode,
                                
                ]);
             }
        }
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('create', [
            'model' => $model,
             'app_mode'=>$app_mode,

                    
        ]);
    }
    
    
    
    

    /**
     * Updates an existing AuthLogin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($app_mode=null,$id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
                        if ($model->save()){
                //return $this->redirect(['view', 'id' => $model->user_id]);
                return $this->redirect(['index',
                    'app_mode'=>$app_mode,
                                                    ]);
            };
        }
        $command="render";
        if ($app_mode==1) {
            $command="renderAjax";
        }
        
        return $this->$command('update', [
            'model' => $model,
            'app_mode'=>$app_mode,
            'tipe'=>1,

                        
                    ]);
    }
    
    /**
     * Deletes an existing AuthLogin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($app_mode=null,$id)
    {
        $model=$this->findModel($id);
        $query = "SELECT count(*) as tot FROM auth_assignment WHERE user_id='".$id."'";
        $total =  Yii::$app->db->createCommand($query)->queryScalar();
        if ($total>0) {
            $query = "DELETE FROM auth_assignment WHERE user_id='".$id."'";
            Yii::$app->db->createCommand($query)->execute();
        }
        $model->delete();

        return $this->redirect(['index',
                
        ]);
    }
    
    
    public function actionUpdate2($app_mode=null,$id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
                        
            if ($model->save()){
                //return $this->redirect(['view', 'id' => $model->user_id]);
                return $this->renderAjax('view', [
                    'model' => $model,
                    'remove_title'=> 1,
                    'update_action'=>'update2',
                    'delete_action'=>'delete2',
                    'app_mode'=>$app_mode,

                    

                ]);
            };
        
        }
        return $this->renderAjax('_active_form', [
                'model' => $model,
                        ]);
        
    }

    
    public function actionDelete2($app_mode=null,$id)
    {
        $this->findModel($id)->delete();
        return $this->renderAjax('_delete');
        //return "deleted";
    }
    
    public function actionDeleteAjax($app_mode=null,$id)
    {
        $query = "SELECT count(*) as tot FROM auth_assignment WHERE user_id='".$id."'";
        $total =  Yii::$app->db->createCommand($query)->queryScalar();
        if ($total>0) {
            $query = "DELETE FROM auth_assignment WHERE user_id='".$id."'";
            Yii::$app->db->createCommand($query)->execute();
        }
        $this->findModel($id)->delete();

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'message' => 'Model has been deleted.',
                    ],
                    'code' => 0,
                ];
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    /**
     * Finds the AuthLogin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthLogin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthLogin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
//