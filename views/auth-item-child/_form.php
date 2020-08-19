<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
if ($mode==="view"){
    $displayOnlyFlag=true;
} else {
    $displayOnlyFlag=false;
}


?>

<div class="auth-item-child-view">

        
<?$attributes=[];
$attributes[]=['attribute' =>'child', 
                        

                        'format'=>'raw','displayOnly'=>$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a($model->child0->showName, ['auth-item/view', 'id' => $model->child]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\models\AuthItem::find()->all(), 'name', 'showName'),
                            'options' => ['placeholder' => 'select',],
                            
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        ];
?>
    
    
<?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'bordered'=>false,
        'hover' => true,
        'mode' => $mode,
        'buttons1' => $button1,
        'buttons2' => $button2,
        'container' => ['id'=>'kv-demo'],
                'panel' => [
            'heading' => $this->title.' # ' . $model->parent,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div class="text-center text-muted">create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                $model->last_user."/".$model->last_ip."/".$model->last_update.'</div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->parent],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
