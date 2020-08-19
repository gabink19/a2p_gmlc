<div  id="<?=$id?>_param0" style="position: relative">


<div  id="<?=$id?>_param" style="display:none;position: absolute;left:0px;top:0px"  class="box">
    <p id="<?=$id?>_param1" class="label_style"></p>
     <p id="<?=$id?>_param3" class="unit_style"></p>
     <p id="<?=$id?>_param2" class="value_style"></p>
   
</div>

</div>
<style>
 input, label {
    display:block;
}
.label_style {
    font-size:10px;position: absolute;left:2px;top:2px;color:white;
}
.unit_style {
    font-size:10px;position: absolute;right:2px;top:2px;color:white;
}
.value_style {
    color:white;font-weight: bold;font-size:20px;position: absolute;right:5px;top:10px;
}
.box {
    position: absolute;
    border-style: solid;
    border-radius: 5px;
    width: 80px;
    height: 40px;
    border-width: thin;
    background-color: rgba(255,0,0,0.4);
    border-color: red;
}
</style>

<script>
    
    function cmdisplay<?=$id?>_hide(data,report,graph_idx,graphData){
        var target0 = document.getElementById('<?=$id?>_param0');
        var target = document.getElementById('<?=$id?>_param');
        var target1 = document.getElementById('<?=$id?>_param1');
        var target3 = document.getElementById('<?=$id?>_param3');
        var target2 = document.getElementById('<?=$id?>_param2');
        target.style.display = "none";
        if (report.size==1){
                target0.style.height='70px';
                target.style.width='70px';target.style.height='50px';
                target1.style.fontSize='8px';
                target3.style.fontSize='8px';
                target2.style.fontSize='30px';
                //target3.style.width='70px';

            } else  if (report.size==2){
                target0.style.height='100px';
                target.style.width='160px';target.style.height='80px';
                target1.style.fontSize='15px';
                target3.style.fontSize='15px';
                target2.style.fontSize='60px';
                //target2.style.width='160px';
                //target3.style.width='160px';

             } else  if (report.size==3){
                 target0.style.height='120px';
                target.style.width='250px';target.style.height='100px';
                target1.style.fontSize='20px';
                target3.style.fontSize='20px';
                target2.style.fontSize='80px';
                //target2.style.width='250px';
                //target3.style.width='250px';
                

            } else  if (report.size==4){
                target0.style.height='170px';
                target.style.width='340px';target.style.height='150px';
                target1.style.fontSize='30px';
                target3.style.fontSize='30px';
                target2.style.fontSize='120px';
                //target2.style.width='340px';
                //target3.style.width='340px';

           }
        
    }
    function cmdisplay<?=$id?>(data,report,graph_idx,graphData){
        var target0 = document.getElementById('<?=$id?>_param0');
        var target = document.getElementById('<?=$id?>_param');
        var target1 = document.getElementById('<?=$id?>_param1');
        var target3 = document.getElementById('<?=$id?>_param3');
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
            target2.innerHTML=data_value;
            target3.innerHTML=unit_value;
        }
        if (report.size==1){
                target0.style.height='70px';
                target.style.width='70px';target.style.height='50px';
                target1.style.fontSize='8px';
                target3.style.fontSize='8px';
                target2.style.fontSize='30px';
                //target3.style.width='70px';

            } else  if (report.size==2){
                target0.style.height='100px';
                target.style.width='160px';target.style.height='80px';
                target1.style.fontSize='15px';
                target3.style.fontSize='15px';
                target2.style.fontSize='60px';
                //target2.style.width='160px';
                //target3.style.width='160px';

             } else  if (report.size==3){
                 target0.style.height='120px';
                target.style.width='250px';target.style.height='100px';
                target1.style.fontSize='20px';
                target3.style.fontSize='20px';
                target2.style.fontSize='80px';
                //target2.style.width='250px';
                //target3.style.width='250px';
                

            } else  if (report.size==4){
                target0.style.height='170px';
                target.style.width='340px';target.style.height='150px';
                target1.style.fontSize='30px';
                target3.style.fontSize='30px';
                target2.style.fontSize='120px';
                //target2.style.width='340px';
                //target3.style.width='340px';

           }
    }
    
</script>



