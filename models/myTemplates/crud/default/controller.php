<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
try {
    
    $className= StringHelper::basename($generator->modelClass);
    include(dirname(__FILE__) .    "/../../../models/".$className."_Config.php");
    $obj_name=$className."_config";
    $$obj_name=$obj_name();  
    $master_id=$$obj_name['master_id'];
    $parameter_var=$$obj_name['parameter'];
    $option_flag=$$obj_name['option_flag'];
    $lebel_api=$$obj_name['dataLabel'];
    $API_flag=$$obj_name['API_flag'];
    // $insert_file=$$obj_name[''];

    $split_array = explode(",", $parameter_var);
    $no=0;
    $parameter="";
    $parameter_command="";
    
    $parameter_command2="";
    $parameter_command3="";
    if ($parameter_var!="" and count($split_array)>0) {
        foreach ($split_array as $split_str) {
            if ($no==0) {
                $param="";
            } else {
                $param=",";
            }
            $parameter=$parameter.$param.'$'.$split_str;
            $parameter_command=$parameter_command.$param."'".$split_str."'=>$".$split_str;
            $parameter_command2=$parameter_command2.'$GLOBALS[\''.$split_str.'\']=$'.$split_str.';';
            $parameter_command3=$parameter_command3.$param.'\''.$split_str.'\'=>$GLOBALS[\''.$split_str.'\']';


            $no++;

        }
    }
   
    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../../models/".$className."_Config.php".".\n";
}


    
$table_name=str_replace("'",'',str_replace(' ','_',strtolower($generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))))));


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
use yii\filters\AccessControl;

<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
<?for ($i = 0; $i < 3; $i++) {
        if ($i == 0) {
            $file_no = "";
        } else {
            $file_no = "_" . ($i + 1);
        }
        $import_file = $$obj_name['index' . $file_no];
        if($import_file['import']['field_import']!=null){$import_file_flaguse=1; break;}}?>
<?=($import_file_flaguse==1?"use yii\web\UploadedFile;\n":"\n")?>
/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?=$generator->generateInheritance? "Xx":""?><?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
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
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
     
<? if ($master_id=='') {
        echo "public function actionIndex(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionIndex(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
    {
    
        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['<?=$searchModelClass?>'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['<?=$searchModelClass?>'];
                if ($Search_params!=null){        
                    $params['<?=$searchModelClass?>']=$Search_params;
                }
            } else {
               Yii::$app->session['<?=$searchModelClass?>']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['<?=$searchModelClass?>_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['<?=$searchModelClass?>_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['<?=$searchModelClass?>_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['<?=$searchModelClass?>_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['<?=$searchModelClass?>'];
            if ($Search_params!=null){        
               $params['<?=$searchModelClass?>']=$Search_params;
            }
            $page_params=Yii::$app->session['<?=$searchModelClass?>_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['<?=$searchModelClass?>_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        <?
        if ($filter!="") {
            $split_array = explode("#", $filter);
            echo "\$temp_master_id= ".$split_array[0].";
                if (\$temp_master_id!=null){
                    \$searchModel->".$split_array[1]."=".$split_array[0].";

                }";
        
        }?>
        
        $dataProvider = $searchModel->search($params
    <?
    if ($master_id=='') {
        echo ");";
    } else {
        echo ",\$master_id);";
    }
    ?>
        $command="render";
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
            <?=(strstr( $option_flag, 'use_active_form' )?"'remove_create1'=>1,":"'remove_create2'=>1,")?>
            
            <?=($parameter_command==""?"":$parameter_command.",")?>
            
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
        
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('index', [
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'app_mode'=>$app_mode,

            'remove_create2'=>1,
            <?=($parameter_command==""?"":$parameter_command.",")?>
            
            
        ]);
<?php endif; ?>
    }
    
<? if ($master_id=='') {
        echo "public function actionIndexAjax(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionIndexAjax(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
    
    {

        $params = Yii::$app->request->queryParams;
        if (count($params) >0) {
            $Search_params = $params['<?=$searchModelClass?>'];
            if ($Search_params==null) {
                $Search_params=Yii::$app->session['<?=$searchModelClass?>'];
                if ($Search_params!=null){        
                    $params['<?=$searchModelClass?>']=$Search_params;
                }
            } else {
               Yii::$app->session['<?=$searchModelClass?>']=$Search_params;
               
            };
            
            $page_params = $params['page'];
            if ($page_params==null) {
                $page_params=Yii::$app->session['<?=$searchModelClass?>_page'];
                if ($page_params!=null){        
                    $_GET['page']=$page_params;
                }
                
            } else {
               Yii::$app->session['<?=$searchModelClass?>_page']=$page_params;
               
               
            }
            
            $sort_params = $params['sort'];
            if ($sort_params==null) {
                $sort_params=Yii::$app->session['<?=$searchModelClass?>_sort'];
                if ($sort_params!=null){
                    $_GET['sort']=$sort_params;
                }
                
            } else {
               Yii::$app->session['<?=$searchModelClass?>_sort']=$sort_params;
            }
            
        } else {
            $Search_params=Yii::$app->session['<?=$searchModelClass?>'];
            if ($Search_params!=null){        
               $params['<?=$searchModelClass?>']=$Search_params;
            }
            $page_params=Yii::$app->session['<?=$searchModelClass?>_page'];
            if ($page_params!=null){        
                $_GET['page']=$page_params;
            }
            $sort_params=Yii::$app->session['<?=$searchModelClass?>_sort'];
            if ($sort_params!=null){
                $_GET['sort']=$sort_params;
            }
            
        }
    
        <?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        <?
        if ($filter!="") {
            $split_array = explode("#", $filter);
            echo "\$temp_master_id= ".$split_array[0].";
                if (\$temp_master_id!=null){
                    \$searchModel->".$split_array[1]."=".$split_array[0].";

                }";
        
        }?>
        
        
        
        $dataProvider = $searchModel->search($params
    <?
    if ($master_id=='') {
        echo ");";
    } else {
        echo ",\$master_id);";
    }
    ?>

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
            <?=($parameter_command==""?"":$parameter_command.",")?>
            <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
    
            
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
            
        ]);
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('index', [
            'dataProvider' => $dataProvider,
            'modal_mode'=>1,
            'pjax_enable' => 1,
            'remove_create2'=>1,
            'app_mode'=>$app_mode,

            <?=($parameter_command==""?"":$parameter_command.",")?>
            
        ]);
<?php endif; ?>
    }
<? if ($master_id=='') {
        echo "public function actionIndexListview(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionIndexListview(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
    
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        <?
        if ($filter!="") {
            $split_array = explode("#", $filter);
            echo "\$temp_master_id= ".$split_array[0].";
                if (\$temp_master_id!=null){
                    \$searchModel->".$split_array[1]."=".$split_array[0].";

                }";
        
        }?>
        
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
        <?
    if ($master_id=='') {
        echo ");";
    } else {
        echo ",\$master_id);";
    }
    ?>
        $command="render";
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

            <?=($parameter_command==""?"":$parameter_command.",")?>
            <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
            
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('index_listview', [
            'dataProvider' => $dataProvider,
            'pjax_enable' => 0,
            'remove_create1'=>1,
            'app_mode'=>$app_mode,

            <?=($parameter_command==""?"":$parameter_command.",")?>
            
            
        ]);
<?php endif; ?>
    }
    <? if ($master_id=='') {
        echo "public function actionIndexListview2(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionIndexListview2(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>

    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        <?
        if ($filter!="") {
            $split_array = explode("#", $filter);
            echo "\$temp_master_id= ".$split_array[0].";
                if (\$temp_master_id!=null){
                    \$searchModel->".$split_array[1]."=".$split_array[0].";

                }";
        
        }?>
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams
    <?
    if ($master_id=='') {
        echo ");";
    } else {
        echo ",\$master_id);";
    }
    ?>
        $command="render";
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
            <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
            
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);
         $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }

        return $this->$command('index_listview', [
            'dataProvider' => $dataProvider,
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'pjax_enable2' => 0,
            'update_action'=>'update-ajax',
            'delete_action'=>'delete-ajax',
            'remove_update'=>2,
            'remove_delete'=>2,
            'remove_create2'=>1,
            'app_mode'=>$app_mode,

            <?=($parameter_command==""?"":$parameter_command.",")?>
            
        ]);
<?php endif; ?>
    }
    
    //mode 3 
    public function actionViewOnly($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel(<?= $actionParams ?>),
            'pjax_enable' => 1,
            'view_form'=>'_form',
            'remove_title'=> 1,
            'remove_delete'=>1,
            'remove_update'=>1,
            <?=($parameter_command==""?"":$parameter_command.",")?>
                    
        ]);
    }
    
    
    public function actionUpdateAjax($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);


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
            'model' => $this->findModel(<?= $actionParams ?>),
            'pjax_enable' => 0,
            'view_form'=>'_active_form',
            'remove_title'=> 1,
            'remove_update'=>1,
            'remove_delete'=>1,
            'view_form2'=>'update-ajax',
            'modal_class'=>'comment-form',
            'remove_detail'=>1,
            <?=($parameter_command==""?"":$parameter_command.",")?>
            
    
                
        ]);
    }
    
<? if ($master_id=='') {
        echo "public function actionCreateAjax(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionCreateAjax(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
   {
        $model = new <?= $modelClass ?>();
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    
    
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

        if (Yii::$app->request->isAjax) {
            
            if ($model->load(Yii::$app->request->post())) {
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

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
            <?=($parameter_command==""?"":$parameter_command.",")?>
            
    <?
            if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>

            
        ]);
    }
    

    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
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
            'model' => $this->findModel(<?= $actionParams ?>),
            'app_mode'=>$app_mode,
            'update_flag'=>$update_flag,
            'delete_flag'=>$delete_flag,
        
            <?=($parameter_command==""?"":$parameter_command.",")?>
        ]);
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
<? if ($master_id=='') {
        echo "public function actionCreate(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionCreate(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
     
    {
        $model = new <?= $modelClass ?>();
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>


        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', <?= $urlParams ?>]);
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>
            if ($model->save()) {
                return $this->redirect(['index',
                    'app_mode'=>$app_mode,
                    <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
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

            <?=(strstr( $option_flag, 'use_active_form' )?"'view_form'=>'_active_form','view_form2'=>'create',":"")?>
            
            <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
            
        ]);
    }
<? if ($master_id=='') {
        echo "public function actionCreate2(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionCreate2(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
    
    {
        $model = new <?= $modelClass ?>();
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', <?= $urlParams ?>]);
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

            if ($model->save()) {
            
                return $this->redirect(['index-listview',
                        'app_mode'=>$app_mode,
                        <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
    
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

            <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>
    
        ]);
    }
    
    
    
    

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        if ($model->load(Yii::$app->request->post()) ) {
            <?
            if ($filter!="") {
                $split_array = explode("#", $filter);
                echo "\$temp_master_id= ".$split_array[0].";
                    if (\$temp_master_id!=null){
                        \$model->".$split_array[1]."=".$split_array[0].";

                    }";

            }?>
            if ($model->save()){
                //return $this->redirect(['view', <?= $urlParams ?>]);
                return $this->redirect(['index',
                    'app_mode'=>$app_mode,
                    <?=($parameter_command==""?"":$parameter_command.",")?>
                <?
        if ($master_id=='') {

        } else {
            echo "            'master_id'=>\$model->".$master_id.",";
        }
        ?>
                ]);
            };
        }
        $command="render";
        if ($app_mode==1) {
         $this->layout='main_mobile';
            $command="render";
        }
        
        return $this->$command('update', [
            'model' => $model,
            'app_mode'=>$app_mode,

            <?=(strstr( $option_flag, 'use_active_form' )?"'view_form'=>'_active_form','view_form2'=>'update',":"")?>
            
            <?=($parameter_command==""?"":$parameter_command.",")?>
        ]);
    }
    
    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $model=$this->findModel(<?= $actionParams ?>);
        if($model->delete()){
            Yii::$app->session->setFlash('success', 'Success delete ');
        } else {
            Yii::$app->session->setFlash('error', 'Fail delete ');
        }

        return $this->redirect(['index',
        <?=($parameter_command==""?"":$parameter_command.",")?>
    <?
    if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$model->".$master_id.",";
    }
    ?>
    'app_mode'=>$app_mode
        ]);
    }
    
    
    public function actionUpdate2($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        if ($model->load(Yii::$app->request->post()) ) {
            <?
            if ($filter!="") {
                $split_array = explode("#", $filter);
                echo "\$temp_master_id= ".$split_array[0].";
                    if (\$temp_master_id!=null){
                        \$model->".$split_array[1]."=".$split_array[0].";

                    }";

            }?>
            
            if ($model->save()){
                //return $this->redirect(['view', <?= $urlParams ?>]);
                return $this->renderAjax('view', [
                    'model' => $model,
                    'remove_title'=> 1,
                    'update_action'=>'update2',
                    'delete_action'=>'delete2',
                    'app_mode'=>$app_mode,

                    <?=($parameter_command==""?"":$parameter_command.",")?>


                ]);
            };
        
        }
        return $this->renderAjax('_active_form', [
                'model' => $model,
                <?=($parameter_command==""?"":$parameter_command.",")?>
        ]);
        
    }

    
    public function actionDelete2($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $this->findModel(<?= $actionParams ?>)->delete();
        return $this->renderAjax('_delete');
        //return "deleted";
    }
    
    public function actionDeleteAjax($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $this->findModel(<?= $actionParams ?>)->delete();

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
    <?if ($API_flag==1):?>
    <?if ($master_id=='') {
        echo "public function actionApiIndex(".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionApiIndex(\$master_id".($parameter==""?"":",".$parameter).")";
    }?>
    {
        
        $data =<?=$modelClass?>::find()<?=($master_id!=''?'->where(["'.$master_id.'"=>$master_id])':'')?>->all();

        <? 
        foreach ($lebel_api as $key=>$val) {
        if ($val['API_Display_Index']!=null || $val['API_Display_Index']!=0){
            $flag_api_index=1;
        break;
        }
    }
    if($flag_api_index==null){
        echo "foreach(\$data as \$dataArray){\n";
        foreach ($lebel_api as $key=>$val) {
            
            
                echo "\$model['".($val['name']!=''?$val['name']:$key)."']=\$dataArray->".$key.";\n";
        
        }
        echo"\$data2[]=\$model;"."\n";
            echo "\$model=null;"."\n";
            echo "}";
    }
    if($flag_api_index===1){
        echo "foreach(\$data as \$dataArray){\n";
        foreach ($lebel_api as $key=>$val) {
            
            if($val['API_Display_Index']!=null || $val['API_Display_Index']!=0){
                echo "\$model['".($val['name']!=''?$val['name']:$key)."']=\$dataArray->".$key.";\n";
            }
        }
        echo"\$data2[]=\$model;"."\n";
            echo "\$model=null;"."\n";
            echo "}";
    }?>

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(<?= ($flag_api_index=="1"?"\$data2":"\$data"); ?>!=null){
        return ['result'=>true,
                'data'=>$data2];
        } else {
            return ['result'=>false,
                    'data'=>null,]; 
        }
        

    }
    <?//modified?>
    public function actionApiView(<?= $actionParams ?>)
    {
        
        $data = $this->findModel(<?= $actionParams ?>);
        <? 
        foreach ($lebel_api as $key=>$val) {
        if ($val['API_Display_View']!=null || $val['API_Display_View']!=0){
            $flag_api_view=1;
        break;
        }
    }
    if($flag_api_view===1){
        
        foreach ($lebel_api as $key=>$val) {
            if($val['API_Display_View']!=null || $val['API_Display_View']!=0){
                echo "\$model['".($val['name']!=''?$val['name']:$key)."']=\$data->".$key.";\n";
            }
        }
        echo"\$data2[]=\$model;"."\n";
           
            
    }?>

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(<?= ($flag_api_index=="1"?"\$data2":"\$data"); ?>!=null){
        return ['result'=>true,
                'data'=><?= ($flag_api_view=="1"?"\$data2":"\$data"); ?>];
            } else {
            return ['result'=>false,
                    'data'=>null,]; 
        }

    }

    <? if ($master_id=='') {
        echo "public function actionApiCreate(\$app_mode=null".($parameter==""?"":",".$parameter).")";
    } else {
        echo "public function actionApiCreate(\$app_mode=null,\$master_id".($parameter==""?"":",".$parameter).")";
    }
?>
   {
        $model = new <?= $modelClass ?>();
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    
    
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
            
            if ($model->load(Yii::$app->request->post())) {
<? if ($master_id=='') {
    } else {
        echo "if (\$master_id!=null) \$model->".$master_id."=\$master_id;";
    }
    
    if ($filter!="") {
        $split_array = explode("#", $filter);
        echo "\$temp_master_id= ".$split_array[0].";
            if (\$temp_master_id!=null){
                \$model->".$split_array[1]."=".$split_array[0].";

            }";

    }
?>

                if ($model->save()) {
                    return [
                        'result' => [
                            'success' => true,
                            'message' => 'Model has been saved.',
                            'data' => $model, 
                        ]
                    ];
                } else {
                    return [
                        'result' => [
                            'success' => false,
                            'message' => 'Fail to save',
                            'data' => $model, 
                        ]
                    ];
                }
            }
        
        
        return [
            'result' => false,
    <?
            if ($master_id=='') {
        
    } else {
        echo "            'master_id'=>\$master_id,";
    }
    ?>

            
        ];
    }

    public function actionApiUpdate($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        
            
            if ($model->load(Yii::$app->request->post()) ) {

                if ($model->save()){
                    
                    return [
                        'result' => [
                            'success' => true,
                            'message' => 'Model has been update.',
                            'data' => $model,
                            
                        ],
                    ];
                } else {
                    return [
                        'result' => [
                            'success' => false,
                            'message' => 'Fail to update',
                            'data' => $model, 
                        ]
                    ];
                }
            }
        
        return  [
            'result' => false,
            'id'=><?= $actionParams ?>
    
                
        ];
    }

    public function actionApiDelete($app_mode=null,<?= $actionParams ?><?=($parameter==""?"":",".$parameter)?>)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($this->findModel(<?= $actionParams ?>)->delete()){
                return [
                    'result' => [
                        'success' => true,
                        'message' => 'Model has been deleted.',
                        'data' => $model,
                        
                    ],
                ];
        } else {
            return [
                    'result' => [
                        'success' => false,
                        'message' => 'Fail to delete.',
                        'data' => $model,
                        
                    ],
                ];
        }
    }
    <?endif;?>   
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

<?

    for ($i = 0; $i < 3; $i++) {
        if ($i == 0) {
            $file_no = "";
            $file_no_import = null;
        } else {
            $file_no = "_" . ($i + 1);
            $file_no_import = $i + 1;
        }
        $import_file = $$obj_name['index' . $file_no];
        if ($import_file['import']['field_import'] != null) {
            unset($simpanArray, $simpanField, $loop);
            $simpanArray .= "\$a[]=[";
            $simpanField .= "\$b=[";
            foreach ($import_file['import']['field_import'] as $key => $val) {
                $simpanArray .= "\$arr[" . $val . "],";
                $simpanField .= "'" . $key . "',";
            }
            $simpanArray = substr($simpanArray, 0, -1);
            $simpanField = substr($simpanField, 0, -1);
            $simpanArray .= ($$obj_name['master_id'] == '' ? '' : ',$master_id');
            $simpanArray .= "];";
            $simpanField .= ($$obj_name['master_id'] == '' ? '' : ",'" . $$obj_name['master_id'] . "'");
            $simpanField .= "];";
            if ($import_file['import']['bulk'] == null) {
                $loop = 1;
            } else {
                $loop = $import_file['import']['bulk'];
            }
            echo "public function actionInsertFile" . $file_no_import . "(" . ($$obj_name['master_id'] == '' ? '' : '$master_id=null') . "){
        \$model = new " .$modelClass. ";\n";
            if ($$obj_name['master_id'] != '') {
                echo "if (\$master_id==null){
                return \$this->redirect(['index']);
            } else{\n";
            }
            echo " if (Yii::\$app->request->isPost) {
        \$file = UploadedFile::getInstance(\$model, 'import_file" . $file_no_import . "');
    \$open_file =\$file->tempName;
    \$nama_file =\$file->name;
    \$file_ext = substr(\$nama_file, strripos(\$nama_file, '.'));


    if (\$file_ext=='." . $import_file['import']['extensions'] . "'){
    \$fp = fopen(\$open_file, 'r')or die('Unable to open file!');
    \$start =microtime(true);
    \$i=0;
    " . $simpanField . "
    while (!feof(\$fp)) {
        \$arr = explode('" . $import_file['import']['explode'] . "', fgets(\$fp));
        \n
    ";

            echo $simpanArray . "\n";
            echo "if(\$i >= " . $loop . "){
        \$i=0;
        Yii::\$app->db->createCommand()->batchInsert('" . $table_name . "',\$b,\$a)->execute();
    
    unset(\$a);
        
    }
    \$i++;
    }
    if(\$i > 0){
        \$i=0;
        Yii::\$app->db->createCommand()->batchInsert('" . $table_name . "',\$b,\$a)->execute();
    
        unset(\$a);
            
        }
        \$time = microtime(true) - \$start;
        Yii::\$app->session->setFlash('success','File '.\$nama_file.' success <br> Import Time: '.\$time.'s'); 
                unlink(\$open_file);
                return \$this->redirect(['index'," . ($$obj_name['master_id'] == '' ? '' : '$master_id=>$master_id') . "]);
                
            } 
        }else {return \$this->redirect(['index'," . ($$obj_name['master_id'] == '' ? '' : '$master_id=>$master_id') . "]);}
        }
    }
    \n";
}
}
   
   

   ?>
    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
    }
}
<?php
    $controller_name=str_replace("Controller","",$controllerClass);
    $length = strlen($controller_name);
    $url_name="";
    for ($i=0; $i<$length; $i++) {
        $char= $controller_name[$i];
        if (ctype_upper($char)) {
           if ($i==0) {
                $url_name=$url_name.$char; 
           } else {
                $url_name=$url_name.'-'.$char; 
                
                
               
           }
        } else {
           $url_name=$url_name.$char; 
        }
        
    }


    
    
    $url_name=strtolower($url_name);
    echo "//".$app_name;
    $result = Yii::$app->db->createCommand("CALL create_auth2('app\\\\\\\\controllers\\\\\\\\".$controllerClass."', 'app\\\\controllers\\\\".$controllerClass."',null,null,'".$app_name."','".$url_name."/');")
                ->execute();
    
    
    /*
    public function actionCreate2($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id)
    {
        $model = new TRekamMedisSoap();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->trms_id]);
            $model->save2($t_transaksi_tt_id,$f_rekam_medis_type_frmt_id);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/
            

?>