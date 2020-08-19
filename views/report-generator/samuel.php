<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 5px;
      text-align: left;    
    }
</style>
<div class="col-md-6" style="display: block; height: 550px;">
    <p>List of field:</p>

    <div id="jstree_demo_div" style="height: 500px; overflow: scroll;">
        <p>Loading</p>
    </div>
</div>        
<div id="data" class="col-md-6" style="display: block; height: 550px;">
    <div id="contentBox" style="display: block; height: 300px;">
    </div>
    <div style="display: inline-block;width: 100%;">
        <span style="float: left;">Selected field:</span>
        <span style="float: right; font-style: italic; font-size: small;">*press right click on a field to display remove option</span>
    </div>
    <div id="jstree_selected" style="height: 200px; overflow: scroll;">

    </div>
</div>

<div id="data" class="col-md-6" style="display: block;">
    <span style="width: 30%;display: inline-block;">Sort by: </span><select id="orderBy"></select><br>
    <span style="width: 30%;display: inline-block;">Select visualization: </span><select id="chart"><option value="PieChart">PieChart</option></select><br>
    <span style="width: 30%;display: inline-block;">Select Key: </span><select id="reportKey"></select><br>
    <span style="width: 30%;display: inline-block;">Select Field: </span><select id="reportField"></select><br>
    <br><button type="button" onclick="download()">Save JSON</button>
</div>

<script type="text/javascript">
    $('#jstree_selected').jstree({
        "core" : {
            "check_callback": true,
        },
        "plugins" : ["conditionalselect", "contextmenu", "unique"],
        "conditionalselect" : function (node, event) {
           console.log(node.original.text2);
        },
        "contextmenu":{         
            "items": function($node) {
                var tree = $("#jstree_selected").jstree(true);
                return {                    
                    "Remove": {
                        "separator_before": false,
                        "separator_after": false,
                        "label": "Remove",
                        "action": function (obj) { 
                            tree.delete_node($node);
                            modify();
                        }
                    }
                };
            }
        }
    });
    
    function addField(node,node2,node3) {
        $('#jstree_selected').jstree().create_node('#' ,  { 
            "id" : node, 
            "text" : node, 
            "icon" : "glyphicon glyphicon-leaf" ,
            "text2" : {"COLUMN_ID":node3, "COLUMN_NAME":node3, "ALIAS_NAME":node2, "COLUMN_COMMENT":""}
        }, "last");
        modify();
    };

    var jsonData = {
        data: [], 
        table_name: "g_sensor_db",
        column: [],
        limit: "1000",
        order_by: "",
        report: [{
            "name": "testing report2",
            "visualization": "PieChart",
            "packages": "corechart",
            "size": 4,
            "selection_flag": 1,
            "data_option": 1,
            "sorted": 1,
            "sorted_method": 0,
            "max_display": 0,
            "dblclick": "report2",
            "options": {
                "title": "REPORT PERTAMA PIE 1",
                "chartArea": {
                  "width": "80%",
                  "height": "60%"
                },
                "curveType": "function",
                "legend": {
                  "position": "bottom"
                },
                "width": "100%",
                "height": "100%"
            },
            "key": [{
              "name": "test",
              "field_no": 0
            }],
            "field": [{
              "name": "test",
              "field_no": 0,
              "data_type": "int"
            }],
            "filter2": [{
            }]
        }], 
        report2: [],
        report4: []
    };
    var start;

    //ambil json dari field selected
    function modify() {
        jsonData.column = [];
        $("#reportKey, #reportField, #orderBy").empty();
        var i = 0;
        for (var key in $('#jstree_selected').jstree()._model.data) {
            // skip loop if the property is from prototype
            if (!$('#jstree_selected').jstree()._model.data.hasOwnProperty(key)) continue;

            var obj = $('#jstree_selected').jstree()._model.data[key];
            
            for (var key in obj) {
                // skip loop if the property is from prototype
                if (!obj.hasOwnProperty(key)) continue;
                if (key == "original") {
                    $("#reportKey, #reportField").append("<option value=\""+i+"\">"+obj["original"].text+"</option>");
                    $("#orderBy").append("<option value=\""+obj["original"].text2.ALIAS_NAME+"\">"+obj["original"].text+"</option>");
                    i++;
                    var obj2 = {
                      COLUMN_INDEX: i
                    };
                    $.extend( obj["original"].text2, obj2 );
                    jsonData.column.push(obj["original"].text2);
                }
            }
        }
    }


    function download() {
        jsonData.order_by = $("#orderBy").val();
        jsonData.report[0].key[0].field_no = parseInt($("#reportKey").val());
        jsonData.report[0].field[0].field_no = parseInt($("#reportField").val());

        text = JSON.stringify(jsonData);
        var pom = document.createElement('a');
        pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        pom.setAttribute('download', 'test.json');

        if (document.createEvent) {
            var event = document.createEvent('MouseEvents');
            event.initEvent('click', true, true);
            pom.dispatchEvent(event);
        }
        else {
            pom.click();
        }
    }

    $(window).load(function() {
        console.log("window load occurred!");

        jQuery.ajax({
            type: "GET",
            url: 'index.php?r=report-generator%2Fget-data-report&schema=icloud&table_name=g_sensor_db&table_alias=1',
            statusCode: {
              500: function() {
                alert("Internal server error");
                done();
              }
            },
            success: function(response){
                jsonData.data = response.data;
                console.log(jsonData);
                console.log("^json");
                var fullMenuList = [];

                for (var i = 0; i < response.data.length; i++) {
                    if (response.data[i].TYPE == 1) {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            icon: "//jstree.com/tree.png",
                            text: response.data[i].TABLE_NAME+" (TYPE 1)"
                        });
                        if (typeof response.data[i].data !== 'undefined') {
                            for (var j = 0; j < response.data[i].data.length; j++) {
                                if (response.data[i].data[j].TYPE == 3) {
                                    fullMenuList.push({
                                        id: i+"-"+j,
                                        parent: i,
                                        icon: "glyphicon glyphicon-leaf",   
                                        text: response.data[i].data[j].COLUMN_NAME,
                                        text2: response.data[i].data[j],
                                    });
                                } else {
                                    fullMenuList.push({
                                        id: i+"-"+j,
                                        parent: i,
                                        icon: "//jstree.com/tree.png",
                                        text: response.data[i].data[j].COLUMN_NAME
                                    });
                                    if (typeof response.data[i].data[j].data !== 'undefined') {
                                        for (var k = 0; k < response.data[i].data[j].data.length; k++) {
                                            fullMenuList.push({
                                                id: i+"-"+j+"-"+k,
                                                parent: i+"-"+j,
                                                icon: "glyphicon glyphicon-leaf",   
                                                text: response.data[i].data[j].data[k].COLUMN_NAME,
                                                text2: response.data[i].data[j].data[k],
                                            });
                                        }
                                    }
                                }
                            }
                        }
                    } else if (response.data[i].TYPE == 2) {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            icon: "//jstree.com/tree.png",
                            text: response.data[i].COLUMN_NAME+" (TYPE 2)"
                        });
                        if (typeof response.data[i].data !== 'undefined') {
                            for (var j = 0; j < response.data[i].data.length; j++) {
                                if (response.data[i].data[j].TYPE == 3) {
                                    fullMenuList.push({
                                        id: i+"-"+j,
                                        parent: i,
                                        icon: "glyphicon glyphicon-leaf",   
                                        text: response.data[i].data[j].COLUMN_NAME,
                                        text2: response.data[i].data[j],
                                    });
                                } else {
                                    fullMenuList.push({
                                        id: i+"-"+j,
                                        parent: i,
                                        icon: "//jstree.com/tree.png",
                                        text: response.data[i].data[j].COLUMN_NAME
                                    });
                                    if (typeof response.data[i].data[j].data !== 'undefined') {
                                        for (var k = 0; k < response.data[i].data[j].data.length; k++) {
                                            fullMenuList.push({
                                                id: i+"-"+j+"-"+k,
                                                parent: i+"-"+j,
                                                icon: "glyphicon glyphicon-leaf",   
                                                text: response.data[i].data[j].data[k].COLUMN_NAME,
                                                text2: response.data[i].data[j].data[k],
                                            });
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            icon: "glyphicon glyphicon-leaf",   
                            text: response.data[i].COLUMN_NAME,
                            text2: response.data[i],
                        });
                    }
                }

                console.log(fullMenuList);
                $.noConflict()
                $('#jstree_demo_div').jstree({
                    'core' : {
                        'data' : fullMenuList
                            // 'url' : 'jstree/demo/basic/root.json',
                            // 'url' : 'index.php?r=g-sensor-db%2Fget-data-report&schema=icloud&table_name=g_sensor_db&table_alias=1',
                    },
                    'conditionalselect' : function (node, event) {
                       document.getElementById("contentBox").innerHTML = ""; 
                       document.getElementById("contentBox").innerHTML = "<table id=\"tableBox\" style=\"width: 100%;\"></table>";
                       $.each(node.original.text2, function( key, value ) {
                            document.getElementById("tableBox").innerHTML += "<tr><th>"+key+"</th><td>"+value+"</td></tr>"; 
                        });
                       if (typeof node.original.text2 !== "undefined") {
                            document.getElementById("contentBox").innerHTML += "<button type='button' onclick=\"addField(\'"+node.original.text+"\',\'"+node.original.text2.ALIAS_NAME+"\',\'"+node.original.text2.COLUMN_ID+"\')\">Add</button>";
                       }
                    },
                    'plugins' : [ "conditionalselect" ]
                });
            }
        });
    
    });

 </script>