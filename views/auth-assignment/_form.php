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

<div class="auth-assignment-view">

        
<?$attributes=[];
$attributes[]=['attribute' =>'item_name', 
                        

                        'format'=>'raw','displayOnly'=>$displayOnlyFlag,
                        
                        'type' => DetailView::INPUT_SELECT2, 'value' => Html::a($model->itemName->name, ['auth-item/view', 'id' => $model->item_name]),
                          'widgetOptions' => [
                            'hideSearch' => false,
                            'theme' => kartik\select2\Select2::THEME_BOOTSTRAP, 
                            'data' => ArrayHelper::map(app\models\AuthItem::find()->where(['type' => 2])->all(), 'name', 'name'),
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
            'heading' => $this->title.' # ' . $model->item_name,
            'type' => DetailView::TYPE_INFO,
            'footer' => '<div class="text-center text-muted">create by:'.$model->first_user."/".$model->first_ip."/".$model->first_update.'<br>update by:'. 
                $model->last_user."/".$model->last_ip."/".$model->last_update.'</div>'
    
                ],
            'deleteOptions' => [// your ajax delete parameters
            'url' => ['delete', 'id' => $model->item_name],
                ],
        
            'attributes' => $attributes]) ?>

</div>
<?$js=<<<js
        
js;
$this->registerJs($js, yii\web\View::POS_READY);

?>
