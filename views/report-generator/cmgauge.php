<?

use yii\helpers\Json;
?>
<script type="text/javascript" src="\js\gauge.min.js"></script>
<div id="<?=$id?>_param_0" style="position: relative">
    
<canvas  id="<?=$id?>_param_1">
   
</canvas>
    <label id="<?=$id?>_param_2" class="cm_gauge_label"></label>
    <label id="<?=$id?>_param_3" class="cm_gauge_label2"></label>
    </div>
<style>
.cm_gauge_label {
display:block;
    margin-left:0px;
    
    text-align: center;
}
.cm_gauge_label2 {
display:block;
    margin-left:0px;
    
    text-align: center;
    font-size: 10px;
    margin-top: -5px;
    color: grey;
}
</style>

<script>
    //1 
    //
    
    var option = {
  angle: 0.12, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#000000' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true, 
  
  
  
};
 // set actual value
    function cmgauge<?=$id?>_hide(data,report,graph_idx,graphData){
        
        var target0 = document.getElementById('<?=$id?>_param_0');
        var target = document.getElementById('<?=$id?>_param_1');
        var target2 = document.getElementById('<?=$id?>_param_2');
        var target3 = document.getElementById('<?=$id?>_param_3');
        target.style.display = "none";
        target2.style.display = "none";
        target3.style.display = "none";
        if (report.size==1){
            target0.style.height='70px'
            target.style.width='70px';target.style.height='auto';
            target2.style.width='70px';
            target3.style.width='70px';

        } else  if (report.size==2){
            target0.style.height='100px'
            target.style.width='160px';target.style.height='auto';
            target2.style.width='160px';
            target3.style.width='160px';

         } else  if (report.size==3){
             target0.style.height='120px'
            target.style.width='250px';target.style.height='auto';
            target2.style.width='250px';
            target3.style.width='250px';


        } else  if (report.size==4){
            target0.style.height='170px'
            target.style.width='340px';target.style.height='auto';
            target2.style.width='340px';
            target3.style.width='340px';

       }
       
    }
    
    function cmgauge<?=$id?>(data,report,graph_idx,graphData){
        var target0 = document.getElementById('<?=$id?>_param_0');
        var target = document.getElementById('<?=$id?>_param_1');
        var target2 = document.getElementById('<?=$id?>_param_2');
        var target3 = document.getElementById('<?=$id?>_param_3');
        if (data.length<=1){
            target.style.display = "none";
            target2.style.display = "none";
            target3.style.display = "none";
            
        } else {
            target.style.display = "block";
            target2.style.display = "block";
            target3.style.display = "block";
            data2=data[1];
            
        
        
            data_label=data2[0];
            data_value=data2[1];
            unit_value=data2[2];
            if (data2.length>4){
                max_value=data2[4];

            } else {
                max_value=100;
            }
            option['percentColors']= [ [0.80, "#F2F3F4"],[0.90, "#FFFF00"], [1.0, "#ff0000"]];
            //option = <?= Json::encode($options) ?>;
            var gauge = new Gauge(target).setOptions(option); // create sexy gauge!
            gauge.maxValue = max_value; // set max gauge value
            gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
            gauge.animationSpeed = 32; // set animation speed (32 is default value)
            gauge.set(data_value);
            target2.innerHTML=data_value+" "+unit_value;
            target3.innerHTML=data_label;
            
       }
       if (report.size==1){
            target0.style.height='70px'
            target.style.width='70px';target.style.height='auto';
            target2.style.width='70px';
            target3.style.width='70px';

        } else  if (report.size==2){
            target0.style.height='100px'
            target.style.width='160px';target.style.height='auto';
            target2.style.width='160px';
            target3.style.width='160px';

         } else  if (report.size==3){
             target0.style.height='120px'
            target.style.width='250px';target.style.height='auto';
            target2.style.width='250px';
            target3.style.width='250px';


        } else  if (report.size==4){
            target0.style.height='170px'
            target.style.width='340px';target.style.height='auto';
            target2.style.width='340px';
            target3.style.width='340px';

       }
       

      
    }
    
</script>


