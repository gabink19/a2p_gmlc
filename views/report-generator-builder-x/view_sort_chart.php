<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
?>


<div class="report-generator-form">
<script type="text/javascript">
            function move(el, dir) {
                var max = el.options.length;
                //  the selected option
                var i1 = el.selectedIndex;
                var o1 = el.options[i1];
                
                //  the option to switch places with
                var i2 = (i1 + dir) % max;                
                if (i2 < 0) i2 = max - 1;
                var o2 = el.options[i2];
                
                //  temporarily move o1 to very end
                var tmp = el.options[max] = new Option(o1.text, o1.value);
                
                //  move o2 to o1
                el.options[i1] = new Option(o2.text, o2.value);
                
                //  move temp o1 to o2
                el.options[i2] = new Option(tmp.text, tmp.value);
                
                //  remove temp o1
                el.options.length = max;

                el.selectedIndex = i2;
            }
        </script>
    
    <?php
    $form = ActiveForm::begin(['options' => ['class' => "submitForm"]]
    );
      
    
        $id=0;
        $count=count($chart);
        echo "<select id='sel' size='$count' style='
            width: 300px;
        '>";
        foreach ($chart as $ch){
            echo "<option value='$id'> $ch</option>";
            $id++;
        }
        echo "</select>";
        ?>


    
        <input type="button" value="/\" onclick="move(this.form.sel, -1);" />
        <input type="button" value="\/" onclick="move(this.form.sel, 1);" />



        <div class="form-group">
        <?= Html::submitButton('Sort', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>



    </div>

<?
$js=<<<js
   function getSelectedOptions(oList)
    {
       
        var sdValues = "";
       for(var i = 0; i < oList.options.length; i++)
       {
          sdValues=sdValues+oList.options[i].value+",";
          
       }
       return sdValues;
    }
     
        
    $(".submitForm").submit(function(event) {
                        
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        //var data = $(this).serializeArray();
        //var data = $("[name='sel']").children("option:selected").val();
        var data = "selection="+getSelectedOptions(document.getElementById("sel"));
        var url = $(this).attr('action');
        console.log('action:'+ url+ " "+data);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert(response.data.message); 
                $(".modal.in").modal('hide');
                location.reload();
                //$.pjax.reload({container: '#id_pjax_id', async: false});
            } else {
                console.log( response )
                alert("fail");
            }

        })
        .fail(function(response) {
            console.log( response )
            alert("fail");

        });
        return false;

    });
  
js;
$this->registerJs($js);
?>

            


 