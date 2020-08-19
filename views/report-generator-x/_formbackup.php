<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");

/* @var $this yii\web\View */
/* @var $model backend\models\pelayan */
/* @var $form yii\widgets\ActiveForm */
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
* {
  box-sizing: border-box;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  width: 50%;
  padding: 5px;
  text-align: left;    
}

body {
  background-color: #f1f1f1;
}

.modal-dialog {
  width: 800px !important;
}

.vakata-context {
  z-index: 999999;
}

#jstree_table, #jstree_selected {
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -o-user-select: none;
  user-select: none;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input, select {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>

<div class="report-generator-x-form">

    <?php 
    
    $form = ActiveForm::begin([
        'options' => ['data-pjax' => true,'class' => "submitForm"],
        'action' =>[$view_form,'id'=>$model->tj_id],
    ]); ?>
    <div class="tab">
        <?= $form->errorSummary($model); ?>
        <?= $form->field($model, 'tj_id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'tj_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tj_desc')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="tab">
      <p>
        <select id="list_table" name="table" style="width: 70%"></select>
        <button type="button" onclick="ajaxTree()">Select</button>
      </p>
      <div style="overflow:auto;">
        <div class="col-md-6" style="display: block; height: 500px;">
          <p>List of field:</p>
          <div id="jstree_table" style="height: 400px; overflow: auto;"></div>
        </div>        
        <div id="data" class="col-md-6" style="display: block; height: 500px;">
          Operation:
          <div id="contentBox" style="display: block; height: 200px;"></div>
          <div style="display: inline-block;width: 100%;">
            <span style="float: left;">Selected field:</span>
          </div>
          <div id="jstree_selected" style="height: 200px; overflow: auto;"></div>
        </div>
      </div>
    </div>

    <div style="overflow:auto;">
      <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
        <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
      <?= Html::submitButton('Add', ['class' => 'btn btn-success createButton']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    var table = <?=json_encode($table)?>;
    var listtable = "";
    for (var key in table) {
      listtable += "<option value='"+table[key]+"'>"+table[key]+"</option>";
    }
    document.getElementById("list_table").innerHTML = listtable;
    var report = {};
    var jsonData = {data:[],column:[]};
    var json = <?=json_encode($json)?>;
    if (json != null) {
      jsonData = json;
      var fullMenuList=[];
      for(var i=0;i<jsonData.data.length;i++){if(jsonData.data[i].TYPE==1){fullMenuList.push({id:i,parent:"#",icon:"//jstree.com/tree.png",text:jsonData.data[i].TABLE_NAME+" (TYPE 1)"});if(typeof jsonData.data[i].data!=='undefined'){for(var j=0;j<jsonData.data[i].data.length;j++){if(jsonData.data[i].data[j].TYPE==3){fullMenuList.push({id:i+"-"+j,parent:i,icon:"glyphicon glyphicon-leaf",text:jsonData.data[i].data[j].COLUMN_NAME,text2:jsonData.data[i].data[j],})}else{fullMenuList.push({id:i+"-"+j,parent:i,icon:"//jstree.com/tree.png",text:jsonData.data[i].data[j].COLUMN_NAME});if(typeof jsonData.data[i].data[j].data!=='undefined'){for(var k=0;k<jsonData.data[i].data[j].data.length;k++){fullMenuList.push({id:i+"-"+j+"-"+k,parent:i+"-"+j,icon:"glyphicon glyphicon-leaf",text:jsonData.data[i].data[j].data[k].COLUMN_NAME,text2:jsonData.data[i].data[j].data[k],})}}}}}}else if(jsonData.data[i].TYPE==2){fullMenuList.push({id:i,parent:"#",icon:"//jstree.com/tree.png",text:jsonData.data[i].COLUMN_NAME+" (TYPE 2)"});if(typeof jsonData.data[i].data!=='undefined'){for(var j=0;j<jsonData.data[i].data.length;j++){if(jsonData.data[i].data[j].TYPE==3){fullMenuList.push({id:i+"-"+j,parent:i,icon:"glyphicon glyphicon-leaf",text:jsonData.data[i].data[j].COLUMN_NAME,text2:jsonData.data[i].data[j],})}else{fullMenuList.push({id:i+"-"+j,parent:i,icon:"//jstree.com/tree.png",text:jsonData.data[i].data[j].COLUMN_NAME});if(typeof jsonData.data[i].data[j].data!=='undefined'){for(var k=0;k<jsonData.data[i].data[j].data.length;k++){fullMenuList.push({id:i+"-"+j+"-"+k,parent:i+"-"+j,icon:"glyphicon glyphicon-leaf",text:jsonData.data[i].data[j].data[k].COLUMN_NAME,text2:jsonData.data[i].data[j].data[k],})}}}}}}else{fullMenuList.push({id:i,parent:"#",icon:"glyphicon glyphicon-leaf",text:jsonData.data[i].COLUMN_NAME,text2:jsonData.data[i],})}}

      var columnList = [];
      for(var i=0;i<jsonData.column.length;i++){columnList.push({id:i,parent:"#",icon:"glyphicon glyphicon-leaf",text:jsonData.column[i].COLUMN_NAME,state:{"opened":true},});var j=1;for(var key in jsonData.column[i]){columnList.push({id:i+"_"+j,parent:i,icon:"glyphicon glyphicon-info-sign",text:key+":"+jsonData.column[i][key],});j++}}
      initTree(fullMenuList,columnList);
      document.getElementById("list_table").value = jsonData.table_name;
    }
    var currentTab = 0;
    showTab(currentTab);
    var highlight = "";

    function ajaxTree() {
      var table_name = document.getElementById("list_table").value;

      jQuery.ajax({
        type: "GET",
        url: 'index.php?r=report-generator-x%2Fget-data-report&schema=icloud&table_name='+table_name+'&table_alias=1',
        statusCode: {
          500: function() {
            alert("Internal server error");
            done();
          }
        },
        success: function(response){
          jsonData = response;
          jsonData.column = [];
          var fullMenuList=[];
          for(var i=0;i<response.data.length;i++){if(response.data[i].TYPE==1){fullMenuList.push({id:i,parent:"#",icon:"//jstree.com/tree.png",text:response.data[i].TABLE_NAME+" (TYPE 1)"});if(typeof response.data[i].data!=='undefined'){for(var j=0;j<response.data[i].data.length;j++){if(response.data[i].data[j].TYPE==3){fullMenuList.push({id:i+"-"+j,parent:i,icon:"glyphicon glyphicon-leaf",text:response.data[i].data[j].COLUMN_NAME,text2:response.data[i].data[j],})}else{fullMenuList.push({id:i+"-"+j,parent:i,icon:"//jstree.com/tree.png",text:response.data[i].data[j].COLUMN_NAME});if(typeof response.data[i].data[j].data!=='undefined'){for(var k=0;k<response.data[i].data[j].data.length;k++){fullMenuList.push({id:i+"-"+j+"-"+k,parent:i+"-"+j,icon:"glyphicon glyphicon-leaf",text:response.data[i].data[j].data[k].COLUMN_NAME,text2:response.data[i].data[j].data[k],})}}}}}}else if(response.data[i].TYPE==2){fullMenuList.push({id:i,parent:"#",icon:"//jstree.com/tree.png",text:response.data[i].COLUMN_NAME+" (TYPE 2)"});if(typeof response.data[i].data!=='undefined'){for(var j=0;j<response.data[i].data.length;j++){if(response.data[i].data[j].TYPE==3){fullMenuList.push({id:i+"-"+j,parent:i,icon:"glyphicon glyphicon-leaf",text:response.data[i].data[j].COLUMN_NAME,text2:response.data[i].data[j],})}else{fullMenuList.push({id:i+"-"+j,parent:i,icon:"//jstree.com/tree.png",text:response.data[i].data[j].COLUMN_NAME});if(typeof response.data[i].data[j].data!=='undefined'){for(var k=0;k<response.data[i].data[j].data.length;k++){fullMenuList.push({id:i+"-"+j+"-"+k,parent:i+"-"+j,icon:"glyphicon glyphicon-leaf",text:response.data[i].data[j].data[k].COLUMN_NAME,text2:response.data[i].data[j].data[k],})}}}}}}else{fullMenuList.push({id:i,parent:"#",icon:"glyphicon glyphicon-leaf",text:response.data[i].COLUMN_NAME,text2:response.data[i],})}}

          $('#jstree_table').jstree('destroy');
          $('#jstree_selected').jstree('destroy');
          initTree(fullMenuList,[]);
        }
      });
    }

    function initTree(collumn, collumn2) {
      $('#jstree_table').jstree({
        "core" : {
          "check_callback": true,
          "data" : collumn
        },
        "plugins" : [ "conditionalselect" ],
        "conditionalselect" : function (node, event) {
          document.getElementById("contentBox").innerHTML = ""; 
          document.getElementById("contentBox").innerHTML = "<table id=\"tableBox\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
          if (typeof node.original.text2 !== "undefined") {
            $.each(node.original.text2, function( key, value ) {
              if (key == "COLUMN_NAME" || key == "ALIAS_NAME" || key == "COLUMN_ID" || key == "DATA_TYPE") {
                document.getElementById("tableBox").innerHTML += "<tr><th>"+key+"</th><td>"+value+"</td></tr>"; 
              }
            });
            document.getElementById("contentBox").innerHTML += "<button type='button' onclick=\"addField(\'"+node.original.text+"\',\'"+node.original.text2.ALIAS_NAME+"\',\'"+node.original.text2.COLUMN_ID+"\',\'"+node.original.text2.DATA_TYPE+"\')\">Add</button>";
          }
          try {
            $('#jstree_selected').jstree(true).deselect_node($('#jstree_selected').jstree().get_selected(true)[0].id);
          }
          catch(err) {
          }
          return true;
        }
      });
      
      $('#jstree_selected').jstree({
        "core" : {
          "check_callback": true,
          "data": collumn2
        },
        "plugins" : ["conditionalselect", "unique"],
        "conditionalselect" : function (node, event) {
          document.getElementById("contentBox").innerHTML = ""; 
          document.getElementById("contentBox").innerHTML = "<table id=\"tableBox\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
          var split = node["text"].split(":");
          if (split[1] != undefined) { 
            if (split[0] == "ALIAS_NAME") {
              document.getElementById("tableBox").innerHTML += "<tr><th>"+split[0]+"</th><td><input placeholder='value' type='text' id='update_selected' name='"+split[0]+"' value='"+split[1]+"'></td></tr>";
              document.getElementById("contentBox").innerHTML += "<button type='button' onclick=\"updateField(\'"+node.id+"\')\" style='float:right;'>Update</button>";
            } else {
               document.getElementById("tableBox").innerHTML += "<tr><th>"+split[0]+"</th><td><input placeholder='value' type='text' id='update_selected' name='"+split[0]+"' value='"+split[1]+"' disabled></td></tr>";
            }
          } else {
            document.getElementById("contentBox").innerHTML += "<button type='button' onclick=\"remove(\'"+node.id+"\')\">Remove</button>"
          }
          try {
          $('#jstree_table').jstree(true).deselect_node($('#jstree_table').jstree().get_selected(true)[0].id);
          }
          catch(err) {
          }
          return true;
        }
      });
    }

    function addField(node,node2,node3,node4) {
      $('#jstree_selected').jstree().create_node('#' ,  { 
        "id" : node, 
        "text" : node, 
        "icon" : "glyphicon glyphicon-leaf" ,
        "state" : {"opened" : true},
        "children" : [
          { "id" : node+"_1", "text" : "COLUMN_ID:"+node3, "icon" : "glyphicon glyphicon-info-sign" },
          { "id" : node+"_2", "text" : "COLUMN_NAME:"+node3, "icon" : "glyphicon glyphicon-info-sign"},
          { "id" : node+"_3", "text" : "ALIAS_NAME:"+node2, "icon" : "glyphicon glyphicon-info-sign" },
          { "id" : node+"_4", "text" : "COLUMN_COMMENT:", "icon" : "glyphicon glyphicon-info-sign" },
          { "id" : node+"_5", "text" : "DATA_TYPE:"+node4, "icon" : "glyphicon glyphicon-info-sign" }
        ],
      }, "last");
      modify();
    };

    function updateField(node) {
      var name = document.getElementById("update_selected").name;
      var value = document.getElementById("update_selected").value;
      if (name == "ALIAS_NAME") {
        $('#jstree_selected').jstree('rename_node', ""+node+"" , ""+name+":"+value+"" );
        modify();
      }
    }

    function remove(node) {
      try {
        $("#jstree_selected").jstree().delete_node(node);
        document.getElementById("contentBox").innerHTML = "";
      }
      catch(err) {
        console.info(err);
      }
      modify(); 
    }

    function modify() {
      jsonData.column = [];
      var i = 0;
      for (var key in $('#jstree_selected').jstree()._model.data) {
        if (!$('#jstree_selected').jstree()._model.data.hasOwnProperty(key)) continue;
        var obj = $('#jstree_selected').jstree()._model.data[key];
        if (obj["parent"] == "#") {
          var parent = obj["id"];
          var children = {};
          for (var key in $('#jstree_selected').jstree()._model.data) {
            var child = $('#jstree_selected').jstree()._model.data[key];
            if (child["parent"] == parent) {
              var split = child["text"].split(":");
              if (split[1] == "") {
                var add = JSON.parse('{"'+split[0]+'":""}');
              } else {
                var add = JSON.parse('{"'+split[0]+'":"'+split[1]+'"}');
              }
              $.extend( children, add );
            }
          }
          $.extend( children, JSON.parse('{"COLUMN_INDEX":'+i+'}') );
          jsonData.column.push(children);
          i++;
        }
      }
    }

    function update_report(){
      report = JSON.stringify(jsonData);
      return report;
    }

    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
      } else {
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      var x = document.getElementsByClassName("tab");
      if (n == 1 && !validateForm()) return false;
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
      if (currentTab >= x.length) {
        return false;
      }
      showTab(currentTab);
    }

    function validateForm() {
      var x, y, i, valid = true;
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      x[n].className += " active";
    }

</script>

<?$js=<<<js
        
    $(".submitForm").submit(function(event) {
                        
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        $(".createButton").prop('disabled', true);
        var data = $(this).serializeArray();
        data.push({'name':'json', 'value':update_report()});
        console.info(data);
        var url = $(this).attr('action');
        console.log('action:'+ url);
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
                // $(".modal.in").modal('hide');
                location.reload();
                
                //$.pjax.reload({container: '#id_pjax_id', async: false});
            }
            $(".createButton").prop('disabled', false);
        })
        .fail(function() {
            alert("fail");
            $(".createButton").prop('disabled', false);
        });
        return false;

    });
  
js;
$this->registerJs($js);
?>