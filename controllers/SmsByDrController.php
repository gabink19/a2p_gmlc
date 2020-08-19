<?php

namespace app\controllers;

use Yii;
use app\models\SmsByDr;
use app\models\SmsByDrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * SmsByDrController implements the CRUD actions for SmsByDr model.
 */
class SmsByDrController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SmsByDr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SmsByDrSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $array = [];
        foreach ($dataProvider->query->all() as $key => $value) {
            $date = date('Ymd',strtotime($value['date']));
            $q = "SELECT count(*) as `exist`  FROM INFORMATION_SCHEMA.TABLES 
                 WHERE TABLE_SCHEMA = 'ActionLogicA2pGmlc' 
                 AND  TABLE_NAME = 'tbl_message_history_".$date."'";
            $table_exist = Yii::$app->db->createCommand($q)->queryScalar();
            if ($table_exist) {
                $query = "SELECT count(1) as total,last_result FROM ActionLogicA2pGmlc.tbl_message_history_".$date." WHERE msg_id='".$value->msg_id."'  AND msg_type = '2'";
                $comm = Yii::$app->db->createCommand($query)->queryOne();
                if ($comm['total']>0) {
                	$error_code = json_decode($comm['last_result'],1);
		            $newkey = $value['date'].$value->shortcode.$value->aph_id.$error_code['state'];
		            $array[$newkey]['date']=$value['date'];
		            $array[$newkey]['shortcode']=$value->shortcode;
		            $array[$newkey]['aph_id']=$value->aph_id;
		            $array[$newkey]['error_code']=$error_code['state'];
                    $array[$newkey]['total']+=1;
                }
            }
        }
        $new_array=[];
        foreach ($array as  $value) {
            if ($value['total']>0) {
                $new_array[]=$value;
            }
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $new_array,
            'sort' => [
                'attributes' => ['date','shortcode','aph_id','total','error_code'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        // echo "<pre>"; print_r($dataProvider);echo "</pre>";die();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SmsByDr model.
     * @param integer $id
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
     * Creates a new SmsByDr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SmsByDr();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SmsByDr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SmsByDr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SmsByDr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SmsByDr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SmsByDr::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
