<?php

use app\helpers\GoogleChart2;
use app\helpers\CustModule;
use yii\helpers\Html;
use yii\helpers\Url;?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@1.1.1/dist/gridstack.min.css" />
<script src="https://cdn.jsdelivr.net/npm/gridstack@1.1.1/dist/gridstack.all.js"></script>

<div class="report-generator-form2">

<div class='col-md-12'>
    

<div class="grid-stack">
<img src="<?=$dashboard_backgrond?>" alt="Sensor cuaca" height="auto" width="100%" style="position: absolute;left:0px;top:0px">
  
 <?        
    $idx=0;
    if ($report!=null){
        $x=0;$y=0;
        $max_size=0;
        foreach ($report as $rep){
            
                $size=$rep['size'];
                $size2=$rep['size2'];
                $x=$rep['position_x'];
                $y=$rep['position_y'];
                
                if ($size2==0){
                    $size2=$size;
                }
           
               echo '<div id="'.$idx.'" class="grid-stack-item" data-gs-x="'.$x.'" data-gs-y="'.$y.'" data-gs-width="'.$size.'" data-gs-height="'.$size2.'">';
               echo '<div  class="grid-stack-item" data-gs-width="'.$size.'" data-gs-height="'.$size2.'" data-gs-auto-position>';
              //  $x=$x+$size;
                echo '<div class="grid-stack-item-content">';

                    
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
                echo "</div>";
            echo "</div>";
            }
            

            


        
    }
    
                

?>
       <!--   </div>-->

</div>
</div>
    
</div>


<script type="text/javascript">
  //$('.grid-stack').gridstack();
  var grid = GridStack.init(<?=($dashboard_option==null?"":json_encode($dashboard_option)) ?>);
  function GridSavePage(url){
            serializedData = [];
            grid.engine.nodes.forEach(function(node) {
              serializedData.push({
                id : node.el.id,
                x: node.x,
                y: node.y,
                width: node.width,
                height: node.height
              });
            });
            //alert("ReportGeneratormodalButtonSavePage::"+JSON.stringify(serializedData, null, '  '));
            
            //alert("ReportGeneratormodalButtonSavePage:"+url+" "+JSON.stringify(serializedData, null, '  '));
            
            console.log( url );
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {data:serializedData},

            })
            .done(function(response) {
                if (response.data.success == true) {
                    console.log( response );
                    alert('save');
                    
                }

            })
            .fail(function() {
                alert("fail");

            });
        
       
  }
  
</script>


        