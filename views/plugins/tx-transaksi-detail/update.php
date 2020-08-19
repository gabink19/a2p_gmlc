<div class="ttransaksi-detail-create">
<?= $this->render('_form', [
        'model' => $model,
        'dataServices'=>$dataServices,
        'formName'=>$formName,
        'idFrame'=>$idFrame,
        'idKirim'=>$idKirim,
        'id'=>$id,
        'action'=>$action,
    ]) ?>
</div>