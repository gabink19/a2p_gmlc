<?php

use app\helpers\GoogleChart2;
use app\helpers\CustModule;
use yii\helpers\Html;
use yii\helpers\Url;?>

<style>
    
.dragable_div {
  position: absolute;
  
  z-index: 10;
}


    
</style>
<div class="report-generator-form2">
    


<div class='col-md-12'>

<img src="<?=$dashboard_backgrond?>" alt="Sensor cuaca" height="auto" width="100%" style="position: absolute;left:0px;top:30px">  
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
                if ($builder == 1) {
                    $_y=str_replace("px","",$y);
                    $y=(intval($_y)-30)."px";
                    
                }
                $width=$rep['position_width'];
                $height=$rep['position_height'];
                if ($size2==0){
                    $size2=$size;
                }
                if ($x=="") {
                    $x="0px";
                }
                if ($y=="") {
                    $y="0px";
                }
           
                if ($width==0) {
                    if ($size==1) {
                       $width="8%"; 
                    } else if ($size==2) {
                       $width="16%";  
                    } else if ($size==3) {
                       $width="25%";  
                    } else if ($size==4) {
                       $width="33%";  
                    } else if ($size==5) {
                       $width="41%";  
                    } else if ($size==6) {
                       $width="50%";  
                    } else if ($size==12) {
                       $width="100%";  
                    }
                } else {
                    $width=$width."px";
                }
                if ($height==0) {
                    if ($size2==1) {
                       $height="100px"; 
                    } else if ($size2==2) {
                       $height="200px";  
                    } else if ($size2==3) {
                       $height="300px";  
                    } else if ($size2==4) {
                       $height="400px";  
                    } else if ($size2==5) {
                       $height="500px";  
                    } else if ($size2==6) {
                       $height="600px"; 
                    } else if ($size2==12) {
                       $height="1200px"; 
                    }
                } else {
                    $height=$height."px";
                }
                $height="100%";
               
              
                    echo '<div id="report_'.$idx.'" class="dragable_div" style="left: '.$x.';top: '.$y.';width: '.$width.';height: '.$height.';">';
                    
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
            

            


        
    }
    
                

?>
       <!--   </div>-->

</div>
</div>


<script type="text/javascript">
    <?
    
    $idx=0;
    foreach ($report as $rep){
       echo "dragElement(document.getElementById('report_".$idx."'));";
       $idx++; 
    }
    ?>
    
  function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    elmnt.onmousedown = dragMouseDown;
  

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

  
  function GridSavePage(url){
      serializedData = [];
      <?
        $idx=0;
        foreach ($report as $rep){
           echo "node=document.getElementById('report_".$idx."');";
           ?>
           y=node.style.top;
           _y=y.replace("px","");
           y=(parseInt(_y)+30)+"px";
           serializedData.push({
                id : <?=$idx?>,
                x: node.style.left,
                y: y
                
              });
           <?
           $idx++; 
        }
        ?>
                
            
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


        