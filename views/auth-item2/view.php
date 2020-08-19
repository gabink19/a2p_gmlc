<?php
//gii_manual_update


use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Url; 
use yii\bootstrap\Modal; 
try {
    
    include(dirname(__FILE__) .    "/../../models/AuthItem2_Config.php");
    $obj_name="AuthItem2_config";
    $$obj_name=$obj_name();    

    
} catch (ErrorException $ex) {
    echo "\n//Unable to load configuration file ".dirname(__FILE__) .    "/../../models/AuthItem2_Config.php".".\n";
}


/* @var $this yii\web\View */
/* @var $model app\models\AuthItem2 */

$title=$AuthItem2_config['name'];
if ($title==null or $title=="") $title='Auth Item2';   

$this->title =  $title ;


?>

<? if ($remove_title==null) {
$this->params['breadcrumbs'][] = ['label' => "$title", 'url' => ['index']];    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
    $this->params['breadcrumbs'][] = 'View';
    \yii\web\YiiAsset::register($this);

}?>

<div class="auth-item2-view">
    <? 
    if ($pjax_enable) {
        Pjax::begin(['enablePushState' => false,'id'=>'id_pjax_'.$model->name]); 
    }
    ?>
       
    
    <p>
    <?        if ($update_action===null) $update_action='update';
        if ($delete_action===null) $delete_action='delete';
        
    ?>    
    <?if ($remove_update===null) {?>
        
        <?= Html::a('Update', ['auth-item2'."/".$update_action, 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
    <?} else if ($remove_update===2) {?>
        <a class="btn btn-info modalButton" value="<?= Url::to([$update_action, 'id' => $model->name]) ?>">Update</a>
    <?    }?>
    <?if ($remove_delete===null) {?>
        <?= Html::a('Delete', ['auth-item2'."/".$delete_action, 'id' => $model->name], ['class' => 'btn btn-danger','data-method'=>'post']) ?>
    <?} else if ($remove_delete===2) {?>
        <a class="btn btn-info ajaxButton" value="<?= Url::to([$delete_action, 'id' => $model->name]) ?>">Delete</a>
    <?    }?>
    </p>
    
    
    <? 
       if ($view_form==null) $view_form='_form';
       echo $this->render($view_form, [
        'model' => $model,
        'mode'=>'view',
        'button1'=>'',
        'button2'=>'{reset} {view} {save}',
        'view_form'=>$view_form2,
        'modal_class'=>$modal_class,
    ]) ?>
    
    <?    if ($pjax_enable) {
        Pjax::end(); 
    }
    ?>
   
    

</div>


    <?          $profile_id=$model->name;
                $searchModel = new app\models\AuthItem5Search();
                
                $params = Yii::$app->request->queryParams;
                if (count($params) >0) {
                    $Search_params = $params['AuthItem5Search'];
                    if ($Search_params==null) {
                        $Search_params=Yii::$app->session['AuthItem5Search'];
                        if ($Search_params!=null){        
                            $params['AuthItem5Search']=$Search_params;
                        }
                    } else {
                       Yii::$app->session['AuthItem5Search']=$Search_params;

                    };

                    $page_params = $params['page'];
                    if ($page_params==null) {
                        $page_params=Yii::$app->session['AuthItem5Search_page'];
                        if ($page_params!=null){        
                            $_GET['page']=$page_params;
                        }

                    } else {
                       Yii::$app->session['AuthItem5Search_page']=$page_params;


                    }

                    $sort_params = $params['sort'];
                    if ($sort_params==null) {
                        $sort_params=Yii::$app->session['AuthItem5Search_sort'];
                        if ($sort_params!=null){
                            $_GET['sort']=$sort_params;
                        }

                    } else {
                       Yii::$app->session['AuthItem5Search_sort']=$sort_params;
                    }

                } else {
                    $Search_params=Yii::$app->session['AuthItem5Search'];
                    if ($Search_params!=null){        
                       $params['AuthItem5Search']=$Search_params;
                    }
                    $page_params=Yii::$app->session['AuthItem5Search_page'];
                    if ($page_params!=null){        
                        $_GET['page']=$page_params;
                    }
                    $sort_params=Yii::$app->session['AuthItem5Search_sort'];
                    if ($sort_params!=null){
                        $_GET['sort']=$sort_params;
                    }

                }
        
                $dataProvider = $searchModel->search($params
                    ,$master_id);

                foreach($dataProvider->getModels() as $record) {
                    $record->profile_id=$profile_id;    
                  }

                echo $this->render('//auth-item5/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'modal_mode'=>1,
                    'pjax_enable' => 1,
                    'remove_title'=>1,
                    'remove_create2'=>1,
                    'remove_create1'=>1,
                    'master_id'=>$master_id, 
                    'profile_id'=>$profile_id,


                ]);
                
            
        
        
    
    ?>