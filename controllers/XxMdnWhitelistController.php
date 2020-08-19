<?php

namespace app\controllers;

use Yii;
use app\models\MdnWhitelist;
use yii\filters\AccessControl;

use app\models\MdnWhitelistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MdnWhitelistController implements the CRUD actions for MdnWhitelist model.
 */
class XxMdnWhitelistController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
        
                'class' => AccessControl::className(),
                'only' => ['index','index-ajax','index-listview','index-listview2','api-index',
                        'create','create-ajax','create2','api-create',
                        'update','update-ajax','update2','api-update',
                        'delete','delete-ajax','delete2','api-delete',
                        'view','view-only','api-view'
                        ],
                'rules' => [
                [
                'allow' => true,
                'actions' => ['index','index-ajax','index-listview','index-listview2','api-index'],
                'roles' => [static::class.'.index'],
                ],
                [
                'allow' => true,
                'actions' => ['create','create-ajax','create2','api-create'],
                'roles' => [static::class.'.create'],
                ],
                [
                'allow' => true,
                'actions' => ['update','update-ajax','update2','api-update'],
                'roles' => [static::class.'.update'],
                ],
                [
                'allow' => true,
                'actions' => ['delete','delete-ajax','delete2','api-delete'],
                'roles' => [static::class.'.delete'],
                ],
                [
                'allow' => true,
                'actions' => ['view','view-only','api-view'],
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
     * Lists all MdnWhitelist models.
     * @return mixed
     */
     
public function actionIndex($app_mode=null)    {
    
        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['MdnWhitelistSearch'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['MdnWhitelistSearch'];
                if ($Search_params!=null){        
                    $params['MdnWhitelistSearch']=$Search_params;
                }
            } else {
               Yii::$app->session['MdnWhitelistSearch']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['MdnWhitelistSearch_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['MdnWhitelistSearch_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['MdnWhitelistSearch_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['MdnWhitelistSearch_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['MdnWhitelistSearch'];
            if ($Search_params!=null){        
               $params['MdnWhitelistSearch']=$Search_params;
            }
            $page_params=Yii::$app->session['MdnWhitelistSearch_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['MdnWhitelistSearch_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
        $searchModel = new MdnWhitelistSearch();
                
        $dataProvider = $searchModel->search($params
    );        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
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
            'remove_create2'=>1,            
                        
            
        ]);
    }
    
public function actionIndexAjax($app_mode=null)    
    {

        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['MdnWhitelistSearch'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['MdnWhitelistSearch'];
                if ($Search_params!=null){        
                    $params['MdnWhitelistSearch']=$Search_params;
                }
            } else {
               Yii::$app->session['MdnWhitelistSearch']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['MdnWhitelistSearch_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['MdnWhitelistSearch_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['MdnWhitelistSearch_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['MdnWhitelistSearch_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['MdnWhitelistSearch'];
            if ($Search_params!=null){        
               $params['MdnWhitelistSearch']=$Search_params;
            }
            $page_params=Yii::$app->session['MdnWhitelistSearch_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['MdnWhitelistSearch_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
                $searchModel = new MdnWhitelistSearch();
                
        
        
        $dataProvider = $searchModel->search($params
    );
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
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
        $searchModel = new MdnWhitelistSearch();
                
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
        );        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
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
        $searchModel = new MdnWhitelistSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    );        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
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
        $model = new MdnWhitelist();

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
     * Displays a single MdnWhitelist model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($app_mode=null,$id)
    {
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
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
        
                    ]);
    }

    /**
     * Creates a new MdnWhitelist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     

public function actionCreate($app_mode=null)     
    {
        $model = new MdnWhitelist();


        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->tmw_id]);
            $a = 'SELECT count(*) as tot from tbl_mdn_whitelist where tmw_mdn="'.$model->tmw_mdn.'"';
            $mdn = Yii::$app->db->createCommand($a)->queryScalar();
            if ($mdn==0) {
                if ($model->save()) {
                    return $this->redirect(['index',
                        'app_mode'=>$app_mode,
                                            ]);
                }
            }else{
                $model->addError('tmw_mdn', 'MDN Must be Unique');
            }
        }
        
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('create', [
            'model' => $model,
            'app_mode'=>$app_mode,

                        
                            
        ]);
    }
public function actionCreate2($app_mode=null)    
    {
        $model = new MdnWhitelist();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->tmw_id]);

            if ($model->save()) {
            
                return $this->redirect(['index-listview',
                        'app_mode'=>$app_mode,
                                
                ]);
             }
        }
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('create', [
            'model' => $model,
             'app_mode'=>$app_mode,

                    
        ]);
    }
    
    
    
    

    /**
     * Updates an existing MdnWhitelist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($app_mode=null,$id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->tmw_id]);
            $a = 'SELECT count(*) as tot from tbl_mdn_whitelist where tmw_mdn="'.$model->tmw_mdn.'" and tmw_id <> "'.$model->tmw_id.'"';
            $mdn = Yii::$app->db->createCommand($a)->queryScalar();
            if ($mdn==0) {
                if ($model->save()) {
                    return $this->redirect(['index',
                        'app_mode'=>$app_mode,
                                            ]);
                }
            }else{
                $model->addError('tmw_mdn', 'MDN Must be Unique');
            }
        }
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('update', [
            'model' => $model,
            'app_mode'=>$app_mode,

                        
                    ]);
    }
    
    /**
     * Deletes an existing MdnWhitelist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($app_mode=null,$id)
    {
        $model=$this->findModel($id);
        if($model->delete()){
            Yii::$app->session->setFlash('success', 'Success delete ');
        } else {
            Yii::$app->session->setFlash('error', 'Fail delete ');
        }

        return $this->redirect(['index',
                'app_mode'=>$app_mode
        ]);
    }
    
    
    public function actionUpdate2($app_mode=null,$id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
                        
            if ($model->save()){
                //return $this->redirect(['view', 'id' => $model->tmw_id]);
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
     * Finds the MdnWhitelist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MdnWhitelist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MdnWhitelist::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
//