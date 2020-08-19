

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'Report Generator X';
$this->params['breadcrumbs'][] = $this->title;

?>
    
    <?echo "<div class='col-sm-12'>";
    
                    echo $this->render("_active_form", [
                        'model' => $model,
                
                    ]);
                    echo $this->render('_dashboard_chart2', [
                    'url'=>Url::to(['//report-generator/get-data-report3', 'folder' => 'report1.json']),
                    'timeout'=>60000,
                     'report'=>$report
       
                    ]);
                    echo '</div>';
                    ?>
        
    
    



 