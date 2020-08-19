<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

$escape = new JsExpression("function(m) { return m; }");
?>

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
  * {
    box-sizing: border-box;
  }

  .report-generator-form table,
  .report-generator-form th,
  .report-generator-form td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  .report-generator-form th,
  .report-generator-form td {
    width: 50%;
    padding: 5px;
    text-align: left;
  }

  .report-generator-form body {
    background-color: #f1f1f1;
  }

  .modal-dialog {
    width: 800px !important;
  }

  .vakata-context {
    z-index: 999999;
  }

  #jstree_advance,
  #jstree_filter,
  #jstree_key,
  #jstree_field {
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

  input,
  select {
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

<div class="report-generator-form">

  <?php
  $form = ActiveForm::begin(
    ['options' => ['class' => "submitForm"]]
  ); ?>


  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>General:</h1>
    <?php 
      foreach ($general_param as $key => $value) {
        echo $value."<p><input placeholder=\"".strtolower($value)."\" type=\"text\" name=\"".strtolower($value)."\" id=\"chart_param_".strtolower($value)."\" style=\"margin-bottom: 15px;\"></p>";
      }
    ?>
    <div style="display: flex; flex-direction: row; justify-content: space-between; margin-bottom: 15px;">
      <div style="width: 30%;">
        Selection Flag: <p><select id="chart_selection_flag" name="selection_flag">
            <option value="0">No</option>
            <option value="1" selected>Yes</option>
          </select></p>
      </div>
      <div style="width: 30%;">
        Sorted: <p><select id="chart_sorted" name="sorted">
            <option value="-1" selected>No</option>
            <option value="0">Yes</option>
          </select></p>
      </div>
      <div style="width: 30%;">
        Sorted Method: <p><select id="chart_sorted_method" name="sorted_method">
            <option value="0" selected>Descending</option>
            <option value="1">Ascending</option>
          </select></p>
      </div>
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between; margin-bottom: 15px;">
      <div style="width: 30%;">
        Max Display: <p><input type="number" placeholder="max_display" value="0" name="max_display" id="chart_max_display"></p>
      </div>
      <div style="width: 30%;">
        Double click: <p><select id="chart_dblclick" name="dblclick"></select></p>
      </div>
      <div style="width: 30%;">
        Size:
        <p>
          <select id="chart_size" name="size" onchange="previewSize()">
            <option value="12" selected>Full screen</option>
            <option value="6">Half screen</option>
            <option value="4">1/3 screen</option>
            <option value="3">1/4 screen</option>
            <option value="2">1/6 screen</option>
            <option value="1">1/12 screen</option>
          </select>
        </p>
      </div>
    </div>
    Size preview: <div id="size_preview" style="width: 100%; display: inline-block;"></div>
  </div>
  <div class="tab">
    <h1>Chart Type:</h1>
    <p>
      <select id="chart_visualization" name="fname" onchange="advance()"></select>
    </p>

    <?
    echo Html::button("<span class='glyphicon glyphicon-filter'></span>", [
      'style' => 'background:none;border:none;padding:5px;color:black',
      'class' => 'grid-action',
      'data-toggle' => 'collapse',
      'data-placement' => 'bottom',
      'data-target' => "#chart_advance",
      'title' => 'Filter'
    ]);
    ?>

    <div id="chart_advance" class="collapse">
      <div style="overflow: auto;">
        <div class="col-sm-6" style="display: block; height: 350px;">
          Options:
          <div id="jstree_advance" style="height: 80%; overflow: auto;"></div>
        </div>
        <div class="col-sm-6" style="display: block; height: 350px;">
          Operation:
          <div id="contentadvance" style="display: block; height: 90%;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab">
    <h1>Key:</h1>
    <p>
      <select id="chart_key" name="key" style="width: 70%"></select>
      <button type="button" onclick="addTree('key')">Add</button>
    </p>
    <div style="overflow: auto;">
      <div class="col-sm-6" style="display: block; height: 350px;">
        Selected Key:
        <div id="jstree_key" style="height: 80%; overflow: auto;"></div>
      </div>
      <div class="col-sm-6" style="display: block; height: 350px;">
        Operation:
        <div id="contentkey" style="display: block; height: 90%;"></div>
      </div>
    </div>
  </div>
  <div class="tab">
    <h1>Field:</h1>
    <p>
      <select id="chart_field" name="field" style="width: 70%"></select>
      <button type="button" onclick="addTree('field')">Add</button>
    </p>
    <div style="overflow: auto;">
      <div class="col-sm-6" style="display: block; height: 350px;">
        Selected Field:
        <div id="jstree_field" style="height: 80%; overflow: auto;"></div>
      </div>
      <div class="col-sm-6" style="display: block; height: 350px;">
        Operation:
        <div id="contentfield" style="display: block; height: 90%;"></div>
      </div>
    </div>
  </div>
  <div class="tab">
    <h1>Filter:</h1>
    <p>
      <select id="chart_filter" name="filter" style="width: 70%"></select>
      <button type="button" onclick="addTree('filter')">Add</button>
    </p>
    <div style="overflow: auto;">
      <div class="col-sm-6" style="display: block; height: 350px;">
        Selected Filter:
        <div id="jstree_filter" style="height: 80%; overflow: auto;"></div>
      </div>
      <div class="col-sm-6" style="display: block; height: 350px;">
        Operation:
        <div id="contentfilter" style="display: block; height: 90%;"></div>
      </div>
    </div>
  </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <!-- <button type="button" id="re">Console</button> -->
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">`
      <?= Html::submitButton($action_name == "actionAddReport" ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>
  </div>


  <?php ActiveForm::end(); ?>


</div>

<script>
  var action = <?= json_encode($action_name) ?>;
  var column = <?= json_encode($column) ?>;
  var report = <?= json_encode($report) ?>;
  var general = <?= json_encode($general_param) ?>;
  var chart = <?= json_encode($visual_param) ?>;
  var page = <?= json_encode($page) ?>;
  var data_type = <?= json_encode($data_type) ?>;
  var data_type2 = <?= json_encode($data_type2) ?>;
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab
  var jsonData = {
    advance: {},
    filter: [],
    key: [],
    field: []
  };
  var loadData = {
    advance: [],
    filter: [],
    key: [],
    field: []
  };

  var listchart = "";
  for (var key in chart) {
    listchart += "<option value='" + JSON.stringify(chart[key].options) + "'>" + key + "</option>";
  }

  var listcolumn = "";
  for (var i = 0; i < column.length; i++) {
    listcolumn += "<option value='" + JSON.stringify(column[i]) + "'>" + column[i].ALIAS_NAME + "</option>";
  }

  var listpage = "<option value='null'>null</option>";
  for (var i = 0; i < page.length; i++) {
    listpage += "<option value='" + i + "'>" + page[i] + "</option>";
  }
  
  var listtype = "";
  for (var key in data_type) {
    listtype += "<option value='" + key + "'>" + data_type[key] + "</option>";
  }

  var listtype2 = "";
  for (var key in data_type2) {
    listtype2 += "<option value='" + key + "'>" + data_type2[key] + "</option>";
  }


  document.getElementById("chart_visualization").innerHTML = listchart;
  document.getElementById("chart_filter").innerHTML = listcolumn;
  document.getElementById("chart_key").innerHTML = listcolumn;
  document.getElementById("chart_field").innerHTML = listcolumn;
  document.getElementById("chart_dblclick").innerHTML = listpage;

  if (action == "actionEditReport") {
    var dd = document.getElementById("chart_visualization");
    for (var i = 0; i < dd.options.length; i++) {
      if (dd.options[i].text === report.visualization) {
        dd.selectedIndex = i;
        break;
      }
    }

    for (var key in general){
      document.getElementById("chart_param_"+general[key].toLowerCase()).value = report[general[key].toLowerCase()];
    }
    document.getElementById("chart_selection_flag").value = report.selection_flag;
    document.getElementById("chart_sorted").value = report.sorted;
    document.getElementById("chart_sorted_method").value = report.sorted_method;
    document.getElementById("chart_max_display").value = report.max_display;
    document.getElementById("chart_dblclick").value = report.dblclick;
    document.getElementById("chart_size").value = report.size;

    jsonData.advance = report.options;
    jsonData.key = report.key;
    jsonData.field = report.field;

    loadData.advance.push({
      id: "create",
      parent: "#",
      icon: "glyphicon glyphicon-plus",
      text: "create",
    });
    for (var key in jsonData.advance) {
      var parent = key;
      var sub = jsonData.advance[key];
      if (typeof sub == "object") {
        loadData.advance.push({
          id: key,
          parent: "#",
          icon: "glyphicon glyphicon-leaf",
          text: key,
          state: {
            "opened": true
          },
        });
        for (var key in sub) {
          loadData.advance.push({
            id: parent + "_" + key,
            parent: parent,
            icon: "glyphicon glyphicon-info-sign",
            text: key + ":" + sub[key],
            state: {
              "opened": true
            },
          })
        }
      } else {
        loadData.advance.push({
          id: key,
          parent: "#",
          icon: "glyphicon glyphicon-info-sign",
          text: key + ":" + sub,
          state: {
            "opened": true
          },
        })
      }
    }

    for (var i = 0; i < jsonData.key.length; i++) {
      delete jsonData.key[i].field_seq;
      loadData.key.push({
        id: "id_" + column[jsonData.key[i].field_no].COLUMN_INDEX,
        parent: "#",
        icon: "glyphicon glyphicon-leaf",
        text: column[jsonData.key[i].field_no].ALIAS_NAME,
        state: {
          "opened": true
        },
      });
      for (var key in jsonData.key[i]) {
        loadData.key.push({
          id: "id_" + column[jsonData.key[i].field_no].COLUMN_INDEX + "_" + key,
          parent: "id_" + column[jsonData.key[i].field_no].COLUMN_INDEX,
          icon: "glyphicon glyphicon-info-sign",
          text: key + ":" + jsonData.key[i][key],
        })
      }
    }

    for (var i = 0; i < jsonData.field.length; i++) {
      delete jsonData.field[i].field_seq;
      loadData.field.push({
        id: "id_" + column[jsonData.field[i].field_no].COLUMN_INDEX,
        parent: "#",
        icon: "glyphicon glyphicon-leaf",
        text: column[jsonData.field[i].field_no].ALIAS_NAME,
        state: {
          "opened": true
        },
      });
      for (var key in jsonData.field[i]) {
        loadData.field.push({
          id: "id_" + column[jsonData.field[i].field_no].COLUMN_INDEX + "_" + key,
          parent: "id_" + column[jsonData.field[i].field_no].COLUMN_INDEX,
          icon: "glyphicon glyphicon-info-sign",
          text: key + ":" + jsonData.field[i][key],
        })
      }
    }

    if (report.filter != undefined) {
      jsonData.filter = report.filter;
      for (var i = 0; i < jsonData.filter.length; i++) {
        delete jsonData.filter[i].field_seq;
        loadData.filter.push({
          id: "id_" + column[jsonData.filter[i].field_no].COLUMN_INDEX,
          parent: "#",
          icon: "glyphicon glyphicon-leaf",
          text: column[jsonData.filter[i].field_no].ALIAS_NAME,
          state: {
            "opened": true
          },
        });
        for (var key in jsonData.filter[i]) {
          var base = "id_" + column[jsonData.filter[i].field_no].COLUMN_INDEX;
          var parent = key;
          var sub = jsonData.filter[i][key];
          if (typeof sub != "object") {
            loadData.filter.push({
              id: base + "_" + key,
              parent: base,
              icon: "glyphicon glyphicon-info-sign",
              text: key + ":" + sub,
              state: {
                "opened": true
              },
            })
          }
        }
        for (var key in jsonData.filter[i]) {
          var base = "id_" + column[jsonData.filter[i].field_no].COLUMN_INDEX;
          var parent = key;
          var sub = jsonData.filter[i][key];
          if (typeof sub == "object") {
            loadData.filter.push({
              id: base + "_" + key,
              parent: base,
              icon: "glyphicon glyphicon-menu-hamburger",
              text: key,
              state: {
                "opened": true
              },
            });
            for (var key in sub) {
              loadData.filter.push({
                id: base + "_" + parent + "_" + key,
                parent: base + "_" + parent,
                icon: "glyphicon glyphicon-info-sign",
                text: sub[key],
                state: {
                  "opened": true
                },
              })
            }
          }
        }
      }
    }
  } else {
    var node = JSON.parse(document.getElementById("chart_visualization").value);
    jsonData.advance = node;
    loadData.advance.push({
      id: "create",
      parent: "#",
      icon: "glyphicon glyphicon-plus",
      text: "create",
    });
    for (var key in jsonData.advance) {
      var parent = key;
      var sub = jsonData.advance[key];
      if (typeof sub == "object") {
        loadData.advance.push({
          id: key,
          parent: "#",
          icon: "glyphicon glyphicon-leaf",
          text: key,
          state: {
            "opened": true
          },
        });
        for (var key in sub) {
          loadData.advance.push({
            id: parent + "_" + key,
            parent: parent,
            icon: "glyphicon glyphicon-info-sign",
            text: key + ":" + sub[key],
            state: {
              "opened": true
            },
          })
        }
      } else {
        loadData.advance.push({
          id: key,
          parent: "#",
          icon: "glyphicon glyphicon-info-sign",
          text: key + ":" + sub,
          state: {
            "opened": true
          },
        })
      }
    }
  }

  $.each(["advance", "filter", "key", "field"], function(index, value) {
    $('#jstree_' + value).jstree({
      "core": {
        "check_callback": true,
        "data": loadData[value]
      },
      "plugins": ["conditionalselect", "unique"],
      "conditionalselect": function(node, event) {
        document.getElementById("content" + value).innerHTML = "";
        if (value == "advance") {
          if (node["text"] == "create") {
            document.getElementById("content" + value).innerHTML = "<span id=\"info_" + value + "\">Create new attribute</span> <table id=\"table" + value + "\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
            document.getElementById("table" + value).innerHTML += "<tr><th><input placeholder='attribute' type='text' id='update_" + value + "' name='addNew' value=''></th><td><input placeholder='value' type='text' id='update_" + value + "2' value=''></td></tr>";
            document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"updateTree(\'" + value + "\',\'" + node.id + "\',\'" + node.parent + "\')\">Add</button>";
          } else {
            var split = node["text"].split(":");
            if (split[1] != undefined) {
              document.getElementById("content" + value).innerHTML = "<table id=\"table" + value + "\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
              if (split[0] == "position") {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><select id='update_" + value + "' name='" + split[0] + "'><option value='top'>Top</option><option value='bottom'>Bottom</option></select> </td></tr>";
              } else {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_" + value + "' name='" + split[0] + "' value='" + split[1] + "'></td></tr>";
              }
              document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"remove(\'" + value + "\',\'" + node.id + "\')\">Remove</button>";
              document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"updateTree(\'" + value + "\',\'" + node.id + "\',\'" + node.parent + "\')\" style='float:right;'>Update</button>";
            } else {
              document.getElementById("content" + value).innerHTML = "<span id=\"info_" + value + "\">Create new sub attribute</span> <table id=\"table" + value + "\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
              document.getElementById("table" + value).innerHTML += "<tr><th><input placeholder='sub attribute' type='text' id='update_" + value + "' name='addSub' value=''></th><td><input placeholder='value' type='text' id='update_" + value + "2' value=''></td></tr>";
              document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"remove(\'" + value + "\',\'" + node.id + "\')\">Remove</button>";
              document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"updateTree(\'" + value + "\',\'" + node.id + "\',\'" + node.parent + "\')\" style='float:right;'>Add Sub attribute</button>";
            }
          }
        } else if (node["text"] == "value") {
          document.getElementById("content" + value).innerHTML = "<table id=\"table" + value + "\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
          document.getElementById("table" + value).innerHTML += "<tr><th>new value</th><td><input placeholder='value' type='text' id='update_" + value + "' name='addValue' value=''></td></tr>";
          document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"updateTree(\'" + value + "\',\'" + node.id + "\',\'" + node.parent + "\')\">Add</button>";
        } else if (node["children"].length == 0) {
          var split = node["text"].split(":");
          document.getElementById("content" + value).innerHTML = "<table id=\"table" + value + "\" style=\"width: 100%; margin-bottom: 10px;\"></table>";
          if (split[0] == "field_no" || split[0] == "COLUMN_ID") {
            document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_" + value + "' name='" + split[0] + "' value='" + split[1] + "' disabled></td></tr>";
          } else {
            if (split[1] != undefined) {
              if (split[0] == "data_type") {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><select id='update_" + value + "' name='" + split[0] + "'></select> </td></tr>";
                var selectList = document.getElementById("update_" + value);
                for (var key in data_type) {
                  var option = document.createElement("option");
                  if (key == split[1]) {
                    option.value = key;
                    option.text = data_type[key];
                    option.setAttribute('selected', 'selected');
                  } else {
                    option.value = key;
                    option.text = data_type[key];
                  }
                  selectList.appendChild(option);
                }
              }  else if (split[0] == "data_type2") {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><select id='update_" + value + "' name='" + split[0] + "'></select> </td></tr>";
                var selectList = document.getElementById("update_" + value);
                for (var key in data_type2) {
                  var option = document.createElement("option");
                  if (key == split[1]) {
                    option.value = key;
                    option.text = data_type2[key];
                    option.setAttribute('selected', 'selected');
                  } else {
                    option.value = key;
                    option.text = data_type2[key];
                  }
                  selectList.appendChild(option);
                }
              } else if (split[0] == "data_type3" || split[0] == "data_type4") {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='function' type='text' id='update_" + value + "' name='" + split[0] + "' value='" + split[1] + "'></td></tr>";
              } else if (split[0] == "operation_type") {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><select id='update_" + value + "' name='" + split[0] + "'><option id='0' value='0'>0 (not equal to)</option><option id='1' value='1'>1 (equal to)</option></select> </td></tr>";
              } else {
                document.getElementById("table" + value).innerHTML += "<tr><th>" + split[0] + "</th><td><input placeholder='value' type='text' id='update_" + value + "' name='" + split[0] + "' value='" + split[1] + "'></td></tr>";
              }
            } else {
              document.getElementById("table" + value).innerHTML += "<tr><th>value</th><td><input placeholder='value' type='text' id='update_" + value + "' name='value' value='" + split[0] + "'></td></tr>";
              document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"remove(\'" + value + "\',\'" + node.id + "\')\">Remove</button>";
            }
            document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"updateTree(\'" + value + "\',\'" + node.id + "\',\'" + node.parent + "\')\" style='float:right;'>Update</button>";
          }
        } else if (node["parent"] == "#") {
          document.getElementById("content" + value).innerHTML += "<button type='button' onclick=\"remove(\'" + value + "\',\'" + node.id + "\')\">Remove</button>";
        }
        return true;
      }
    });
  });

  function advance() {
    var children = $('#jstree_advance').jstree(true).get_node('#').children;
    $('#jstree_advance').jstree(true).delete_node(children);

    var node = JSON.parse(document.getElementById("chart_visualization").value);
    $('#jstree_advance').jstree().create_node('#', {
      "id": "create",
      "text": "create",
      "icon": "glyphicon glyphicon-plus"
    }, "last");
    for (var key in node) {
      var parent = key;
      var sub = node[key];
      if (typeof sub == "object") {
        $('#jstree_advance').jstree().create_node('#', {
          "id": key,
          "text": key,
          "icon": "glyphicon glyphicon-leaf",
          "state": {
            "opened": true
          }
        }, "last");
        for (var key in sub) {
          $('#jstree_advance').jstree().create_node("" + parent + "", {
            "id": parent + "_" + key,
            "text": key + ":" + sub[key],
            "icon": "glyphicon glyphicon-info-sign",
            "state": {
              "opened": true
            }
          }, "last");
        }
      } else {
        $('#jstree_advance').jstree().create_node('#', {
          "id": key,
          "text": key + ":" + node[key],
          "icon": "glyphicon glyphicon-info-sign",
          "state": {
            "opened": true
          }
        }, "last");
      }
    }
    modify("advance");
  }

  function previewSize() {
    var x = document.getElementById("chart_size").value;
    var loop = "";
    for (var i = 1; i <= 12 / x; i++) {
      if (i == 1) {
        loop += "<div class='col-md-" + x + "' style='margin: 0 0 10px; position:relative;'><div style='border: 1px dashed #000; text-align: center; padding-top: 3px;'><div style='height: 30px; width: 30px; position: relative; margin: auto;'><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #E64C65;'></div><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #4FC4F6; -webkit-clip-path: polygon(50% 0, 50% 50%, 100% 41.2%, 100% 0); clip-path: polygon(50% 0, 50% 50%, 100% 41.2%, 100% 0);'></div><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #FFED0D; -webkit-clip-path: polygon(50% 50%, 100% 41.2%, 100% 100%, 63.4% 100%); clip-path: polygon(50% 50%, 100% 41.2%, 100% 100%, 63.4% 100%);'></div></div>Your Chart</div></div>";
      } else {
        loop += "<div class='col-md-" + x + "' style='margin: 0 0 10px; position:relative;'><div style='border: 1px dashed #000; text-align: center; padding-top: 3px;'><div style='height: 30px; width: 30px; position: relative; margin: auto; filter: grayscale(100%);'><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #E64C65;'></div><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #4FC4F6; -webkit-clip-path: polygon(50% 0, 50% 50%, 100% 41.2%, 100% 0); clip-path: polygon(50% 0, 50% 50%, 100% 41.2%, 100% 0);'></div><div style='width: 100%; height: 100%; border-radius: 50%; position: absolute; background-color: #FFED0D; -webkit-clip-path: polygon(50% 50%, 100% 41.2%, 100% 100%, 63.4% 100%); clip-path: polygon(50% 50%, 100% 41.2%, 100% 100%, 63.4% 100%);'></div></div>Other Chart</div></div>";
      }
    }
    document.getElementById("size_preview").innerHTML = loop;
  }

  previewSize();

  function addTree(select) {
    if (select == "filter") {
      var node = JSON.parse(document.getElementById("chart_filter").value);

      $('#jstree_filter').jstree().create_node('#', {
        "id": "id_" + node.COLUMN_INDEX,
        "text": node.ALIAS_NAME,
        "icon": "glyphicon glyphicon-leaf",
        "state": {
          "opened": true
        },
        "children": [{
            "id": "id_" + node.COLUMN_INDEX + "_field_no",
            "text": "field_no:" + node.COLUMN_INDEX,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_data_type",
            "text": "data_type:" + node.DATA_TYPE,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_operation_type",
            "text": "operation_type:0",
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_COLUMN_ID",
            "text": "COLUMN_ID:" + node.COLUMN_ID,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_value",
            "text": "value",
            "icon": "glyphicon glyphicon-menu-hamburger",
            "state": {
              "opened": true
            },
            "children": []
          }
        ]
      }, "last");
    } else if (select == "key") {
      var node = JSON.parse(document.getElementById("chart_key").value);
      $('#jstree_key').jstree().create_node('#', {
        "id": "id_" + node.COLUMN_INDEX,
        "text": node.ALIAS_NAME,
        "icon": "glyphicon glyphicon-leaf",
        "state": {
          "opened": true
        },
        "children": [{
            "id": "id_" + node.COLUMN_INDEX + "_COLUMN_NAME",
            "text": "COLUMN_NAME:" + node.COLUMN_NAME,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_field_no",
            "text": "field_no:" + node.COLUMN_INDEX,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_data_type",
            "text": "data_type:" + node.DATA_TYPE,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_COLUMN_ID",
            "text": "COLUMN_ID:" + node.COLUMN_ID,
            "icon": "glyphicon glyphicon-info-sign"
          }
        ]
      }, "last");
    } else if (select == "field") {
      var node = JSON.parse(document.getElementById("chart_field").value);
      $('#jstree_field').jstree().create_node('#', {
        "id": "id_" + node.COLUMN_INDEX,
        "text": node.ALIAS_NAME,
        "icon": "glyphicon glyphicon-leaf",
        "state": {
          "opened": true
        },
        "children": [{
            "id": "id_" + node.COLUMN_INDEX + "_COLUMN_NAME",
            "text": "COLUMN_NAME:" + node.COLUMN_NAME,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_field_no",
            "text": "field_no:" + node.COLUMN_INDEX,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_data_type",
            "text": "data_type:" + node.DATA_TYPE,
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_data_type2",
            "text": "data_type2:count",
            "icon": "glyphicon glyphicon-info-sign"
          },
          {
            "id": "id_" + node.COLUMN_INDEX + "_COLUMN_ID",
            "text": "COLUMN_ID:" + node.COLUMN_ID,
            "icon": "glyphicon glyphicon-info-sign"
          }
        ]
      }, "last");
    }
    modify(select);
  };

  function remove(select, node) {
    try {
      $("#jstree_" + select).jstree().delete_node(node);
      document.getElementById("content" + select).innerHTML = "";
    } catch (err) {
      console.info(err);
    }
    modify(select);
  }

  function updateTree(select, node, parent) {
    var name = document.getElementById("update_" + select).name;
    var value = document.getElementById("update_" + select).value;
    if (name == "addValue") {
      $('#jstree_' + select).jstree().create_node("" + node + "", {
        "id": node + "_" + value,
        "text": value,
        "icon": "glyphicon glyphicon-info-sign"
      }, "last");
    } else if (name == "addNew") {
      var value = document.getElementById("update_" + select).value
      var value2 = document.getElementById("update_" + select + "2").value;
      if (value == "") {
        document.getElementById("info_" + select).style.color = "red";
        document.getElementById("info_" + select).innerHTML = "Attribute cannot be blank";
      } else {
        if (value != "" && value2 != "") {
          $('#jstree_' + select).jstree().create_node("#", {
            "id": value,
            "text": value + ":" + value2,
            "icon": "glyphicon glyphicon-info-sign"
          }, "last");
        } else if (value != "" && value2 == "") {
          $('#jstree_' + select).jstree().create_node("#", {
            "id": value,
            "text": value,
            "icon": "glyphicon glyphicon-leaf",
            "state": {
              "opened": true
            }
          }, "last");
        }
        document.getElementById("info_" + select).style.color = "black";
        document.getElementById("info_" + select).innerHTML = "Attribute has been added";
      }

    } else if (name == "addSub") {
      var value = document.getElementById("update_" + select).value
      var value2 = document.getElementById("update_" + select + "2").value;
      if (value == "") {
        document.getElementById("info_" + select).style.color = "red";
        document.getElementById("info_" + select).innerHTML = "Sub attribute cannot be blank";
      } else {
        if (value != "" && value2 != "") {
          $('#jstree_' + select).jstree().create_node("" + node + "", {
            "id": node + "_" + value,
            "text": value + ":" + value2,
            "icon": "glyphicon glyphicon-info-sign"
          }, "last");
        } else if (value != "" && value2 == "") {
          $('#jstree_' + select).jstree().create_node("" + node + "", {
            "id": node + "_" + value,
            "text": value,
            "icon": "glyphicon glyphicon-leaf",
            "state": {
              "opened": true
            }
          }, "last");
        }
        document.getElementById("info_" + select).style.color = "black";
        document.getElementById("info_" + select).innerHTML = "Sub attribute has been added";
      }
    } else if (name == "value") {
      $('#jstree_' + select).jstree('rename_node', "" + node + "", "" + value + "");
    } else if (name == "data_type") {
      $('#jstree_' + select).jstree('rename_node', "" + node + "", "" + name + ":" + value + "");
      if (value == "extended") {
        $('#jstree_' + select).jstree().create_node("" + parent + "", {
          "id": parent + "_data_type3",
          "text": "data_type3:function1",
          "icon": "glyphicon glyphicon-info-sign"
        }, 4);
      } else {
        try {
          $("#jstree_" + select).jstree().delete_node(parent + "_data_type3");
        } catch (err) {
          console.info(err);
        }
      }
    } else if (name == "data_type2") {
      $('#jstree_' + select).jstree('rename_node', "" + node + "", "" + name + ":" + value + "");
      if (value == "extended") {
        $('#jstree_' + select).jstree().create_node("" + parent + "", {
          "id": parent + "_data_type4",
          "text": "data_type4:function1",
          "icon": "glyphicon glyphicon-info-sign"
        }, 5);
      } else {
        try {
          $("#jstree_" + select).jstree().delete_node(parent + "_data_type4");
        } catch (err) {
          console.info(err);
        }
      }
    } else {
      $('#jstree_' + select).jstree('rename_node', "" + node + "", "" + name + ":" + value + "");
    }
    modify(select);
  }

  function modify(select) {
    if (select == "advance") {
      jsonData.advance = {};
      var i = 0;
      for (var key in $('#jstree_advance').jstree()._model.data) {
        if (!$('#jstree_advance').jstree()._model.data.hasOwnProperty(key)) continue;
        var obj = $('#jstree_advance').jstree()._model.data[key];
        if (obj["parent"] == "#" && obj["id"] != "create") {
          var children = {};
          var split = obj["text"].split(":");
          if (split[1] != undefined) {
            var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}');
            $.extend(children, add)
          } else {
            var parent = obj["id"];
            children["" + parent + ""] = {};
            for (var key in $('#jstree_advance').jstree()._model.data) {
              var child = $('#jstree_advance').jstree()._model.data[key];
              if (child["parent"] == parent) {
                var split = child["text"].split(":");
                if (split[1] != undefined) {
                  if (isNaN(split[1])) {
                    var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}')
                  } else {
                    var add = JSON.parse('{"' + split[0] + '":' + split[1] + '}')
                  }
                  $.extend(children["" + parent + ""], add)
                }
              }
            }
          }
          $.extend(jsonData.advance, children)
        }
      }
    } else if (select == "filter") {
      jsonData.filter = [];
      var i = 0;
      for (var key in $('#jstree_filter').jstree()._model.data) {
        if (!$('#jstree_filter').jstree()._model.data.hasOwnProperty(key)) continue;
        var obj = $('#jstree_filter').jstree()._model.data[key];
        if (obj["parent"] == "#") {
          var parent = obj["id"];
          var children = {};
          children.value = [];
          for (var key in $('#jstree_filter').jstree()._model.data) {
            var child = $('#jstree_filter').jstree()._model.data[key];
            if (child["parent"] == parent) {
              var split = child["text"].split(":");
              if (child["text"] == "value") {} else if (isNaN(split[1])) {
                var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}')
              } else {
                var add = JSON.parse('{"' + split[0] + '":' + split[1] + '}')
              }
              $.extend(children, add)
            } else if (child["parent"] == parent + "_value") {
              children.value.push(child["text"])
            }
          }
          jsonData.filter.push(children)
        }
      }
    } else if (select == "key") {
      jsonData.key = [];
      var i = 0;
      for (var key in $('#jstree_key').jstree()._model.data) {
        if (!$('#jstree_key').jstree()._model.data.hasOwnProperty(key)) continue;
        var obj = $('#jstree_key').jstree()._model.data[key];
        if (obj["parent"] == "#") {
          var parent = obj["id"];
          var children = {};
          for (var key in $('#jstree_key').jstree()._model.data) {
            var child = $('#jstree_key').jstree()._model.data[key];
            if (child["parent"] == parent) {
              var split = child["text"].split(":");
              if (child["text"] == "value") {} else if (isNaN(split[1])) {
                var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}')
              } else {
                var add = JSON.parse('{"' + split[0] + '":' + split[1] + '}')
              }
              $.extend(children, add)
            } else if (child["parent"] == parent + "_6") {
              var add = JSON.parse('{"value":[]}');
              add["value"].push(child["text"]);
              $.extend(children, add)
            }
          }
          jsonData.key.push(children)
        }
      }
    } else if (select == "field") {
      jsonData.field = [];
      var i = 0;
      for (var key in $('#jstree_field').jstree()._model.data) {
        if (!$('#jstree_field').jstree()._model.data.hasOwnProperty(key)) continue;
        var obj = $('#jstree_field').jstree()._model.data[key];
        if (obj["parent"] == "#") {
          var parent = obj["id"];
          var children = {};
          for (var key in $('#jstree_field').jstree()._model.data) {
            var child = $('#jstree_field').jstree()._model.data[key];
            if (child["parent"] == parent) {
              var split = child["text"].split(":");
              if (child["text"] == "value") {} else if (isNaN(split[1])) {
                var add = JSON.parse('{"' + split[0] + '":"' + split[1] + '"}')
              } else {
                var add = JSON.parse('{"' + split[0] + '":' + split[1] + '}')
              }
              $.extend(children, add)
            } else if (child["parent"] == parent + "_6") {
              var add = JSON.parse('{"value":[]}');
              add["value"].push(child["text"]);
              $.extend(children, add)
            }
          }
          jsonData.field.push(children)
        }
      }
    }
  }

  function update_report() {
    for (var key in general){
      var getValue = document.getElementById("chart_param_"+general[key].toLowerCase()).value;
      if (getValue != "") {
        report[general[key].toLowerCase()] = getValue;
      } else {
        report[general[key].toLowerCase()] = "null";
      }
    }
    report.visualization = document.getElementById("chart_visualization").options[document.getElementById("chart_visualization").options.selectedIndex].text;
    report.selection_flag = document.getElementById("chart_selection_flag").value;
    report.sorted = document.getElementById("chart_sorted").value;
    report.sorted_method = document.getElementById("chart_sorted_method").value;
    report.max_display = document.getElementById("chart_max_display").value;
    report.dblclick = document.getElementById("chart_dblclick").value;
    report.size = document.getElementById("chart_size").value;
    report.options = jsonData.advance;
    report.filter = jsonData.filter;
    report.key = jsonData.key;
    report.field = jsonData.field;
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
    return valid;
  }

  function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
  }

  function Rese() {
    alert("reset (in resultframe)");
  }
</script>

<?
$js = <<<js
    //  $('#re').on('click', function () { 
    //         var data = update_report();
    //     console.info(data);
    //     console.log(data);
    //   }) 
      function Reset() 
        {
            alert("reset (in resultframe)");
        } 
     $(".submitForm").submit(function(event) {
        console.log ('bisa1');
                        
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
       
        var data = update_report();
        console.info(data);
        var url = $(this).attr('action');
        console.info('action:'+ url+ " "+data);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.info( response );
                //alert(response.data.message); 
                // $(".modal.in").modal('hide');
                location.reload();
                //$.pjax.reload({container: '#id_pjax_id', async: false});
            } else {
                alert(response.data.message);
            }

        })
        .fail(function(response) {
            console.info( response )
            alert("fail");

        });
        return false;

    });
  
js;
$this->registerJs($js);
?>