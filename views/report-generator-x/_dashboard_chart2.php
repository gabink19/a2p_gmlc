<?php

use app\helpers\GoogleChart2;
use app\helpers\CustModule;
use yii\helpers\Html;
use yii\helpers\Url;?>
<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@0.6.4/dist/gridstack.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gridstack@0.6.4/dist/gridstack.all.js"></script>
-->
<div class="report-generator-form2">
 <div class='col-md-12'>
    <!--  <div class="grid-stack">-->
  
 <?        
    $idx=0;
    if ($report!=null){
        $x=0;$y=0;
        $max_size=0;
        foreach ($report as $rep){
            $size=$rep['size'];
            $size2=$rep['size2'];
            if ($size2==0){
                $size2=$size;
            }
            if (($x+$size)>12) {
                $x=0;
                $y=$y+$max_size;
                $max_size=0;
            };
            if ($max_size<$size) $max_size=$size;
            
//            echo '<div class="grid-stack-item" data-gs-x="'.$x.'" data-gs-y="'.$y.'" data-gs-width="'.$size.'" data-gs-height="'.$size.'">
//  ';
              //echo '<div class="grid-stack-item" data-gs-width="'.$size.'" data-gs-height="'.$size2.'" data-gs-auto-position>
//  ';
            $x=$x+$size;
            //echo '<div class="grid-stack-item-content">';
            
                echo "<div class='col-sm-".$rep['size']." paddingb'>";
            
            if ($builder==1){
                echo Html::button("<span class='glyphicon glyphicon-wrench'></span>", [
                                            'value' => Url::to(['//report-generator-builder-x/edit-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                            'style' => 'background:none;border:none;padding:5px;color:black',
                                            'class' => 'ReportGeneratormodalButton grid-action',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'bottom',
                                            'title' => 'Edit Report'
                                ]);
                echo Html::button("<span class='glyphicon glyphicon-remove'></span>", [
                                            'value' => Url::to(['//report-generator-builder-x/remove-report', 'folder' => $folder, 'report_name' => $report_name,"idx"=>$idx]),
                                            'style' => 'background:none;border:none;padding:5px;color:red',
                                            'class' => 'ReportGeneratormodalButton grid-action',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'bottom',
                                            'title' => 'Remove Report'
                                ]);
            }
            $rep['options']['title']=$rep['name'];
            
            $report_icons=$rep['report_icons'];
            if ($report_icons!="") {
                $rep['options']['icons']=Yii::$app->params['report_icons'][$report_icons];
            }
            if ($rep['report_type']==1) {
                echo CustModule::widget([
                    'visualization' => $rep['visualization'],
                    'selection_flag'=> $rep['selection_flag'],
                    'report'=>$report,
                    'idx'=>$idx,
                    'folder'=>$folder,
                    'options' => $rep['options']
                    ]);
            } else {
                echo GoogleChart2::widget([
                    //'visualization' => 'LineChart',
                    'visualization' => $rep['visualization'],
                    'selection_flag'=> $rep['selection_flag'],
                    'packages' => $rep['packages'], //default is corechart
                    //'packages' => 'table', //default is corechart

                    'loadVersion' => 1, //default is 1.  As for Calendar, you need change to 1.1
                    //'data' => $b,
                    'url' => $url,
                    'url2' => $url2,

                    'timeout'=>$timeout,
                    'report'=>$report,
                    'andWhere'=>$andWhere,
                    'filter2'=>$filter2,
                    'limit'=>$limit,

                    'idx'=>$idx,
                    'folder'=>$folder,

                    'options' => $rep['options']
                    ]);
            }


            echo "</div>";
            //echo "</div>";
            //echo "</div>";

            $idx++;


        }
    }
    
                

?>
       <!--   </div>-->

</div>
</div>
<!--
<script type="text/javascript">
  $('.grid-stack').gridstack();
</script>
-->

        