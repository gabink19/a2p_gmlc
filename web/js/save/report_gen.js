

function loadReport(response_data, report, idx) {
    console.log("[" + idx + ":load_report]" + report.name);
    /*
     var response_data = [], temp_data = [];
     temp_data.push({"type": "datetime", "label": "datetime"});
     //temp_data.push("test");
     temp_data.push("temp");
     response_data.push(temp_data);
     temp_data = []
     temp_data.push("Date(2019,10,11,8,13,06)");
     temp_data.push(18);
     response_data.push(temp_data);
     temp_data = []
     temp_data.push("Date(2019,10,11,8,14,06)");
     temp_data.push(1);
     response_data.push(temp_data);
     temp_data = []
     temp_data.push("Date(2019,10,11,8,15,06)");
     temp_data.push(12);
     response_data.push(temp_data);
     temp_data = []
     temp_data.push("Date(2019,10,11,8,16,06)");
     temp_data.push(10);
     response_data.push(temp_data);*/

    //convert data to map
    var map_data = new Map();
    var rec_pertama = [];
    var temp_data = response_data[0];
    //graphData[idx].selection=[];
    colum_idx = 0;
    for (let i2 = 0; i2 < report.key.length; i2++) {
        /*sel_rec={};
         sel_rec.selection_idx = report.key[0].field_no;
         sel_rec.selection_data_type = report.key[0].data_type;
         graphData[idx].selection.push(sel_rec);*/
        let idx4 = report.key[i2].field_no;
        label_param = report.key[i2].name;
        if (label_param == null) {
            label_param = temp_data[idx4];
        }
        //update type

        if (report.key[i2].data_type == "date") {
            rec_pertama.push({"type": "date", "label": label_param});
        } else if (report.key[i2].data_type == "datetime") {
            rec_pertama.push({"type": "datetime", "label": label_param});
        } else if (report.key[i2].data_type == "timeofday") {
            rec_pertama.push({"type": "time", "label": label_param});
        } else {
            rec_pertama.push(label_param);
        }
        colum_idx++;
    }
    for (let i2 = 0; i2 < report.field.length; i2++) {
        let idx4 = report.field[i2].field_no;
        label_param = report.field[i2].name;
        if (label_param == null) {
            label_param = temp_data[idx4];
        }
        rec_pertama.push(label_param);

    }
    var result_data = [];
    for (let i = 1; i < response_data.length; i++) {
        temp_data = response_data[i];
        var iqnore = false;

        if (report.filter != null) {
            ignore = false;
            for (let i3 = 0; i3 < report.filter.length; i3++) {
                let idx2 = report.filter[i3].field_no;
                key_val = temp_data[idx2];
                data_type = report.filter[i3].data_type;
                //save record
                res2 = BuildKeyChild(0, data_type, key_val);
                if (report.filter[i3].operation_type == 1) {
                    res_bool = false;
                    for (let i4 = 0; i4 < report.filter[i3].value.length; i4++) {
                        res_bool = res_bool | res2.key_val_str == report.filter[i3].value[i4];
                    }
                    ;
                    if (res_bool) {
                        console.log("[" + idx + ":filter match " + res2.key_val_str + " " + report.filter[i3].value)

                    } else {
                        console.log("[" + idx + ":filter not match " + res2.key_val_str + " " + report.filter[i3].value);
                        iqnore = true;
                        break;
                    }
                } else if (report.filter[i3].operation_type == 0) {
                    res_bool = true;
                    for (let i4 = 0; i4 < report.filter[i3].value.length; i4++) {
                        res_bool = res_bool & res2.key_val_str != report.filter[i3].value[i4];
                    }
                    if (res_bool) {
                        console.log("[" + idx + ":filter match " + res2.key_val_str + " " + report.filter[i3].value)

                    } else {
                        console.log("[" + idx + ":filter not match " + res2.key_val_str + " " + report.filter[i3].value);
                        iqnore = true;
                        break;
                    }
                }


            }
        }
        if (iqnore)
            continue;


        iqnore = false;
        for (let i3 = 0; i3 < graphData.length; i3++) {
            if (i3 != idx) {
                rep = save_response.report[i3];
                if (graphData[i3].selected_value != null) {

                    res = BuildKey(rep, temp_data);
                    /*
                     for (let i2 = 0; i2 < rep.key.length; i2++) {
                     let idx2 = rep.key[i2].field_no;
                     key_val = temp_data[idx2];
                     key_val_str = key_val;
                     data_type = rep.key[i2].data_type;
                     //save record
                     if (data_type == "date") {
                     let dt = new Date(key_val);
                     key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate());
                     key_val_str = key_val.toString();
                     //key_val_str=key_val;
                     } else if (data_type == "time") {
                     let dt = new Date(key_val);
                     key_val = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
                     key_val_str = JSON.stringify(key_val);
                     //key_val_str=key_val;
                     } else if (data_type == "datetime") {
                     let dt = new Date(key_val);
                     key_val = dt;
                     key_val_str = key_val.toString();
                     
                     } else if (rep.key[i2].data_type == "float") {
                     key_val = parseFloat(key_val);
                     }
                     if (temp_colum_idx == 0) {
                     search_key = key_val_str;
                     } else {
                     search_key = search_key + "{B4t45}" + key_val_str;
                     }
                     temp_colum_idx++;
                     
                     
                     }*/

                    if (res.search_key != graphData[i3].selected_value) {
                        console.log("[" + idx + ":match " + res.search_key + " " + graphData[i3].selected_value)
                        iqnore = true;
                        break;
                    } else {
                        console.log("[" + idx + ":not match " + res.search_key + " " + graphData[i3].selected_value);
                    }
                    ///console.log("select " + graphData[i].selection_idx + " " + graphData[i].selected_value);
                }
            }
        }
        if (iqnore)
            continue;
        temp_colum_idx = 0;
        temp_rec2 = [];
        res = BuildKey(report, temp_data);
        /*
         
         for (let i2 = 0; i2 < report.key.length; i2++) {
         let idx2 = report.key[i2].field_no;
         key_val = temp_data[idx2];
         key_val_str = key_val;
         data_type = report.key[i2].data_type;
         //save record
         if (data_type == "date") {
         let dt = new Date(key_val);
         key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate());
         key_val_str = key_val.toString();
         //key_val_str=key_val;
         } else if (data_type == "time") {
         let dt = new Date(key_val);
         key_val = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
         key_val_str = JSON.stringify(key_val);
         //key_val_str=key_val;
         } else if (data_type == "datetime") {
         let dt = new Date(key_val);
         key_val_str = key_val.toString();
         key_val = dt;
         } else if (data_type == "float") {
         key_val = parseFloat(key_val);
         }
         if (temp_colum_idx == 0) {
         search_key = key_val_str;
         } else {
         search_key = search_key + "{B4t45}" + key_val_str;
         }
         temp_colum_idx++;
         temp_rec2.push(key_val);
         
         }*/

        var temp_rec = map_data.get(res.search_key);
        if (temp_rec == null) {
            console.log("[" + idx + ":load_report] new column " + res.search_key + " " + colum_idx);
            temp_rec = res.temp_rec2;

            for (let i2 = 0; i2 < report.field.length; i2++) {

                let idx5 = report.field[i2].field_no;
                val_data = temp_data[idx5];
                rec_detail = BuildNewParameter(report, i2, val_data);
                temp_rec.push(rec_detail);
            }
            map_data.set(res.search_key, temp_rec);

        } else {


            for (let i2 = 0; i2 < report.field.length; i2++) {
                var rec_detail = temp_rec[i2 + colum_idx];
                let idx = report.field[i2].field_no;
                var var_value2 = temp_data[idx];
                BuildEditParameter(report, i2, var_value2, rec_detail);
                /*    
                 let idx = report.field[i2].field_no;
                 let detail_type = report.field[i2].data_type;
                 let detail_type2 = report.field[i2].data_type2;
                 if (detail_type == "float") {
                 if (detail_type2 != "first") {
                 $val = parseFloat(var_value2);
                 //rec_detail.value = rec_detail.value + $val;
                 rec_detail.value = $val;
                 
                 rec_detail.count = rec_detail.count + 1;
                 if (rec_detail.max_val < $val) {
                 rec_detail.max_val = $val;
                 }
                 if (rec_detail.min_val > $val) {
                 rec_detail.min_val = $val;
                 }
                 }
                 } else if (
                 (detail_type == "string") ||
                 (detail_type == "date") ||
                 (detail_type == "time") ||
                 (detail_type == "datetime")
                 ) {
                 rec_detail.value = var_value2;
                 } else {
                 if (detail_type2 != "first") {
                 $val = parseInt(var_value2);
                 rec_detail.value = rec_detail.value + $val;
                 rec_detail.count = rec_detail.count + 1;
                 if (rec_detail.max_val < $val) {
                 rec_detail.max_val = $val;
                 }
                 if (rec_detail.min_val > $val) {
                 rec_detail.min_val = $val;
                 }
                 }
                 }*/
            }



        }

        /*
         temp_rec = [];
         temp_rec.push(key_val);
         for (let i2 = 1; i2 < report.field.length; i2++) {
         let idx = report.field[i2].field_no;
         let detail_type = report.field[i2].type;
         if (detail_type == -2) {
         temp_rec.push(parseFloat(temp_data[idx]));
         } else {
         temp_rec.push(temp_data[idx]);
         
         }
         
         }
         result_data.push(temp_rec);*/


    }



    //result_data.push(rec_pertama);

    for (let [k, v] of map_data) {
        //console.log("[" + idx + ":load_report] value " + v);

        result_data_detail = CalculateParameter(report, colum_idx, v);
        result_data.push(result_data_detail);

    }


    if (report.data_3d) {
        var map_data = new Map();
        var map_data2 = new Map();
        idx5 = 0;
        param_name = [];
        for (let i3 = 0; i3 < result_data.length; i3++) {
            var_value_2 = result_data[i3][1];
            temp_rec = map_data.get(var_value_2);
            if (temp_rec == null) {
                param_name.push(var_value_2);
                temp_rec = {
                    value: var_value_2,
                    idx: idx5
                };
                map_data.set(var_value_2, temp_rec);
                idx5++;
            }
        }
        for (let i3 = 0; i3 < result_data.length; i3++) {
            result_detail2 = [];
            var_value = result_data[i3];
            var_value_1 = var_value[0];
            var_value_2 = var_value[1];
            temp_rec = map_data.get(var_value_2);
            if (temp_rec != null) {


                temp_rec2 = map_data2.get(var_value_1.toString());
                if (temp_rec2 == null) {
                    temp_rec2 = [];
                    temp_rec2.push(var_value_1);

                    for (let i4 = 0; i4 < idx5; i4++) {
                        if (temp_rec.idx == i4) {
                            temp_rec2.push(var_value[2]);
                        } else {
                            temp_rec2.push(0);

                        }
                    }
                    map_data2.set(var_value_1.toString(), temp_rec2)
                } else {
                    temp_rec2[temp_rec.idx + 1] = temp_rec2[temp_rec.idx + 1] + var_value[2];
                }

            }
        }
        result_data2 = [];
        for (let [k, v] of map_data2) {
            result_data2.push(v);
        }
        result_data = result_data2;
        rec_pertama2 = [];
        rec_pertama2.push(rec_pertama[0]);
        for (let i4 = 0; i4 < idx5; i4++) {
            rec_pertama2.push(param_name[i4]);

        }
        //rec_pertama2.push(rec_pertama[2]);
        rec_pertama = rec_pertama2;


    }
    ;

    sorted = 0;
    if (report.sorted > 0) {
        sorted = report.sorted;
    }
    result_data.sort(function (a, b) {
        if (report.sorted_method == 1) {
            if (a[sorted] > b[sorted]) {
                return 1;
            }
            if (b[sorted] > a[sorted]) {
                return -1;
            }
        } else {
            if (a[sorted] < b[sorted]) {
                return 1;
            }
            if (b[sorted] < a[sorted]) {
                return -1;
            }
        }
        return 0;
    });
    if (report.max_display > 0) {
        console.log("[" + idx + ":load_report] rearrange data");

        result_detail2 = [];
        result_data2 = [];
        for (let i3 = 0; i3 < result_data.length; i3++) {
            var_value = result_data[i3];
            if (i3 < report.max_display) {
                result_data2.push(var_value);
            } else if (i3 == report.max_display) {
                for (let i2 = 0; i2 < colum_idx; i2++) {
                    result_detail2.push("else");
                }
                //CalculateParameter1(report,colum_idx,var_value,result_detail2);
                for (let i2 = 0; i2 < report.field.length; i2++) {
                    var_value2 = var_value[i2 + colum_idx];
                    rec_detail = BuildNewParameter(report, i2, var_value2);
                    /*detail_type = report.field[i2].data_type;
                     detail_type2 = report.field[i2].data_type2;
                     var_value2 = var_value[i2 + colum_idx];
                     if (detail_type == "float") {
                     $val = parseFloat(var_value2);
                     var rec_detail = {
                     value: $val,
                     count: 1,
                     max_val: $val,
                     min_val: $val
                     }
                     } else if (
                     (detail_type == "string") ||
                     (detail_type == "date") ||
                     (detail_type == "time") ||
                     (detail_type == "datetime")
                     ) {
                     $val = var_value2;
                     var rec_detail = {
                     value: $val
                     }
                     } else {
                     $val = parseInt(var_value2);
                     var rec_detail = {
                     value: $val,
                     count: 1,
                     max_val: $val,
                     
                     min_val: $val
                     }
                     }*/
                    result_detail2.push(rec_detail);
                }
            } else {
                for (let i2 = 0; i2 < report.field.length; i2++) {
                    rec_detail = result_detail2[i2 + colum_idx]
                    var_value2 = var_value[i2 + colum_idx];
                    BuildEditParameter(report, i2, var_value2, rec_detail);
                    /*detail_type = report.field[i2].data_type;
                     detail_type2 = report.field[i2].data_type2;
                     
                     if (detail_type == "float") {
                     if (detail_type2 != "first") {
                     $val = parseFloat(var_value2);
                     //rec_detail.value = rec_detail.value + $val;
                     rec_detail.value = $val;
                     
                     rec_detail.count = rec_detail.count + 1;
                     if (rec_detail.max_val < $val) {
                     rec_detail.max_val = $val;
                     }
                     if (rec_detail.min_val > $val) {
                     rec_detail.min_val = $val;
                     }
                     }
                     } else if (
                     (detail_type == "string") ||
                     (detail_type == "date") ||
                     (detail_type == "time") ||
                     (detail_type == "datetime")
                     ) {
                     rec_detail.value = var_value2;
                     } else {
                     if (detail_type2 != "first") {
                     $val = parseInt(var_value2);
                     rec_detail.value = rec_detail.value + $val;
                     rec_detail.count = rec_detail.count + 1;
                     if (rec_detail.max_val < $val) {
                     rec_detail.max_val = $val;
                     }
                     if (rec_detail.min_val > $val) {
                     rec_detail.min_val = $val;
                     }
                     }
                     }*/

                }

            }

        }
        if (result_detail2.length > 0) {
            /*
             result_detail3 = [];
             for (let i2 = 0; i2 < report.key.length; i2++) {
             result_detail3.push("else");
             }
             for (let i2 = 0; i2 < result_detail2.length; i2++) {
             rec_detail = result_detail2[i2+colum_idx];
             detail_type = report.field[i2].data_type;
             detail_type2 = report.field[i2].data_type2;
             if ((detail_type == "int") ||
             (detail_type == "float")
             ) {
             if (detail_type2 == "avg") {
             result_detail3.push(rec_detail.value / rec_detail.count);
             } else if (detail_type2 == "max") {
             result_detail3.push(rec_detail.max_val);
             } else if (detail_type2 == "min") {
             result_detail3.push(rec_detail.min_val);
             } else {
             result_detail3.push(rec_detail.value);
             }
             } else {
             result_detail3.push(rec_detail.value);
             }
             
             }*/
            result_detail3 = CalculateParameter(report, colum_idx, result_detail2);
            result_data2.push(result_detail3);
        }
        console.log("[" + idx + ":load_report] rearrange data(done) : " + result_data2);
        result_data = result_data2;
    }
    ;

    result_data.unshift(rec_pertama);

    return result_data;
}

var graphData = [];



var initFlag = true;
var columns = [];
var series = {};
var options;
var chart_id = null;
var visualization = "Table";
var containerId = "";

var old_data = null;
var save_response = null;
var timeout = 10000;
var timeout_obj;


function drawChart() {
    if (report_gen_url != "") {
        $.ajax({
            url: report_gen_url,
            dataType: "json",

        })
                .done(function (response) {
                    if (response.code == 1) {
                        console.log("[AJAX]ok");
                        //console.log( response );
                        var old_data2 = JSON.stringify(response.data);
                        if (old_data2 != old_data) {
                            console.log("[AJAX]refresh");
                            old_data = old_data2;
                            save_response = response;
                            refreshData(save_response);

                        }
                        ;
                        if (timeout > 0) {
                            timeout_obj = setTimeout(function () {
                                drawChart();
                            }, timeout);
                        }
                        ;

                    } else {
                        console.log("GoogleChart.Ajax error");

                    }

                })
                .fail(function () {
                    alert("fail");

                });

    }




}

function load(data, i, report) {
    /*
     for (var i2 = 0; i2 < data.getNumberOfColumns(); i2++) {
     graphData[i].columns.push(i2);
     if (i2 > 0) {
     graphData[i].series[i2 - 1] = {};
     }
     }*/

    console.log("[" + i + ":REFRESH_DATA]create chart-setup select listener ");
    if (graphData[i].selection_flag != 0) {
        var firstClick = 0;
        var secondClick = 0;
        var row = -1;
        var col = -1;
        google.visualization.events.addListener(graphData[i].chart_id, "select", function () {
            var date = new Date();
            var millis = date.getTime();
            var sel = graphData[i].chart_id.getSelection();
            if (sel.length > 0) {
                //var data = graphData[i].chart_id.getDataTable();
                if (sel[0].row != null) {
                    row = sel[0].row;
                    console.log("[" + i + ":SELECT]row=" + row);

                }
                if (sel[0].column != null) {
                    col = sel[0].column;
                }
            }


            if (millis - secondClick > 1000) {
                // add delayed check if a single click occured
                setTimeout(function () {
                    // no second click fast enough, it is a single click

                    if (secondClick == 0) {
                        col = -1;
                        row = -1;
                        var sel = graphData[i].chart_id.getSelection();
                        if (sel.length > 0) {
                            //var data = graphData[i].chart_id.getDataTable();
                            if (sel[0].row != null) {
                                var row = sel[0].row;
                                //Select
                                search_key = "";
                                temp_colum_idx = 0;
                                col = 0;
                                if (sel[0].column != null) {
                                    col = sel[0].column;
                                }
                                res = BuildKey(report, graphData[i].data, 1, row, col);
                                /* 
                                 for (let i2 = 0; i2 < report.key.length; i2++) {
                                 key_val = graphData[i].data.getValue(row, i2);
                                 key_val_str = key_val;
                                 data_type = report.key[i2].data_type;
                                 //save record
                                 if (data_type == "date") {
                                 let dt = new Date(key_val);
                                 key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate());
                                 key_val_str = key_val.toString();
                                 //key_val_str=key_val;
                                 } else if (data_type == "time") {
                                 //let dt = new Date(key_val);
                                 //key_val = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
                                 key_val_str = JSON.stringify(key_val);
                                 //key_val_str=key_val;
                                 } else if (data_type == "datetime") {
                                 let dt = new Date(key_val);
                                 key_val_str = key_val.toString();
                                 key_val = dt;
                                 } else if (data_type == "float") {
                                 key_val = parseFloat(key_val);
                                 }
                                 
                                 if (temp_colum_idx == 0) {
                                 search_key = key_val_str;
                                 } else {
                                 search_key = search_key + "{B4t45}" + key_val_str;
                                 }
                                 temp_colum_idx++;
                                 
                                 
                                 }*/



                                if (graphData[i].selected_value == res.search_key) {
                                    console.log("[" + i + ":SELECT] chart:clear select " + i + " row " + sel[0].row + " " + res.search_key);
                                    graphData[i].selected_value = null;
                                } else {
                                    console.log("[" + i + ":SELECT] chart:select " + i + " row " + sel[0].row + " " + graphData[i].selected_value + " " + res.search_key);
                                    graphData[i].selected_value = res.search_key;
                                }


                                execSelect();
                            }
                            ;
                            if (sel[0].column != null) {
                                var col = sel[0].column;
                                console.log("[" + i + ":SELECT] chart:select " + i + " column " + sel[0].column + " " + graphData[i].data.getColumnLabel(col));

                                /*
                                 if (graphData[i].columns[col] == col) {
                                 graphData[i].columns[col] = {
                                 label: data.getColumnLabel(col),
                                 type: data.getColumnType(col),
                                 calc: function () {
                                 return null;
                                 }
                                 };
                                 
                                 graphData[i].series[col - 1].color = "#CCCCCC";
                                 } else {
                                 graphData[i].columns[col] = col;
                                 graphData[i].series[col - 1].color = null;
                                 }
                                 var view = new google.visualization.DataView(data);
                                 view.setColumns(graphData[i].columns);
                                 
                                 
                                 graphData[i].chart_id.draw(view, graphData[i].options);*/
                            }
                            console.log("[" + i + ":SELECT] chart:" + i);
                        } else {
                            console.log("[" + i + ":SELECT] chart:clear select");
                            graphData[i].selected_value = null;
                            graphData[i].selected_row = -1;
                            execSelect();

                        }
                    }
                }, 250);
            }

            // try to measure if double-clicked
            if (millis - firstClick < 250) {
                firstClick = 0;
                secondClick = millis;
                if (report.dblclick != null) {
                    console.log("[" + i + ":SELECT]double click " + row);
                    if (row >= 0) {
                        //Select
                        search_key = "";
                        temp_colum_idx = 0;
                        res = BuildKey(report, graphData[i].data, 1, row, col, 1);

                        console.log("[" + i + ":SELECT] chart:redirect " + i + " row " + row + " " + res.search_key);
                        /*
                         var key_str = "";
                         for (let i2 = 0; i2 < report.key.length; i2++) {
                         let idx2 = report.key[i2].field_no;
                         if (i2 == 0) {
                         key_str = idx2;
                         } else {
                         key_str = key_str + "{B4t45}" + idx2;
                         }
                         }*/
                        var key_str = "";
                        for (let i2 = 0; i2 < res.temp_rec2.length; i2++) {
                            if (i2 == 0) {
                                key_str = res.temp_rec2[i2];
                            } else {
                                key_str = key_str + " and " + res.temp_rec2[i2];

                            }

                        }


                        window.location.href = "https://icloud.icode.id/index.php?r=report-generator%2Fget-data-report4&folder=report1.json&report_name=" + report.dblclick + "&filter2=" + key_str;


                    }



                    //alert("doubleClick");
                } else {
                    console.log("[" + i + ":SELECT]double click " + row + " disable");

                }

            } else {
                firstClick = millis;
                secondClick = 0;
                //row=-1;
                //col=-1;
            }





        });
    }

    //window.onresize = resize;
}
;
/*
 function resize() {
 console.log("GoogleChart.resize");
 old_data = null;
 clearTimeout(timeout_obj);
 drawChart();
 }*/

function execSelect() {
    for (let i = 0; i < graphData.length; i++) {
        if (graphData[i].selected_value != null) {
            console.log("[" + i + ":SELECT] select " + graphData[i].selected_value);
        }
    }
    refreshData(save_response);
}

function refreshData(response) {
    for (let i = 0; i < graphData.length; i++) {

        var proc_data5 = loadReport(response.data, response.report[i], i);
        console.log("[" + i + ":REFRESH_DATA]" + " ", proc_data5);
        var data = google.visualization.arrayToDataTable(proc_data5);
        if (graphData[i].chart_id == null) {
            console.log("[" + i + ":REFRESH_DATA]create chart");
            let vis_var = graphData[i].visualization.toLowerCase();
            if (vis_var == "piechart") {
                graphData[i].chart_id = new google.visualization.PieChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "linechart") {
                graphData[i].chart_id = new google.visualization.LineChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "barchart") {
                graphData[i].chart_id = new google.visualization.BarChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "columnchart") {
                graphData[i].chart_id = new google.visualization.ColumnChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "annotationchart") {
                graphData[i].chart_id = new google.visualization.AnnotationChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "areachart") {
                graphData[i].chart_id = new google.visualization.AreaChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "bubblechart") {
                graphData[i].chart_id = new google.visualization.BubbleChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "calendar") {
                graphData[i].chart_id = new google.visualization.Calendar(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "candlestickchart") {
                graphData[i].chart_id = new google.visualization.CandlestickChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "combochart") {
                graphData[i].chart_id = new google.visualization.ComboChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "gantt") {
                graphData[i].chart_id = new google.visualization.Gantt(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "gauge") {
                graphData[i].chart_id = new google.visualization.Gauge(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "geochart") {
                graphData[i].chart_id = new google.visualization.GeoChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "histogram") {
                graphData[i].chart_id = new google.visualization.Histogram(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "map") {
                graphData[i].chart_id = new google.visualization.Map(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "orgchart") {
                graphData[i].chart_id = new google.visualization.OrgChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "sankey") {
                graphData[i].chart_id = new google.visualization.Sankey(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "scatterChart") {
                graphData[i].chart_id = new google.visualization.ScatterChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "steppedareachart") {
                graphData[i].chart_id = new google.visualization.SteppedAreaChart(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "table") {
                graphData[i].chart_id = new google.visualization.Table(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "timeline") {
                graphData[i].chart_id = new google.visualization.Timeline(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "treeMap") {
                graphData[i].chart_id = new google.visualization.TreeMap(document.getElementById(graphData[i].containerId));
            } else if (vis_var == "wordtree") {
                graphData[i].chart_id = new google.visualization.WordTree(document.getElementById(graphData[i].containerId));
            } else {
                graphData[i].chart_id = new google.visualization.PieChart(document.getElementById(graphData[i].containerId));

            }

            load(data, i, response.report[i]);
            console.log("[" + i + ":REFRESH_DATA]create chart(done)");

        }

        var view = new google.visualization.DataView(data);
        //view.setColumns(graphData[i].columns);
        graphData[i].chart_id.draw(view, graphData[i].options);
        graphData[i].data = data;
        if (graphData[i].selected_value != null) {
            for (let i2 = 0; i2 < data.getNumberOfRows(); i2++) {
                if (graphData[i].selected_value == data.getValue(i2, 0)) {
                    graphData[i].chart_id.setSelection([{'row': i2}]);
                    break;
                }
            }
            //graphData[i].chart_id.setSelection([{'row': graphData[i].selected_row}]);
        }
    }



}

