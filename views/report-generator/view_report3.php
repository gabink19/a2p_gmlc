<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<div>
    <p>List of columns:</p>
</div>        

<div id="jstree_demo_div" class="col-md-6" style="border-right: 1px solid silver;">
    <p>Loading</p>
</div>
<div id="data" class="col-md-6" style="height: 430px;">
    <div class="content code" style="display: none; height: 430px;"><textarea id="code" readonly="readonly"></textarea></div>
    <div class="content folder" style="display: none; height: 430px;"></div>
    <div class="content image" style="display: none; position: relative; height: 430px;"><img src="" alt="" style="display:block; position:absolute; left:50%; top:50%; padding:0; max-height:90%; max-width:90%;"></div>
    <div class="content default" style="text-align: center; height: 430px; line-height: 430px; display: block;">Selected: </div>
</div>

<script type="text/javascript">
    $(window).load(function() {
        console.log("window load occurred!");

        jQuery.ajax({
            type: "GET",
            url: 'index.php?r=g-sensor-db%2Fget-data-report&schema=icloud&table_name=g_sensor_db&table_alias=1',
            statusCode: {
              500: function() {
                alert("Internal server error");
                done();
              }
            },
            success: function(response){
                var fullMenuList = [];

                for (var i = 0; i < response.data.length; i++) {
                    if (response.data[i].TYPE == 1) {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            text: response.data[i].TABLE_NAME+" (TYPE 1)"
                        });
                        if (typeof response.data[i].data !== 'undefined') {
                            for (var j = 0; j < response.data[i].data.length; j++) {
                                fullMenuList.push({
                                    id: i+"-"+j,
                                    parent: i,
                                    text: response.data[i].data[j].COLUMN_NAME
                                });
                                if (typeof response.data[i].data[j].data !== 'undefined') {
                                    for (var k = 0; k < response.data[i].data[j].data.length; k++) {
                                        fullMenuList.push({
                                            id: i+"-"+j+"-"+k,
                                            parent: i+"-"+j,
                                            text: response.data[i].data[j].data[k].COLUMN_NAME
                                        });
                                    }
                                }
                            }
                        }
                    } else if (response.data[i].TYPE == 2) {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            text: response.data[i].COLUMN_NAME+" (TYPE 2)"
                        });
                        if (typeof response.data[i].data !== 'undefined') {
                            for (var j = 0; j < response.data[i].data.length; j++) {
                                fullMenuList.push({
                                    id: i+"-"+j,
                                    parent: i,
                                    text: response.data[i].data[j].COLUMN_NAME
                                });
                                if (typeof response.data[i].data[j].data !== 'undefined') {
                                    for (var k = 0; k < response.data[i].data[j].data.length; k++) {
                                        fullMenuList.push({
                                            id: i+"-"+j+"-"+k,
                                            parent: i+"-"+j,
                                            text: response.data[i].data[j].data[k].COLUMN_NAME
                                        });
                                    }
                                }
                            }
                        }
                    } else {
                        fullMenuList.push({
                            id: i,
                            parent: "#",
                            text: response.data[i].COLUMN_NAME
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
                    }
                });
            }
        });
    });

 </script>