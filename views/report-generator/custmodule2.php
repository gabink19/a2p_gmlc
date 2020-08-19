<div style="position: relative;height: 400px">
<img src="\images\sensor_cuaca.jpeg" alt="Sensor cuaca" height="300px" width="80%" style="position: absolute;left:50px;top:0px">
<!--
<div id="param_0" style="position: absolute;left:10px;top:10px">
   
</div>

<div  style="position: absolute;left:200px;top:320px">
    <label for="param_Temperature">Temp:</label>
    <meter id="param2_Temperature" min="0" low="40" high="90" max="100" value="90"></meter>
</div>

-->

<div  id="<?=$id?>_param_1" style="display:none;position: absolute;left:10px;top:10px"  class="box">
    <p id="<?=$id?>_param1_1" class="label_style"></p>
     <p id="<?=$id?>_param3_1" class="unit_style"></p>
     <p id="<?=$id?>_param2_1" class="value_style"></p>
   
</div>
<div id="<?=$id?>_param_2" style="display:none;position: absolute;left:10px;top:55px"  class="box">
     <p id="<?=$id?>_param1_2" class="label_style"></p>
     <p id="<?=$id?>_param3_2" class="unit_style"></p>
     <p id="<?=$id?>_param2_2" class="value_style"></p>
   
</div>
<div  id="<?=$id?>_param_3" style="display:none;position: absolute;left:10px;top:100px"  class="box">
    <p id="<?=$id?>_param1_3" class="label_style"></p>
    <p id="<?=$id?>_param3_3" class="unit_style"></p>
     <p id="<?=$id?>_param2_3" class="value_style"></p>
</div>
<div id="<?=$id?>_param_4"  style="display:none;position: absolute;left:10px;top:145px" class="box">
   <p id="<?=$id?>_param1_4" class="label_style"></p>
   <p id="<?=$id?>_param3_4" class="unit_style"></p>
     <p id="<?=$id?>_param2_4" class="value_style"></p>
</div>
<div id="<?=$id?>_param_5"  style="display:none;position: absolute;left:10px;top:190px" class="box">
   <p id="<?=$id?>_param1_5" class="label_style"></p>
   <p id="<?=$id?>_param3_5" class="unit_style"></p>
     <p id="<?=$id?>_param2_5" class="value_style"></p>
</div>
<div id="<?=$id?>_param_6"  style="display:none;position: absolute;left:10px;top:235px" class="box">
   <p id="<?=$id?>_param1_6" class="label_style"></p>
   <p id="<?=$id?>_param3_6" class="unit_style"></p>
     <p id="<?=$id?>_param2_6" class="value_style"></p>
</div>
<div id="<?=$id?>_param_7"  style="display:none;position: absolute;left:10px;top:280px" class="box">
   <p id="<?=$id?>_param1_7" class="label_style"></p>
   <p id="<?=$id?>_param3_7" class="unit_style"></p>
     <p id="<?=$id?>_param2_7" class="value_style"></p>
</div>
<div id="<?=$id?>_param_8"  style="display:none;position: absolute;left:10px;top:325px" class="box">
   <p id="<?=$id?>_param1_8" class="label_style"></p>
   <p id="<?=$id?>_param3_8" class="unit_style"></p>
     <p id="<?=$id?>_param2_8" class="value_style"></p>
</div>
<div id="<?=$id?>_param_9"  style="display:none;position: absolute;left:95px;top:325px" class="box">
   <p id="<?=$id?>_param1_9" class="label_style"></p>
   <p id="<?=$id?>_param3_9" class="unit_style"></p>
     <p id="<?=$id?>_param2_9" class="value_style"></p>
</div>
<div id="<?=$id?>_param_10"  style="display:none;position: absolute;left:180px;top:325px" class="box">
   <p id="<?=$id?>_param1_10" class="label_style"></p>
   <p id="<?=$id?>_param3_10" class="unit_style"></p>
     <p id="<?=$id?>_param2_10" class="value_style"></p>
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
    function custmodule2<?=$id?>(data,report,graph_idx,graphData){
        /*
        var str="";
        for (let i = 0; i < data.length; i++) {
            data2=data[i];
        
            for (let i2 = 0; i2 < data2.length; i2++) {
                str=str+data2[i2]+",";
            
            }
            str=str+"<br>";
        }
        document.getElementById("param_0").innerHTML=str;*/
       
        
        /*for (var i=0; i < form.elements.length; i++) {
            var elementId = form.elements[i].id;
            
            if (elementId.startsWith('param')) {
               if (elementId=="param_Temperature") {
                   
               } else {
                   elementId.innerHTML="";
               }
            }
         }*/
        
        if (data.length>=2){
            var ids = document.querySelectorAll('[id]');

            Array.prototype.forEach.call( ids, function( el, i ) {
                // "el" is your element
                var elementId =el.id;
                if (elementId.startsWith('<?=$id?>_param_')) {
                    var_obj=document.getElementById(elementId);
                   /*if (elementId=="param_Temperature") {
                       var_obj.value=0;
                       //console.log(elementId+" ok");
                   } else {*/
                      //var_obj.innerHTML="";
                      var_obj.style.display = "none";
                     //console.log(elementId+" nok");
                   //}
                   
                }
            });
            for (let i2 = 1; i2 < data.length; i2++) {
                data2=data[i2];
                data_label=data2[0];
                data_value=data2[1];
                unit_value=data2[2];
            
                
                var_obj=document.getElementById("<?=$id?>_param2_"+i2);
                if (var_obj!=null) {
                   /*if (data_label=="Temperature") {
                      var_obj.value= data_value;
                   } else {*/
                       document.getElementById("<?=$id?>_param_"+i2).style.display = "block";
                       document.getElementById("<?=$id?>_param1_"+i2).innerHTML=data_label;
                       document.getElementById("<?=$id?>_param3_"+i2).innerHTML=unit_value;
                        var_obj.innerHTML=data_value;
                    //}
                }
                
                
            
            }
        }
    }
    
</script>



