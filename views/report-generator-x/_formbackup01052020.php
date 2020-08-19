<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");

/* @var $this yii\web\View */
/* @var $model backend\models\pelayan */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
  * {
    box-sizing: border-box
  }

  .report-generator-x-form table,
  .report-generator-x-form th,
  .report-generator-x-form td {
    border: 1px solid black;
    border-collapse: collapse
  }

  .report-generator-x-form th,
  .report-generator-x-form td {
    width: 50%;
    padding: 5px;
    text-align: left
  }

  .modal-dialog {
    width: 800px !important
  }

  .vakata-context {
    z-index: 999999
  }

  #jstree_table,
  #jstree_selected {
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -o-user-select: none;
    user-select: none
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px
  }

  h1 {
    text-align: center
  }

  input,
  select {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid#aaaaaa
  }

  input.invalid {
    background-color: #ffdddd
  }

  .tab {
    display: none
  }

  button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
  }

  button:hover {
    opacity: 0.8
  }

  button:disabled,
  button[disabled] {
    background-color: #cccccc;
  }

  #prevBtn {
    background-color: #bbbbbb
  }

  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5
  }

  .step.active {
    opacity: 1
  }

  .step.finish {
    background-color: #4CAF50
  }
</style>

<div class="report-generator-x-form">

  <?php

  $form = ActiveForm::begin([
    'options' => ['class' => "XXsubmitForm"],
    'action' => [$view_form, 'id' => $model->tj_id],
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute('report-generator-x/validation')
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
    <div style="overflow:auto; margin-bottom: 20px;">
      <div style="display: block; height: 430px; width: 45%; float: left;">
        <p>List of field:</p>
        <div id="jstree_table" style="height: 400px; overflow: auto; border: 1px solid #ccc !important;"></div>
      </div>

      <div style="display: table; height: 430px; width: 10%; float: left; padding-top: 30px;">
        <div style="display:table-cell; vertical-align:middle; text-align:center;">
          <button type="button" id="addF" class="glyphicon glyphicon-arrow-right" style="margin: 10px 0px;" title="Add" disabled=""></button>
          <button type="button" id="removeF" class="glyphicon glyphicon-arrow-left" style="margin: 10px 0px;" title="Remove" disabled=""></button>
        </div>
      </div>

      <div style="display: block; height: 430px; width: 45%; float: left; overflow: hidden;">
        <p>Selected field:</p>
        <div id="jstree_selected" style="height: 400px; overflow: auto; transition: height 1s; border: 1px solid #ccc !important;"></div>
        <div id="contentBox" style="display: block; margin-top: 10px;"></div>
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
  var table = <?= json_encode($table) ?>;
  var listtable = "";
  var fullMenuList = [];
  for (var key in table) {
    listtable += "<option value='" + table[key] + "'>" + table[key] + "</option>";
  }
  document.getElementById("list_table").innerHTML = listtable;
  var report = {};
  var jsonData = {
    data: [],
    column: []
  };
  var json = <?= json_encode($json) ?>;
  if (json != null) {
    jsonData = json;
    fullMenuList = [];
    
    for (var i = 0; i < jsonData.data.length; i++) {
      var dataT1   = jsonData.data[i];
      var idT1     = i;
      var parentT1 = "#";

      pushTree(dataT1, idT1, parentT1);
      
      if (typeof dataT1.data !== 'undefined') {
        for (var j = 0; j < dataT1.data.length; j++) {
          var dataT2   = dataT1.data[j];
          var idT2     = i + "-" + j;
          var parentT2 = i;

          pushTree(dataT2, idT2, parentT2);
          
          if (typeof dataT2.data !== 'undefined') {
            for (var k = 0; k < dataT2.data.length; k++) {
              var dataT3   = dataT2.data[k];
              var idT3     = i + "-" + j + "-" + k;
              var parentT3 = i + "-" + j;

              pushTree(dataT3, idT3, parentT3);
              
              if (typeof dataT3.data !== 'undefined') {
                for (var l = 0; l < dataT3.data.length; l++) {
                  var dataT4   = dataT3.data[l];
                  var idT4     = i + "-" + j + "-" + k + "-" + l;
                  var parentT4 = i + "-" + j + "-" + k;

                  pushTree(dataT4, idT4, parentT4);
                  
                  if (typeof dataT4.data !== 'undefined') {
                    for (var m = 0; m < dataT4.data.length; m++) {
                      var dataT5   = dataT4.data[m];
                      var idT5     = i + "-" + j + "-" + k + "-" + l + "-" + m;
                      var parentT5 = i + "-" + j + "-" + k + "-" + l;

                      pushTree(dataT5, idT5, parentT5);
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

    var columnList = [];
    for (var i = 0; i < jsonData.column.length; i++) {
      columnList.push({
        id: jsonData.column[i].COLUMN_ID,
        parent: "#",
        icon: "glyphicon glyphicon-leaf",
        text: jsonData.column[i].COLUMN_ID,
        state: {
          "opened": true
        },
      });
      var j = 1;
      for (var key in jsonData.column[i]) {
        columnList.push({
          id: jsonData.column[i].COLUMN_ID + "_" + j,
          parent: jsonData.column[i].COLUMN_ID,
          icon: "glyphicon glyphicon-info-sign",
          text: key + ":" + jsonData.column[i][key],
        });
        j++
      }
    }
    initTree(fullMenuList, columnList);
    document.getElementById("list_table").value = jsonData.table_name;
  }
  var currentTab = 0;
  showTab(currentTab);
  var highlight = "";

  function ajaxTree() {
    var table_name = document.getElementById("list_table").value;

    jQuery.ajax({
      type: "GET",
      url: 'index.php?r=report-generator-x%2Fget-data-report&schema=icloud&table_name=' + table_name + '&table_alias=1',
      statusCode: {
        500: function() {
          alert("Internal server error");
          done();
        }
      },
      success: function(response) {
        jsonData = response;
        jsonData.column = [];
        fullMenuList = [];

        for (var i = 0; i < response.data.length; i++) {
          var dataT1   = response.data[i];
          var idT1     = i;
          var parentT1 = "#";

          pushTree(dataT1, idT1, parentT1);
          
          if (typeof dataT1.data !== 'undefined') {
            for (var j = 0; j < dataT1.data.length; j++) {
              var dataT2   = dataT1.data[j];
              var idT2     = i + "-" + j;
              var parentT2 = i;

              pushTree(dataT2, idT2, parentT2);
              
              if (typeof dataT2.data !== 'undefined') {
                for (var k = 0; k < dataT2.data.length; k++) {
                  var dataT3   = dataT2.data[k];
                  var idT3     = i + "-" + j + "-" + k;
                  var parentT3 = i + "-" + j;

                  pushTree(dataT3, idT3, parentT3);
                  
                  if (typeof dataT3.data !== 'undefined') {
                    for (var l = 0; l < dataT3.data.length; l++) {
                      var dataT4   = dataT3.data[l];
                      var idT4     = i + "-" + j + "-" + k + "-" + l;
                      var parentT4 = i + "-" + j + "-" + k;

                      pushTree(dataT4, idT4, parentT4);
                      
                      if (typeof dataT4.data !== 'undefined') {
                        for (var m = 0; m < dataT4.data.length; m++) {
                          var dataT5   = dataT4.data[m];
                          var idT5     = i + "-" + j + "-" + k + "-" + l + "-" + m;
                          var parentT5 = i + "-" + j + "-" + k + "-" + l;

                          pushTree(dataT5, idT5, parentT5);
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }

        $('#jstree_table').jstree('destroy');
        $('#jstree_selected').jstree('destroy');
        initTree(fullMenuList, []);
      }
    });
  }

  function initTree(collumn, collumn2) {
    $('#jstree_table').jstree({
      "core": {
        "check_callback": true,
        "data": collumn
      },
      "plugins": ["conditionalselect"],
      "conditionalselect": function(node, event) {
        document.getElementById("removeF").disabled = true;
        document.getElementById("jstree_selected").style.height = "400px";
        document.getElementById("contentBox").innerHTML = "";
        if (typeof node.original.text2 !== "undefined") {
          document.getElementById("addF").disabled = false;
          document.getElementById("addF").setAttribute("onClick", "addField(\'" + node.original.text2.COLUMN_NAME + "\',\'" + node.original.text2.ALIAS_NAME + "\',\'" + node.original.text2.COLUMN_ID + "\',\'" + node.original.text2.DATA_TYPE + "\',\'" + node.original.text2.COLUMN_COMMENT + "\')");
        } else {
          document.getElementById("addF").disabled = true;
        }
        try {
          $('#jstree_selected').jstree(true).deselect_node($('#jstree_selected').jstree().get_selected(true)[0].id);
        } catch (err) {}
        return true;
      }
    });

    $('#jstree_selected').jstree({
      "core": {
        "check_callback": true,
        "data": collumn2
      },
      "plugins": ["conditionalselect", "unique"],
      "conditionalselect": function(node, event) {
        document.getElementById("addF").disabled = true;
        document.getElementById("contentBox").innerHTML = "";
        document.getElementById("contentBox").innerHTML = "<table id=\"tableBox\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
        var split = node["text"].split(":");
        if (split[1] != undefined) {
          if (split[0] == "ALIAS_NAME" || "COLUMN_COMMENT") {
            if (split[2] != undefined) {
              document.getElementById("tableBox").innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_selected' name='" + split[0] + "' value='" + split[1] + ":" + split[2] + "'></td></tr>";
            } else {
              document.getElementById("tableBox").innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_selected' name='" + split[0] + "' value='" + split[1] + "'></td></tr>";
            }
            document.getElementById("contentBox").innerHTML += "<button type='button' onclick=\"updateField(\'" + node.id + "\')\" style='float:right;'>Update</button>";
          } else {
            document.getElementById("tableBox").innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_selected' name='" + split[0] + "' value='" + split[1] + "' disabled></td></tr>";
          }
          document.getElementById("removeF").disabled = true;
          document.getElementById("jstree_selected").style.height = "250px";
        } else {
          document.getElementById("removeF").disabled = false;
          document.getElementById("removeF").setAttribute("onClick", "remove(\'" + node.id + "\')");
          document.getElementById("jstree_selected").style.height = "400px";
        }
        try {
          $('#jstree_table').jstree(true).deselect_node($('#jstree_table').jstree().get_selected(true)[0].id);
        } catch (err) {}
        return true;
      }
    });
  }

  function pushTree(dataT, idT, parentT){
    if (dataT.TYPE == 3) {
      fullMenuList.push({
        id: idT,
        parent: parentT,
        icon: "glyphicon glyphicon-leaf",
        text: dataT.COLUMN_NAME,
        text2: dataT,
      })
    } else if (dataT.TYPE == 1) {
      fullMenuList.push({
        id: idT,
        parent: parentT,
        icon: "https://icloud.icode.id/images/tree.png",
        text: dataT.TABLE_NAME
      })
    } else if (dataT.TYPE == 2) {
      fullMenuList.push({
        id: idT,
        parent: parentT,
        icon: "https://icloud.icode.id/images/tree2.png",
        text: dataT["REF.REFERENCED_TABLE_NAME"]
      })
    }
  }

  function addField(node, node2, node3, node4, node5) {
    $('#jstree_selected').jstree().create_node('#', {
      "id": node3,
      "text": node3,
      "icon": "glyphicon glyphicon-leaf",
      "state": {
        "opened": true
      },
      "children": [{
          "id": node3 + "_1",
          "text": "COLUMN_ID:" + node3,
          "icon": "glyphicon glyphicon-info-sign"
        },
        {
          "id": node3 + "_2",
          "text": "COLUMN_NAME:" + node,
          "icon": "glyphicon glyphicon-info-sign"
        },
        {
          "id": node3 + "_3",
          "text": "ALIAS_NAME:" + node2,
          "icon": "glyphicon glyphicon-info-sign"
        },
        {
          "id": node3 + "_4",
          "text": "COLUMN_COMMENT:" + node5,
          "icon": "glyphicon glyphicon-info-sign"
        },
        {
          "id": node3 + "_5",
          "text": "DATA_TYPE:" + node4,
          "icon": "glyphicon glyphicon-info-sign"
        }
      ],
    }, "last");
    modify();
  };

  function updateField(node) {
    var name = document.getElementById("update_selected").name;
    var value = document.getElementById("update_selected").value;
    if (name == "ALIAS_NAME" || name == "COLUMN_COMMENT") {
      $('#jstree_selected').jstree('rename_node', "" + node + "", "" + name + ":" + value + "");
      modify();
    }
  }

  function remove(node) {
    try {
      $("#jstree_selected").jstree().delete_node(node);
      document.getElementById("contentBox").innerHTML = "";
    } catch (err) {
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
            if (split[2] != undefined) {
              var add = JSON.parse('{"' + split[0] + '":"' + split[1] + ':' + split[2] + '"}');
            } else if (split[1] == "") {
              var add = JSON.parse('{"' + split[0] + '":""}');
            } else {
              var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}');
            }
            $.extend(children, add);
          }
        }
        $.extend(children, JSON.parse('{"COLUMN_INDEX":' + i + '}'));
        jsonData.column.push(children);
        i++;
      }
    }
  }

  function update_report() {
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

<?


$js = <<<js
        
    submitflag=false;
    $.noConflict();
        
    $(".XXsubmitForm").submit(function(event) {    
        if (!submitflag){
            submitflag=true;
            console.log("XXsubmitForm.submit");               
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
                    console.log("create.form");
                    console.log( response );
                    //alert(response.data.message); 
                    // $(".modal.in").modal('hide');
                    //location.reload();
                    window.location.href = "$redirect_url";

                   //$.pjax.reload({container: '#id_pjax_id', async: false});
                } else {
                    submitflag=false;
                    alert(response.data.message);
                }
                $(".createButton").prop('disabled', false);
                console.log("create.form done");
            })
            .fail(function() {
                submitflag=false;
                alert("fail");
                $(".createButton").prop('disabled', false);
            });
            console.log("XXsubmitForm.submit done");
        }
        return false;
         

    });
  
js;
$this->registerJs($js);
?>