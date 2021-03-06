<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;


?>

<?


if ($filter_where == "") {


    echo "<div class='col-sm-12'>";

    echo $this->render("_active_form_dashboard", [
        'model' => $model,
        'column' => $column,
        'use_column' => $use_column,
        'mode' => $mode,
        'builder' => $builder,
        'folder' => $folder,
        'report' => $report,
        'filter_advance' => $filter_advance,
        'report_name' => $report_name,
        'ajax_mode' => $ajax_mode,
        'can_build' => $can_build,
        'can_update' => $can_update,
        'dashboard_name' => $dashboard_name,
    ]);
    echo '</div>';
}

if (!$new_flag) {
    //$url_b='https://icloud.icode.id/index.php?r=report-generator/get-data-report3'. '&folder='.$folder. '&report_name=' . $report_name;
    $url_b = $realtime_url . '&folder=' . $folder . '&report_name=' . $report_name;
    if ($dashboard_name == "") $dashboard_name = "_dashboard_chart2a";
    echo $this->render($dashboard_name, [
        'url' => Url::to(['//report-generator/get-data-report3', 'folder' => $folder, 'report_name' => $report_name]),
        'url_b' => $url_b,
        'url2' => Url::to(['//report-generator/get-data-report4', 'folder' => $folder, 'limit' => $limit]),
        'timeout' => $timeout,
        'report' => $report,
        'folder' => $folder,
        'andWhere' => $andWhere,
        'andWhere_df' => $andWhere_df,
        'filter_where' => $filter_where,
        'filter_where_df' => $filter_where_df,
        'limit' => $limit,
        'builder' => $builder, 'report_name' => $report_name,
        'dashboard_option' => $dashboard_option,
        'dashboard_backgrond' => $dashboard_backgrond


    ]);
} else {
    echo "please choose a filter!";
};



$this->registerCss('.paddingb {padding-bottom: 10px;padding-top: 10px;padding-right: 10px;padding-left: 10px;}');
$this->registerCss('.paddingb2 {padding-right: 5px;padding-left: 5px;}');


?>



<? Modal::begin([
    'options' => [
        'id' => 'ReportGeneratormyModal',
        'tabindex' => false
    ],
    'header' => 'Modal',
    'id' => 'ReportGeneratormyModal',
    'size' => 'modal-md',
]);
echo "<div id='ReportGeneratormodalContent'></div>";
Modal::end();



$js = <<<js
    
    $('.ReportGeneratormodalButton').on('click', function () {
        console.log( 'ReportGeneratormodalButton.click' );
        $('#ReportGeneratormyModal').modal('show')
                .find('#ReportGeneratormodalContent')
                .load($(this).attr('value'));
    });
    $('.ReportGeneratormodalButton2').on('click', function () {
        console.log( 'ReportGeneratormodalButton2.click' );
        window.location.replace($(this).attr('value'));
        
    });    
    $('.ReportGeneratorajaxButton').on('click', function () {
        console.log( 'ajaxButton.click' );
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        var data = $(this).serializeArray();
        var url = $(this).attr('value');
        console.log( url );
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert('deleted');
                
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $("#ReportGeneratormyModal").on('hide.bs.modal', function(){
        console.log( 'ReportGeneratormodalButton.close' );
        try {        
            console.log('model.close' );
            $('#ReportGeneratormodalContent').empty();
            
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
 
js;

if ($builder == 1) {
    $js = "$.noConflict();" . $js;
}
$this->registerJs($js);
if ($builder == 1) {
    $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js', ['position' => View::POS_HEAD]);
    $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js', ['position' => View::POS_HEAD]);
}
//Pjax::end(); 
?>

</div>