<?php


use yii\helpers\Html;
use yii\helpers\Url;?>

<div class="report-generator-form2">
   <? 
    if ($mode==2){  
    } else {
        echo "<div class='col-md-12'>";
    }
  
        
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
                    echo $this->render('_dashboard_chart3', [
                        'url' => $url,
                        'url_b' => $url_b,
                        'url2' => $url2,
                        'timeout' => $timeout,
                        'report' => $report,
                        'folder' =>$folder,
                        'andWhere'=>$andWhere,
                        'andWhere_df'=>$andWhere_df,
                        'filter_where'=>$filter_where,
                        'filter_where_df'=>$filter_where_df,
                        'limit'=>$limit,
                        'builder'=>$builder,
                        'report_name' => $report_name,
                        "rep"=>$rep,
                        "idx"=>$idx,
                        "page_mode"=>$page_mode,
                        'report_db_id'=>$report_db_id


                    ]);
                


                echo "</div>";
                $idx++;
            }
            //echo "</div>";
            //echo "</div>";

            


        
    }
    if ($mode==2){  
    } else {
        echo "</div>" ; 
    }

?>
      


</div>

        