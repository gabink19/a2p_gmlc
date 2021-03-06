<?

use yii\helpers\Json;
?>



<figure class="highcharts-figure">
    <div id="container<?= $id ?>"></div>

    <p id="<?= $id ?>_param2" style="display:none;position: absolute;left:10px;top:40px" class="value_select_style box_select"></p>

</figure>





<style>
    .box_select {
        position: absolute;
        border-style: solid;
        border-radius: 5px;
        width: 140px;
        height: auto;
        border-width: thin;
        background-color: rgba(0,255,0,0.9);
        border-color: green;
    }
    .value_select_style {

        font-size: 10px;
        position: absolute;
        left: 5px;
        top: 0px;
    }
    .highcharts-figure, .highcharts-data-table table {
        min-width: 150px; 
        max-width: 660px;
        margin: 0px auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

<script>




    function cmhighcharts<?= $id ?>_hide(data, report, graph_idx, graphData) {
        document.getElementById('container<?= $id ?>').style.display = "none";





    }
    
    function cmhighcharts<?= $id ?>(data, report, graph_idx, graphData) {
        document.getElementById('container<?= $id ?>').style.display = "block";
        option = <?= Json::encode($options) ?>;
        chart = option["chart"];

        if (report.size <= 2) {
            option["exporting"] = {enabled: false};
            chart = option["chart"];
            option["chart"].height = "100%";
            option["chart"] = chart;

            xAxis = option["xAxis"];
            if (xAxis == null) {
                xAxis = {
                    visible: false
                };

            } else {

                xAxis["visible"] = false;

            }
            option["xAxis"] = xAxis;

            legend = option["legend"];
            if (legend == null) {
                legend = {
                    enabled: false
                };

            } else {

                legend["enabled"] = false;

            }
            option["legend"] = legend;


        }
        ;

        if (chart["type"] === "treemap" || chart["type2"] == "1") {
            array_series = option["series"];
            if (array_series==null){
                array_series=[];
                series={};
                array_series.push(series);
            } else if (array_series.length==0){
                series={};
                array_series.push(series);
            } else {
                series=array_series[0];
            }
            
            data_series = [];
            first_sub_data = data[0];

            for (let i2 = 1; i2 < data.length; i2++) {
                sub_data = data[i2];
                /*
                 detail_data = {
                 name:sub_data[3],
                 y:sub_data[1],
                 color:sub_data[2]
                 
                 };*/
                detail_data = {};
                for (let i3 = 0; i3 < sub_data.length; i3++) {
                    detail_data[first_sub_data[i3]] = sub_data[i3];
                }

                data_series.push(detail_data);

                console.log("[CMHighCharts 2 " + sub_data[0] + " " + sub_data[1]);

            }


            /*

            if (chart["type"] === "treemap") {

                series = {
                    type: 'treemap',
                    layoutAlgorithm: 'squarified',
                    data: data_series
                };
            } else {
                series = {

                    data: data_series
                };
            }*/
            series["data"]=data_series;
            
            option["series"]=array_series;
            
            option["plotOptions"]["series"] = {
                allowPointSelect: true,
                point: {
                    events: {

                        select: function () {


                            if (graphData[graph_idx].selection_flag == 1) {
                                if (this.hasOwnProperty('key')) {
                                    value_chart = [this.key];

                                } else {
                                    value_chart = [this.name];

                                }
                                singleClick(report,graph_idx, value_chart);







                            }


                        }
                    }
                }
            }
            console.log("[" + graph_idx + ":CMHighCharts]option:", option);

        } else if (chart == null || chart["type"] === "line" || chart["type"] === "spline" || chart["type"] === "column") {
            /*
             if (report.data_3d == 1) {
             array_series_detail = [];
             array_series = [];
             array_xAxis = [];
             key = data[0];
             
             first_subdata = data[0];
             xColumn = first_subdata[0];
             datetime_flag = false;
             key1 = report.key[0].data_type;
             if ((key1 == "datetime") || (key1 == "5n") || (key1 == "15n") || (key1 == "30n") || (key1 == "1h") || (key1 == "date")) {
             //   (typeof xColumn === 'object')
             
             datetime_flag = true;
             //console.log("[CMHighCharts datetime_flag:"+datetime_flag);
             }
             subdata_len = first_subdata.length;
             for (let i3 = 1; i3 < subdata_len; i3++) {
             array_series_detail[i3 - 1] = [];
             }
             for (let i2 = 1; i2 < data.length; i2++) {
             subdata = data[i2];
             
             for (let i3 = 1; i3 < subdata_len; i3++) {
             if (datetime_flag) {
             array_series_detail[i3 - 1].push([new Date(subdata[0]).getTime(), subdata[i3]]);
             } else {
             array_series_detail[i3 - 1].push([subdata[0], subdata[i3]]);
             }
             }
             }
             for (let i3 = 1; i3 < subdata_len; i3++) {
             array_series.push({
             name: first_subdata[i3],
             data: array_series_detail[i3 - 1]
             })
             }
             //console.log("[CMHighCharts 1 "+JSON.stringify(array_xAxis));
             console.log("[" + graph_idx + ":CMHighCharts]", array_series_detail);
             //console.log("[CMHighCharts 3 "+JSON.stringify(array_series));
             option["series"] = array_series;
             console.log("[" + graph_idx + ":CMHighCharts]axis1:", array_series);
             
             if (datetime_flag) {
             xAxis = option["xAxis"];
             
             if (xAxis != null) {
             xAxis.label = {enabled: false};
             xAxis.type = 'datetime';
             xAxis.dateTimeLabelFormat = {
             day: '%e-%b-%Y',
             week: '%e-%b-%Y',
             month: '%b \'%Y',
             year: '%Y'
             };
             option["xAxis"] = xAxis;
             
             
             } else {
             
             option["xAxis"] = {
             label: {enabled: false},
             type: 'datetime',
             dateTimeLabelFormats: {
             day: '%e-%b-%Y',
             week: '%e-%b-%Y',
             month: '%b \'%Y',
             year: '%Y'
             },
             
             };
             
             }
             } else {
             
             }
             
             option["plotOptions"]["series"] = {
             allowPointSelect: true,
             point: {
             events: {
             select: function () {
             
             if (graphData[graph_idx].selection_flag == 1) {
             console.log("[" + graph_idx + ":CMHighCharts " + this.x + " " + this.series.name + ': ' + this.y + ' //' + this.category + ' ' + this.name);
             data_label = "<b>filter:</b><br>";
             selected_value = "";
             value_chart = [this.x,this.series.name];
             for (let i2 = 0; i2 < report.key.length; i2++) {
             data_type = report.key[i2].data_type;
             if (selected_value != "") {
             selected_value = selected_value + "{B4t45}";
             }
             
             if ((data_type == "datetime") || (data_type == "5n") || (data_type == "15n") || (data_type == "30n") || (data_type == "1h") || (data_type == "date")) {
             
             var_d = new Date(value_chart[i2]);
             data_label = data_label + var_d + "-";
             
             selected_value = selected_value + var_d;
             } else {
             data_label = data_label + value_chart[i2] + "-";
             selected_value = selected_value + value_chart[i2];
             }
             }
             
             console.log("[" + graph_idx + ":CMHighCharts selected_value:" + selected_value);
             
             document.getElementById("<?= $id ?>_param2").style.display = "block";
             document.getElementById("<?= $id ?>_param2").innerHTML = data_label;
             //selected_value=this.series.name+"{B4t45}" +this.name
             graphData[graph_idx].selected_value = selected_value;
             setTimeout(function () {
             execSelect();
             }, 1000);
             }
             
             }
             }
             }
             }
             
             } else {*/
            array_series2 = [];
            first_flag = 1;
            datetime_flag = false;

            for (let i2 = 1; i2 < data.length; i2++) {

                detail = data[i2];
                if (first_flag == 1) {
                    key1 = report.key[detail.length - 2].data_type;
                    if ((key1 == "datetime") || (key1 == "5n") || (key1 == "15n") || (key1 == "30n") || (key1 == "1h") || (key1 == "date")) {
                        datetime_flag = true;
                    }
                    first_flag = 1;
                }
                key = "";
                for (let i3 = 0; i3 < detail.length - 2; i3++) {
                    if (key != "")
                        key = key + " ";
                    key = key + detail[i3];

                }
                res = array_series2[key];
                if (res == null) {
                    res = [];
                    array_series2[key] = res;
                }

                if (datetime_flag) {


                    res.push([new Date(detail[detail.length - 2]).getTime(), detail[detail.length - 1]]);


                } else {
                    res.push([detail[detail.length - 2], detail[detail.length - 1 ]]);
                }

            }
            console.log("[" + graph_idx + ":CMHighCharts]axis1:", array_series2);
            array_series = [];
            for (var key in array_series2) {

                array_series.push({name: key, data: array_series2[key]});
            }
            option["series"] = array_series;
            console.log("[" + graph_idx + ":CMHighCharts]axis1:", array_series);

            if (datetime_flag) {
                xAxis = option["xAxis"];

                if (xAxis != null) {
                    xAxis.label = {enabled: false};
                    xAxis.type = 'datetime';
                    xAxis.dateTimeLabelFormat = {
                        day: '%e-%b-%Y',
                        week: '%e-%b-%Y',
                        month: '%b \'%Y',
                        year: '%Y'
                    };
                    option["xAxis"] = xAxis;


                } else {

                    option["xAxis"] = {
                        label: {enabled: false},
                        type: 'datetime',
                        dateTimeLabelFormats: {
                            day: '%e-%b-%Y',
                            week: '%e-%b-%Y',
                            month: '%b \'%Y',
                            year: '%Y'
                        },

                    };

                }
            } else {

            }

            option["plotOptions"]["series"] = {
                allowPointSelect: true,
                point: {
                    events: {
                        select: function () {

                            if (graphData[graph_idx].selection_flag == 1) {
                                console.log("[" + graph_idx + ":CMHighCharts " + this.x + " " + this.series.name + ': ' + this.y + ' //' + this.category + ' ' + this.name);
                                singleClick(report,graph_idx, [this.series.name, this.x]);
                                /*
                                res = BuildKey(report, value_chart, 2);
                                console.log("[" + graph_idx + ":SELECT] chart:select " + graphData[graph_idx].selected_value + " " + res.search_key + " idx:" + graphData[graph_idx].idx);
                                graphData[graph_idx].selected_value = res.search_key;
                                p_obj = document.getElementById("<?= $id ?>_param2");
                                if (p_obj != null) {
                                    p_obj.style.display = "block";
                                    p_obj.innerHTML = "<b>filter:</b><br>" + res.search_key.replace("{B4t45}", "-");
                                }*/
                                /*
                                 for (let i2 = 0; i2 < report.key.length; i2++) {
                                 data_type = report.key[i2].data_type;
                                 if (selected_value != "") {
                                 selected_value = selected_value + "{B4t45}";
                                 }
                                 
                                 if ((data_type == "datetime") || (data_type == "5n") || (data_type == "15n") || (data_type == "30n") || (data_type == "1h") || (data_type == "date")) {
                                 
                                 var_d = new Date(value_chart[i2]);
                                 data_label = data_label + var_d + "-";
                                 
                                 selected_value = selected_value + var_d;
                                 } else {
                                 data_label = data_label + value_chart[i2] + "-";
                                 selected_value = selected_value + value_chart[i2];
                                 }
                                 }
                                 console.log("[" + graph_idx + ":CMHighCharts selected_value:" + selected_value);
                                 document.getElementById("<?= $id ?>_param2").style.display = "block";
                                 document.getElementById("<?= $id ?>_param2").innerHTML = data_label;
                                 //selected_value=this.series.name+"{B4t45}" +this.name
                                 graphData[graph_idx].selected_value = selected_value;
                                 */

                                 /*
                                setTimeout(function () {
                                    execSelect();
                                }, 1000);*/
                            }

                        }
                    }
                }
            }



            //}


        } else {
            array_series = [];
            data_series = [];
            var colorFlag = 0;
            var field_count = 0;
            if (data.length > 0) {
                field_count = data[0].length;
                if (field_count >= 3) {
                    if (data[0][2] == "color") {
                        colorFlag = 1;
                    }
                }
            }
            if (colorFlag == 0 && field_count >= 3) {

                count_rec = 0;
                last_data = "";

                drilldown_series = [];
                last_drilldown_data = [];

                for (let i2 = 1; i2 < data.length; i2++) {
                    sub_data = data[i2];
                    if (last_data != sub_data[0]) {
                        if (last_data != "") {
                            data_series.push({
                                name: last_data,
                                y: count_rec,
                                drilldown: last_data

                            });

                            drilldown_series.push({
                                name: last_data,
                                id: last_data,
                                data: last_drilldown_data
                            });
                            console.log("[CMHighCharts " + last_data + " " + count_rec);
                        }
                        last_data = sub_data[0];
                        count_rec = 0;
                        last_drilldown_data = [];
                    }
                    count_rec = count_rec + sub_data[2];
                    last_drilldown_data.push([sub_data[1], sub_data[2]]);


                }
                if (last_data != "") {
                    data_series.push({
                        name: last_data,
                        y: count_rec,
                        drilldown: last_data

                    });
                    drilldown_series.push({
                        name: last_data,
                        id: last_data,
                        data: last_drilldown_data
                    });
                    //console.log("[CMHighCharts "+last_data+" "+count_rec);
                }
                obj = {
                    series: drilldown_series};
                //console.log("[CMHighCharts "+JSON.stringify(obj));
                option["drilldown"] = obj;
            } else {

                for (let i2 = 1; i2 < data.length; i2++) {
                    sub_data = data[i2];
                    if (colorFlag == 1) {
                        data_series.push({
                            name: sub_data[0],
                            y: sub_data[1],
                            color: sub_data[2]

                        });
                    } else {
                        data_series.push({
                            name: sub_data[0],
                            y: sub_data[1],

                        });
                    }

                    console.log("[CMHighCharts 2 " + sub_data[0] + " " + sub_data[1]);

                }

            }




            series = {
                name: "Browsers",
                colorByPoint: true,
                data: data_series
            };
            array_series.push(series);
            option["series"] = array_series;
            option["plotOptions"]["series"] = {
                allowPointSelect: true,
                point: {
                    events: {
                        select: function () {
                            
                            if (field_count >= 3) {
                                singleClick(report,graph_idx, [this.series.name, this.name]);
                             } else {
                                 singleClick(report,graph_idx, [this.name]);
                             }
                             /*
                            if (field_count >= 3) {
                                graphData[graph_idx].selected_value = this.series.name + "{B4t45}" + this.name;
                                data_label = "<b>filter:</b><br>" + this.series.name + "-" + this.name;
                            } else {
                                graphData[graph_idx].selected_value = this.name;
                                data_label = "<b>filter:</b><br>" + this.name;
                            }

                            document.getElementById("<?= $id ?>_param2").style.display = "block";
                            document.getElementById("<?= $id ?>_param2").innerHTML = data_label;
                            console.log("[cmhighcharts " + graph_idx + this.series.name + " " + this.name + " " + this.y + ' //' + this.category + ' ' + this.x + " ");
                            setTimeout(function () {
                                execSelect();
                            }, 1000);*/

                        }
                    }
                }
            }
            console.log("[" + graph_idx + ":CMHighCharts]option:", option);
        }







        return new Highcharts.chart('container<?= $id ?>', option);
    }

    document.getElementById("<?= $id ?>_param2").addEventListener("click", function () {

        console.log("[<?= $id ?>:SELECT] select* click");
        document.getElementById("<?= $id ?>_param2").style.display = "none";
        graphData[<?= $idx ?>].selected_value = null;
        setTimeout(function () {
            execSelect();

        }, 1000);


    });

</script>


