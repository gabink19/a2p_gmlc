<?php

namespace app\controllers;

use Yii;
use app\models\AuthRule;
use yii\filters\AccessControl;

use app\models\AuthRuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthRuleController implements the CRUD actions for AuthRule model.
 */
class AuthRuleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
        
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','view','detail'],
                'rules' => [
                [
                'allow' => true,
                'actions' => ['index'],
                'roles' => [static::class.'.index'],
                ],
                [
                'allow' => true,
                'actions' => ['create'],
                'roles' => [static::class.'.create'],
                ],
                [
                'allow' => true,
                'actions' => ['update'],
                'roles' => [static::class.'.update'],
                ],
                [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => [static::class.'.delete'],
                ],
                [
                'allow' => true,
                'actions' => ['view'],
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
     * Lists all AuthRule models.
     * @return mixed
     */
public function actionIndex()    {
        $searchModel = new AuthRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
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
        $searchModel = new AuthRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
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
        $searchModel = new AuthRuleSearch();
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
        $searchModel = new AuthRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
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
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $model = new AuthRule();

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
    
            
        ]);
    }
    

    /**
     * Displays a single AuthRule model.
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
     * Creates a new AuthRule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
public function actionCreate()     
    {
        $model = new AuthRule();


        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->name]);
            if ($model->save()) {
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
        $model = new AuthRule();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->name]);

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
     * Updates an existing AuthRule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->name]);
            return $this->redirect(['index',
                        ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing AuthRule model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->name]);
            return $this->renderAjax('view', [
                'model' => $model,
                'remove_title'=> 1,
                'update_action'=>'update2',
                'delete_action'=>'delete2',
             
                
            ]);    
        
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
     * Finds the AuthRule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthRule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthRule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
