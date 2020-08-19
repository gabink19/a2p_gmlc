<?php
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>
<?php Pjax::begin(['id' => $idFrame,'enablePushState' => false]); ?>

  <?php 

$form = ActiveForm::begin([
    'id'=>$formName,
    // 'type' => ActiveForm::TYPE_INLINE,
    'layout' => 'horizontal',
    'class'=>'form-horizontal',
    // 'enableAjaxValidation' =>true,
    'action' => [$action,'id'=>$id,'idKirim'=>$idKirim,'idFrame'=>$idFrame],
    // 'action' => ['plugins/tx-transaksi-detail/add','id'=>$id,'idKirim'=>$idKirim,'mode'=>$mode,'idFrame'=>$idFrame],
    'options' => ['enctype' => 'multipart/form-data','data-pjax' => true ], 
    // 'enableClientValidation'=>false,
    // 'validationUrl'=>Url::toRoute('campaign-broadcast/validation'),
]); 
?>
  <div class="row">
    <div class="col-md-3">
      <?php echo $form->field($model, 'g_services_gs_id')
          ->dropDownList(
              $dataServices,
              [
              'readonly'=>'true',
              ]           
          );
      ?>
    </div>
    <div class="col-md-4">
      <?= $form->field($model,'g_tenaga_medis_gtm_id')->widget(kartik\select2\Select2::classname(), [
                            'hideSearch' => false,
                            'data' => ArrayHelper::map(app\models\GTenagaMedis::find()->all(), 'gtm_id', 'gtm_name'),
                            'options' => ['placeholder' => 'select','id'=>rand(1000,9999).'g_tenaga_medis_gtm_id'.rand(1000,9999)],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]
                        
                        )
      ?>
   </div>
    <div class="col-md-4">    
      <?= $form->field($model, 'ttd_name')->textInput(['maxlength' => true]) ?>
    </div>
    <!-- <div class="col-md-4">
      <?= $form->field($model,'ttd_notes')->textarea(['rows' => 2])?>
    </div> -->
    
    <div style="display: none;">
      <?= $form->field($model, 'id')->textInput(['value' => $idKirim]) ?>
      <?= $form->field($model, 'idFrame')->textInput(['value' => $idFrame]) ?>
    </div>
  </div>
<!-- <div class="form-group"> -->
<div>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        
    
<?php ActiveForm::end(); ?>
<?php 
          if($id == ''){

          
        ?>
        <?= Html::button('Cancel', ['class' => 'btn btn-warning','onclick'=>"remove('$idFrame',2)"]) ?>
        <?php
          }
          else{

          
        ?>
        <?= Html::a('Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
        ]) ?>
        <?php
         }
        ?>
</div>        

<?php Pjax::end(); ?>
