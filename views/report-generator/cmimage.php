<?

use yii\helpers\Json;
?>
<div id="<?=$id?>_param0" style="position: relative;height: 70px">


<div  id="<?=$id?>_param" style="display:none;position: absolute;left:0px;top:0px"  class="cm_image_box">
   <img  id="<?=$id?>_param2"  alt="Sensor cuaca" height="auto" width="100%" style="position: absolute;left:0px;top:15px">
    <p id="<?=$id?>_param1" class="cm_image_label_style"></p>
  
   
</div>

</div>
<style>
 input, label {
    display:block;
}
.cm_image_label_style {
    font-size:10px;position: absolute;left:2px;top:2px;color:black; text-align: center;
}

.cm_image_box {
    position: absolute;
  
    width: 80px;
    height: 40px;
  
   
}
</style>

<script>
    function cmimage<?=$id?>_hide(data,report,graph_idx,graphData){
       
        var target0 = document.getElementById('<?=$id?>_param0');
        var target = document.getElementById('<?=$id?>_param');
        var target1 = document.getElementById('<?=$id?>_param1');
        var target2 = document.getElementById('<?=$id?>_param2');
        target.style.display = "none";
        if (report.size==1){
            target0.style.height='70px';
            target.style.width='70px';target.style.height='50px';
            target1.style.fontSize='8px';
            target1.style.width='70px';

            //target3.style.width='70px';

        } else  if (report.size==2){
            target0.style.height='100px';
            target.style.width='160px';target.style.height='80px';
            target1.style.fontSize='15px';
            target1.style.width='160px';

            //target2.style.width='160px';
            //target3.style.width='160px';

         } else  if (report.size==3){
             target0.style.height='120px';
            target.style.width='250px';target.style.height='100px';
            target1.style.fontSize='20px';
            target1.style.width='250px';
            //target2.style.width='250px';
            //target3.style.width='250px';


        } else  if (report.size==4){
            target0.style.height='170px';
            target.style.width='340px';target.style.height='150px';
            target1.style.fontSize='30px';
            target1.style.width='340px';
            //target2.style.width='340px';
            //target3.style.width='340px';

       }
        
        
    }
    function cmimage<?=$id?>(data,report,graph_idx,graphData){
        option = <?= Json::encode($options) ?>;
        var target0 = document.getElementById('<?=$id?>_param0');
        var target = document.getElementById('<?=$id?>_param');
        var target1 = document.getElementById('<?=$id?>_param1');
        var target2 = document.getElementById('<?=$id?>_param2');
      
        if (data.length<=1){
            target.style.display = "none";
            
            
        } else {
            target.style.display = "block";
            
            
            
            data2=data[1];
            data_label=data2[0];
            data_value=data2[1];
            unit_value=data2[2];
            target1.innerHTML=data_label;
            src=option.data[data_value];
            console.log("[ERROR]target2.src:"+target2.src);
            if (src==undefined){
                src=option.data["else"];
            }
            target2.src=src;
            console.log("[ERROR]target2.src:"+target2.src);
          
        }
        if (report.size==1){
            target0.style.height='70px';
            target.style.width='70px';target.style.height='50px';
            target1.style.fontSize='8px';
            target1.style.width='70px';

            //target3.style.width='70px';

        } else  if (report.size==2){
            target0.style.height='100px';
            target.style.width='160px';target.style.height='80px';
            target1.style.fontSize='15px';
            target1.style.width='160px';

            //target2.style.width='160px';
            //target3.style.width='160px';

         } else  if (report.size==3){
             target0.style.height='120px';
            target.style.width='250px';target.style.height='100px';
            target1.style.fontSize='20px';
            target1.style.width='250px';
            //target2.style.width='250px';
            //target3.style.width='250px';


        } else  if (report.size==4){
            target0.style.height='170px';
            target.style.width='340px';target.style.height='150px';
            target1.style.fontSize='30px';
            target1.style.width='340px';
            //target2.style.width='340px';
            //target3.style.width='340px';

       }
    }
    
</script>



