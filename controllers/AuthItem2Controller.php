<?php

namespace app\controllers;

use Yii;
use app\models\AuthItem2;
use yii\filters\AccessControl;

use app\models\AuthItem2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItem2Controller implements the CRUD actions for AuthItem2 model.
 */
class AuthItem2Controller extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem2 models.
     * @return mixed
     */
public function actionIndex()    {
    
        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['AuthItem2Search'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['AuthItem2Search'];
                if ($Search_params!=null){        
                    $params['AuthItem2Search']=$Search_params;
                }
            } else {
               Yii::$app->session['AuthItem2Search']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['AuthItem2Search_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['AuthItem2Search_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['AuthItem2Search_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['AuthItem2Search_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['AuthItem2Search'];
            if ($Search_params!=null){        
               $params['AuthItem2Search']=$Search_params;
            }
            $page_params=Yii::$app->session['AuthItem2Search_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['AuthItem2Search_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
        $searchModel = new AuthItem2Search();
        $temp_master_id= 2;
                if ($temp_master_id!=null){
                    $searchModel->type=2;

                }        
        $dataProvider = $searchModel->search($params
    );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'remove_create2'=>1,
            
        ]);
    }
    
public function actionIndexAjax()    
    {

        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['AuthItem2Search'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['AuthItem2Search'];
                if ($Search_params!=null){        
                    $params['AuthItem2Search']=$Search_params;
                }
            } else {
               Yii::$app->session['AuthItem2Search']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['AuthItem2Search_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['AuthItem2Search_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['AuthItem2Search_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['AuthItem2Search_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['AuthItem2Search'];
            if ($Search_params!=null){        
               $params['AuthItem2Search']=$Search_params;
            }
            $page_params=Yii::$app->session['AuthItem2Search_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['AuthItem2Search_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
                $searchModel = new AuthItem2Search();
        $temp_master_id= 2;
                if ($temp_master_id!=null){
                    $searchModel->type=2;

                }        
        
        
        $dataProvider = $searchModel->search($params
    );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modal_mode'=>1,
            'pjax_enable' => 1,
            'remove_create2'=>1,
                
            
        ]);
    }
public function actionIndexListview()    
    {
        $searchModel = new AuthItem2Search();
        $temp_master_id= 2;
                if ($temp_master_id!=null){
                    $searchModel->type=2;

                }        
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
        );

        return $this->render('index_listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 0,
            'remove_create1'=>1,
                        
        ]);
    }
    public function actionIndexListview2()
    {
        $searchModel = new AuthItem2Search();
        $temp_master_id= 2;
                if ($temp_master_id!=null){
                    $searchModel->type=2;

                }        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    );
        return $this->render('index_listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'pjax_enable2' => 0,
            'update_action'=>'update-ajax',
            'delete_action'=>'delete-ajax',
            'remove_update'=>2,
            'remove_delete'=>2,
            'remove_create2'=>1,
                
        ]);
    }
    
    //mode 3 
    public function actionViewOnly($id)
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
    
    
    public function actionUpdateAjax($id)
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
    
public function actionCreateAjax()   {
        $model = new AuthItem2();
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }
        if (Yii::$app->request->isAjax) {
            
            if ($model->load(Yii::$app->request->post())) {
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }
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
     * Displays a single AuthItem2 model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
public function actionCreate()     
    {
        $model = new AuthItem2();
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->name]);
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }            if ($model->save()) {
                return $this->redirect(['index',
                    ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
                
        ]);
    }
public function actionCreate2()    
    {
        $model = new AuthItem2();
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->name]);
$temp_master_id= 2;
            if ($temp_master_id!=null){
                $model->type=2;

            }
            if ($model->save()) {
            
                return $this->redirect(['index-listview',
        
                ]);
             }
        }

        return $this->render('create', [
            'model' => $model,
        
        ]);
    }
    
    
    
    

    /**
     * Updates an existing AuthItem2 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $temp_master_id= 2;
                    if ($temp_master_id!=null){
                        $model->type=2;

                    }            if ($model->save()){
                //return $this->redirect(['view', 'id' => $model->name]);
                return $this->redirect(['index',
                                ]);
            };
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing AuthItem2 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();

        return $this->redirect(['index',
        
        ]);
    }
    
    
    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $temp_master_id= 2;
                    if ($temp_master_id!=null){
                        $model->type=2;

                    }            
            if ($model->save()){
                //return $this->redirect(['view', 'id' => $model->name]);
                return $this->renderAjax('view', [
                    'model' => $model,
                    'remove_title'=> 1,
                    'update_action'=>'update2',
                    'delete_action'=>'delete2',


                ]);
            };
        
        }
        return $this->renderAjax('_active_form', [
                'model' => $model,
        ]);
        
    }

    
    public function actionDelete2($id)
    {
        $this->findModel($id)->delete();

        return "deleted";
    }
    
    public function actionDeleteAjax($id)
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
    
    
    /**
     * Finds the AuthItem2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem2::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
//profile group