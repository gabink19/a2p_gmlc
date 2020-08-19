<?php

namespace app\controllers;

use Yii;
use app\models\AuthAssignment;
use yii\filters\AccessControl;

use app\models\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends Controller
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
     * Lists all AuthAssignment models.
     * @return mixed
     */
public function actionIndex($master_id)    {
    
    
        $searchModel = new AuthAssignmentSearch();
                
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    ,$master_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'remove_create2'=>1,
                'master_id'=>$master_id,        
        ]);
    }
    
public function actionIndexAjax($master_id)    
    {
        $searchModel = new AuthAssignmentSearch();
                
        
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    ,$master_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modal_mode'=>1,
            'pjax_enable' => 1,
            'remove_create2'=>1,
                        'master_id'=>$master_id,    
            
        ]);
    }
public function actionIndexListview($master_id)    
    {
        $searchModel = new AuthAssignmentSearch();
                
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
        ,$master_id);

        return $this->render('index_listview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pjax_enable' => 0,
            'remove_create1'=>1,
                        'master_id'=>$master_id,            
        ]);
    }
    public function actionIndexListview2($master_id)
    {
        $searchModel = new AuthAssignmentSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    ,$master_id);
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
                'master_id'=>$master_id,            
        ]);
    }
    
    //mode 3 
    public function actionViewOnly($item_name, $user_id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($item_name, $user_id),
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'remove_title'=> 1,
            'remove_delete'=>1,
            'remove_update'=>1,
                    
        ]);
    }
    
    
    public function actionUpdateAjax($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);


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
            'model' => $this->findModel($item_name, $user_id),
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
    
public function actionCreateAjax($master_id)   {
        $model = new AuthAssignment();
if ($master_id!=null) $model->user_id=$master_id;
        if (Yii::$app->request->isAjax) {
            
            if ($model->load(Yii::$app->request->post())) {
if ($master_id!=null) $model->user_id=$master_id;
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
                'master_id'=>$master_id,
            
        ]);
    }
    

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
public function actionCreate($master_id)     
    {
        $model = new AuthAssignment();
if ($master_id!=null) $model->user_id=$master_id;

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
if ($master_id!=null) $model->user_id=$master_id;            if ($model->save()) {
                return $this->redirect(['index',
                'master_id'=>$master_id,                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
                'master_id'=>$master_id,            
        ]);
    }
public function actionCreate2($master_id)    
    {
        $model = new AuthAssignment();
if ($master_id!=null) $model->user_id=$master_id;
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
if ($master_id!=null) $model->user_id=$master_id;
            if ($model->save()) {
            
                return $this->redirect(['index-listview',
                'master_id'=>$master_id,    
                ]);
             }
        }

        return $this->render('create', [
            'model' => $model,
                'master_id'=>$master_id,    
        ]);
    }
    
    
    
    

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) ) {
                        if ($model->save()){
                //return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                return $this->redirect(['index',
                            'master_id'=>$model->user_id,                ]);
            };
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_name, $user_id)
    {
        $model=$this->findModel($item_name, $user_id);
        $model->delete();

        return $this->redirect(['index',
                'master_id'=>$model->user_id,    
        ]);
    }
    
    
    public function actionUpdate2($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) ) {
                        
            if ($model->save()){
                //return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
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

    
    public function actionDelete2($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return "deleted";
    }
    
    public function actionDeleteAjax($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

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
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
//