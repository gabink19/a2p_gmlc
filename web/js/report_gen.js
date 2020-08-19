var sessionMap=[];
var graphData = [];


/*
var folder = "report3.json";
var initFlag = true;
var initGoogleFlag = true;

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
var report_gen_url = "";
var report_gen_url2 = "";
var redirect_gen_url = "";
var last_index = -1;
var var_andWhere = "";
var var_andWhere_df = "";
var sql_df_where = "";*/


function loadReport(response_data, report, idx,sessionRec) {
    console.log("[" + idx + ":load_report]" + report.name+" "+response_data.length);
    //convert data to map
    var map_data = new Map();
    var rec_pertama = [];
    var temp_data = response_data[0];
    //graphData[idx].selection=[];
    var colum_idx = 0;
    //var selection_zone=report.selection_zone;
    var view_zone=report.view_zone;
    for (let i2 = 0; i2 < report.key.length; i2++) {

        let idx4 = report.key[i2].field_seq;
        var label_param = report.key[i2].name;
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
        let idx4 = report.field[i2].field_seq;
        label_param = report.field[i2].name;
        if (label_param == null) {
            label_param = temp_data[idx4];
        }
        rec_pertama.push(label_param);

    }
    var result_data = [];
    // console.log("[" + idx + ":load_report] record count "+response_data.length);
    for (let i = 1; i < response_data.length; i++) {
        temp_data = response_data[i];
        //console.log("[" + idx + ":load_report] check data");
            
        if (checkFilter(idx, report.filter, temp_data))
            continue;


        var iqnore = false;
        for (let i3 = 0; i3 < sessionRec.graphData.length; i3++) {
            if (i3 != idx) {
                var rep = sessionRec.save_response.report[i3];
                if (rep.selection_zone==view_zone){
                    if (sessionRec.graphData[i3].selected_value != null) {

                        var res = BuildKey(rep, temp_data);


                        if (res.search_key != sessionRec.graphData[i3].selected_value) {
                            //console.log("[" + idx + ":match " + res.search_key + " " + graphData[i3].selected_value)
                            iqnore = true;
                            break;
                        } else {
                            //console.log("[" + idx + ":not match " + res.search_key + " " + graphData[i3].selected_value);
                        }
                        ///console.log("select " + graphData[i].selection_idx + " " + graphData[i].selected_value);
                    }
                }
            }
        }
        if (iqnore)
            continue;
        var temp_colum_idx = 0;
        var temp_rec2 = [];
        res = BuildKey(report, temp_data);


        var temp_rec = map_data.get(res.search_key);
        if (temp_rec == null) {
            console.log("[" + idx + ":load_report] new column " + res.search_key + " " + colum_idx);
            temp_rec = res.temp_rec2;

            for (let i2 = 0; i2 < report.field.length; i2++) {

                let idx5 = report.field[i2].field_seq;
                var val_data = temp_data[idx5];
                rec_detail = BuildNewParameter(report, i2, val_data, temp_data, idx);
                temp_rec.push(rec_detail);
            }
            map_data.set(res.search_key, temp_rec);

        } else {

            //console.log("[" + idx + ":load_report] existing column " + res.search_key + " " + colum_idx);
            for (let i2 = 0; i2 < report.field.length; i2++) {
                var rec_detail = temp_rec[i2 + colum_idx];
                let idx6 = report.field[i2].field_seq;
                var var_value2 = temp_data[idx6];
                BuildEditParameter(report, i2, var_value2, rec_detail, temp_data, idx);

            }



        }




    }



    //result_data.push(rec_pertama);

    for (let [k, v] of map_data) {
        //console.log("[" + idx + ":load_report] value " + v);

        var result_data_detail = CalculateParameter(report, colum_idx, v,idx);
        result_data.push(result_data_detail);

    }


    if (report.data_3d) {
        var map_data = new Map();
        var map_data2 = new Map();
        idx5 = 0;
        var param_name = [];
        for (let i3 = 0; i3 < result_data.length; i3++) {
            var var_value_2 = result_data[i3][1];
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
            var result_detail2 = [];
            var var_value = result_data[i3];
            var var_value_1 = var_value[0];
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
        var result_data2 = [];
        for (let [k, v] of map_data2) {
            result_data2.push(v);
        }
        result_data = result_data2;
        var rec_pertama2 = [];
        rec_pertama2.push(rec_pertama[0]);
        for (let i4 = 0; i4 < idx5; i4++) {
            rec_pertama2.push(param_name[i4]);

        }
        //rec_pertama2.push(rec_pertama[2]);
        rec_pertama = rec_pertama2;


    }
    ;

    var sorted = -1;
    if (report.sorted >= 0) {
        sorted = report.sorted;
    }
    if (sorted >= 0) {
        /*
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
         });*/
        result_data.sort(function (a, b) {
            var val1 = "";
            var val2 = "";
            for (let i2 = 0; i2 < report.key.length; i2++) {
                //console.log("debug_sort :  "+report.key[i2].data_type+" "+ +a[i2]+" "+b[i2]);
                if ((report.key[i2].data_type == "datetime") ||
                        (report.key[i2].data_type == "5n") ||
                        (report.key[i2].data_type == "15n") ||
                        (report.key[i2].data_type == "30n") ||
                        (report.key[i2].data_type == "1h") ||
                        (report.key[i2].data_type == "date")) {
                    //console.log("debug_sort :  " +a[i2]+" "+b[i2]);
                    //val1=val1+" "+new Date(a[i2]).toJSON();
                    //val2=val2+" "+new Date(b[i2]).toJSON();
                    val1 = val1 + " " + a[i2].toJSON();
                    val2 = val2 + " " + b[i2].toJSON();
                    //console.log("debug_sort : " + val1+" "+val2);

                } else {
                    val1 = val1 + " " + a[i2];
                    val2 = val2 + " " + b[i2];
                }
            }
            if (report.sorted_method == 1) {
                if (val1 > val2) {
                    return 1;
                }
                if (val2 > val1) {
                    return -1;
                }
            } else {
                if (val1 < val2) {
                    return 1;
                }
                if (val2 < val1) {
                    return -1;
                }
            }
            return 0;
        });
    }

    if (report.max_display > 0) {
        console.log("[" + idx + ":load_report]rearrange data");

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

                    result_detail2.push(rec_detail);
                }
            } else {
                for (let i2 = 0; i2 < report.field.length; i2++) {
                    rec_detail = result_detail2[i2 + colum_idx]
                    var_value2 = var_value[i2 + colum_idx];
                    BuildEditParameter(report, i2, var_value2, rec_detail);


                }

            }

        }
        if (result_detail2.length > 0) {

            var result_detail3 = CalculateParameter(report, colum_idx, result_detail2,idx);
            result_data2.push(result_detail3);
        }
        console.log("[" + idx + ":load_report] rearrange data(done) : " + result_data2);
        result_data = result_data2;
    }
    
    if (report.extend_js!="" && report.extend_js!=null){
        var extend_function="process_report_"+idx;
        console.log("[" + idx + ":load_report]advance process for extend_function "+extend_function);
        
        res=window[extend_function](idx,report,rec_pertama,result_data);
        if (res!=null){
            rec_pertama=res.rec_pertama;
            result_data=res.result_data;
        }
    }
    if (report.visualization == "table") {
        console.log("[" + idx + ":load_report] advance process :", report.visualization);
        //console.log("[" + idx + ":load_report] advance process for table ", result_data);
        result_data2 = [];
        rec_pertama2 = [];


        for (let i2 = 0; i2 < report.key.length; i2++) {

            if (report.key[i2].hidden == 1) {
            } else {
                rec_pertama2.push(rec_pertama[i2]);
            }
        }
        for (let i2 = 0; i2 < report.field.length; i2++) {

            if (report.field[i2].hidden == 1) {
            } else {
                rec_pertama2.push(rec_pertama[i2 + report.key.length]);
            }
        }



        for (let i3 = 0; i3 < result_data.length; i3++) {
            var_value = result_data[i3];
            result_detail2 = [];

            for (let i2 = 0; i2 < report.key.length; i2++) {
                if (report.key[i2].hidden == 1) {
                } else {
                    result_detail2.push(var_value[i2]);
                }
            }
            for (let i2 = 0; i2 < report.field.length; i2++) {
                if (report.field[i2].hidden == 1) {
                } else {
                    result_detail2.push(var_value[i2 + report.key.length]);
                }
            }


            result_data2.push(result_detail2);
        }
        //console.log("[" + idx + ":load_report] advance process for table 1 ", rec_pertama2);
        //console.log("[" + idx + ":load_report] advance process for table  2 ", result_data2);
        result_data = result_data2;
        rec_pertama = rec_pertama2;
       

    } else if (report.visualization == "map" ||report.visualization == "mapbox") {
        console.log("[" + idx + ":load_report] advance process :", report.visualization);
        var showTooltip = report.options.showTooltip;
        if (report.key.length == 1) {
           result_data2 = [];
            rec_pertama2 = [];
            for (let i2 = 0; i2 < colum_idx; i2++) {
                rec_pertama2.push(rec_pertama[i2]);
            }
            var $marker_flag = 0;
            rec_pertama2.push({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
            var rec_temp=[];
            if ((rec_pertama[rec_pertama.length - 1]).toLowerCase() == "marker") {
                rec_temp.push("marker");
                $marker_flag = 1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "color") {
                rec_temp.unshift("color");
                $marker_flag = $marker_flag+1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "radius") {
                rec_temp.unshift("radius");
                $marker_flag = $marker_flag+1;
            }
            rec_pertama2=rec_pertama2.concat(rec_temp);

            for (let i3 = 0; i3 < result_data.length; i3++) {
                var_value = result_data[i3];
                result_detail2 = [];
                for (let i2 = 0; i2 < colum_idx+2; i2++) {
                    result_detail2.push(var_value[i2]);
                }
                var tempS;
                //tempS='<div style="padding:5px 5px 5px 5px;">';
                if (showTooltip == 1) {
                    tempS = "";
                } else {
                    tempS = "<table>";
                }
                for (let i2 = 2; i2 < (report.field.length - $marker_flag); i2++) {
                    //result_detail2.push(var_value[i2+colum_idx]);
                    if (showTooltip == 1) {
                        tempS = tempS + "" + rec_pertama[i2 + colum_idx] + ":" + var_value[i2 + colum_idx] + ",";
                    } else {
                        tempS = tempS + "<tr><td><b>" + rec_pertama[i2 + colum_idx] + "</b<</td><td>" + var_value[i2 + colum_idx] + "</td></tr>";
                    }
                }
                if (showTooltip != 1) {
                    tempS = tempS + "</table>";
                }
                result_detail2.push(tempS);
                /*
                if ($marker_flag == 1) {
                    result_detail2.push(var_value[colum_idx + report.field.length - 1]);
                }*/
                for (let i=0;i<$marker_flag;i++) {
                    result_detail2.push(var_value[colum_idx + report.field.length - $marker_flag+i]);
                }
                result_data2.push(result_detail2);

            }
            result_data = result_data2;
            rec_pertama = rec_pertama2;
        } else 
        if (report.key.length == 2) {

            result_data2 = [];
            rec_pertama2 = [];
            for (let i2 = 0; i2 < colum_idx; i2++) {
                rec_pertama2.push(rec_pertama[i2]);
            }
            $marker_flag = 0;
            rec_pertama2.push({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
            rec_temp=[];
            if ((rec_pertama[rec_pertama.length - 1]).toLowerCase() == "marker") {
                rec_temp.push("marker");
                $marker_flag = 1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "color") {
                rec_temp.unshift("color");
                $marker_flag = $marker_flag+1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "radius") {
                rec_temp.unshift("radius");
                $marker_flag = $marker_flag+1;
            }
            rec_pertama2=rec_pertama2.concat(rec_temp);

            for (let i3 = 0; i3 < result_data.length; i3++) {
                var_value = result_data[i3];
                result_detail2 = [];
                for (let i2 = 0; i2 < colum_idx; i2++) {
                    result_detail2.push(var_value[i2]);
                }
                ;
                //tempS='<div style="padding:5px 5px 5px 5px;">';
                if (showTooltip == 1) {
                    tempS = "";
                } else {
                    tempS = "<table>";
                }
                for (let i2 = 0; i2 < (report.field.length - $marker_flag); i2++) {
                    //result_detail2.push(var_value[i2+colum_idx]);
                    if (showTooltip == 1) {
                        tempS = tempS + "" + rec_pertama[i2 + colum_idx] + ":" + var_value[i2 + colum_idx] + ",";
                    } else {
                        tempS = tempS + "<tr><td><b>" + rec_pertama[i2 + colum_idx] + "</b<</td><td>" + var_value[i2 + colum_idx] + "</td></tr>";
                    }
                }
                if (showTooltip != 1) {
                    tempS = tempS + "</table>";
                }
                result_detail2.push(tempS);
                for (let i=0;i<$marker_flag;i++) {
                    result_detail2.push(var_value[colum_idx + report.field.length - $marker_flag+i]);
                }
                result_data2.push(result_detail2);

            }
            result_data = result_data2;
            rec_pertama = rec_pertama2;
        } else {
            //report.options.showTooltip=false;
            //report.options.showInfoWindow=true;
            //report.selection_flag=0;

            var map_data = new Map();
            for (let i3 = 0; i3 < result_data.length; i3++) {
                var_value = result_data[i3];
                var_value_2 = var_value[0] + ":" + var_value[1];
                temp_rec = map_data.get(var_value_2);
                if (temp_rec != null) {
                    temp_rec.push(var_value);
                } else {
                    temp_rec = [];
                    temp_rec.push(var_value);
                    map_data.set(var_value_2, temp_rec);
                }
            }

            result_data2 = [];
            rec_pertama2 = [];
            for (let i2 = 0; i2 < 2; i2++) {
                rec_pertama2.push(rec_pertama[i2]);
            }

            $marker_flag = 0;
            rec_pertama2.push({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
            rec_temp=[];
            if ((rec_pertama[rec_pertama.length - 1]).toLowerCase() == "marker") {
                rec_temp.push("marker");
                $marker_flag = 1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "color") {
                rec_temp.unshift("color");
                $marker_flag = $marker_flag+1;
            }
            if ((rec_pertama[rec_pertama.length -$marker_flag- 1]).toLowerCase() == "radius") {
                rec_temp.unshift("radius");
                $marker_flag = $marker_flag+1;
            }
            rec_pertama2=rec_pertama2.concat(rec_temp);
            for (let [k, v] of map_data) {
                var_value = v[0];
                result_detail2 = [];
                for (let i2 = 0; i2 < 2; i2++) {
                    result_detail2.push(var_value[i2]);
                }
                tempS = "";


                for (let i4 = 0; i4 < v.length; i4++) {
                    var_value = v[i4];
                    //tempS='<div style="padding:5px 5px 5px 5px;">';
                    tempS = tempS + "<table>";
                    for (let i2 = 0 - (colum_idx - 2); i2 < (report.field.length - $marker_flag); i2++) {
                        //result_detail2.push(var_value[i2+colum_idx]);
                        tempS = tempS + "<tr><td><b>" + rec_pertama[i2 + colum_idx] + "</b<</td><td>" + var_value[i2 + colum_idx] + "</td></tr>";
                    }
                    tempS = tempS + "</table><br>"
                }
                result_detail2.push(tempS);
                for (let i=0;i<$marker_flag;i++) {
                    result_detail2.push(var_value[colum_idx + report.field.length - $marker_flag+i]);
                }
                result_data2.push(result_detail2);

            }
            result_data = result_data2;
            rec_pertama = rec_pertama2;
        }

    }

    result_data.unshift(rec_pertama);

    return result_data;
}



function drawChart(sessionRec) {
    if (sessionRec.report_gen_url != "") {
        var d = new Date();
        var ajax_query = d.getTime();
        var _andWhere = sessionRec.andWhere;
        if (sessionRec.var_andWhere != "") {
            if (_andWhere != "") {
                _andWhere = _andWhere + " and ";
            }
            _andWhere = _andWhere + sessionRec.var_andWhere;
        }
        var _andWhere_df = sessionRec.andWhere_df;
        if (sessionRec.var_andWhere_df != "") {
            if (_andWhere_df != "") {
                _andWhere_df = _andWhere_df + " and ";
            }
            _andWhere_df = _andWhere_df + sessionRec.var_andWhere_df;
        }
        var _report_gen_url;
        if (sessionRec.last_index == -1 || sessionRec.report_gen_url2 == "") {
            _report_gen_url = sessionRec.report_gen_url;
        } else {

            _report_gen_url = sessionRec.report_gen_url2;
        }
        console.log("[AJAX]url = " , _report_gen_url);
        var _report_gen_url2='&filter_where=' + sessionRec.filter_where + '&filter_where_df=' + sessionRec.filter_where_df + '&add_where2=' + _andWhere + '&add_where2_df=' + _andWhere_df + '&limit=' + sessionRec.limit + "&last_index=" + sessionRec.last_index + "&sql_df_where=" + sessionRec.sql_df_where;
        if (sessionRec.page_mode==1) {
            _report_gen_url2=_report_gen_url2+"&datatableflag=1"
        };
        _report_gen_url=_report_gen_url+encodeURI(_report_gen_url2);
        $.ajax({
            url: _report_gen_url,
            dataType: "json",
            headers: {
                'Access-Control-Allow-Origin': '*'
            },

        })
                .done(function (response) {
                    if (response.code == 1) {

                        var d = new Date();
                        console.log("[AJAX]ok = " + (d.getTime() - ajax_query));
                        ajax_query = d.getTime();
                        //console.log( response );
                        if (sessionRec.last_index != -1) {
                            if (sessionRec.last_index < response.last_index) {
                                sessionRec.last_index = response.last_index;

                                //add delta data
                                if (response.df_flag != 0) {

                                    for (let i = 1; i < response.data_df.length; i++) {
                                        sessionRec.save_response.data_df.push(response.data_df[i]);
                                    }
                                    console.log("[AJAX]refresh done(delta) = " + (d.getTime() - ajax_query) + " " + response.data_df.length + " " + sessionRec.save_response.data_df.length);
                                } else {
                                    for (let i = 1; i < response.data.length; i++) {
                                        sessionRec.save_response.data.push(response.data[i]);
                                    }
                                    console.log("[AJAX]refresh done(delta) = " + (d.getTime() - ajax_query) + " " + response.data.length + " " + save_response.data.length);
                                }
                                refreshData(sessionRec.save_response,sessionRec);
                                var d = new Date();

                            }
                        } else {
                            if (response.df_flag == 0) {
                                var old_data2 = JSON.stringify(response.data);
                                if (old_data2 != sessionRec.old_data) {
                                    console.log("[AJAX]refresh");
                                    sessionRec.old_data = old_data2;
                                    sessionRec.save_response = response;
                                    sessionRec.last_index = response.last_index;
                                    sessionRec.sql_df_where = response.sql_df_where;
                                    refreshData(sessionRec.save_response,sessionRec);
                                    var d = new Date();
                                    console.log("[AJAX]refresh done = " + (d.getTime() - ajax_query));

                                }
                            } else {
                                var old_data2 = JSON.stringify(response.data_df);
                                if (old_data2 != sessionRec.old_data) {
                                    console.log("[AJAX]refresh");
                                    sessionRec.old_data = old_data2;
                                    sessionRec.save_response = response;
                                    sessionRec.last_index = response.last_index;
                                    if (sessionRec.last_index!=-1) {
                                        sessionRec.sql_df_where = response.sql_df_where;
                                    } else {
                                        sessionRec.sql_df_where="";
                                    }
                                    refreshData(sessionRec.save_response,sessionRec);
                                    var d = new Date();
                                    console.log("[AJAX]refresh done = " + (d.getTime() - ajax_query));

                                }
                            }
                        }
                        ;
                        if (sessionRec.timeout > 0) {
                            sessionRec.timeout_obj = setTimeout(function () {
                                drawChart(sessionRec);
                            }, sessionRec.timeout);
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

function load(data, i, report,sessionRec) {


    console.log("[" + i + ":REFRESH_DATA]create chart-setup select listener ");
    if (sessionRec.graphData[i].selection_flag == 1) {
        var firstClick = 0;
        var secondClick = 0;
        var row = -1;
        var col = -1;
        document.getElementById(sessionRec.graphData[i].idx + '_param2').addEventListener("click", function () {
            console.log("[" + i + ":SELECT] select click");
            document.getElementById(sessionRec.graphData[i].idx + "_param2").style.display = "none";
            sessionRec.graphData[i].selected_value = null;
            setTimeout(function () {
                execSelect(sessionRec);
            }, 1000);

        });
        
        /*
        document.getElementById(graphData[i].idx + '_param3').addEventListener("click", function () {
            console.log("[" + i + ":SELECT] double click");
            

        });*/
        google.visualization.events.addListener(sessionRec.graphData[i].chart_id, "select", function () {
            console.log("[" + i + ":SELECT]select");
           
            var date = new Date();
            var millis = date.getTime();
            var sel = sessionRec.graphData[i].chart_id.getSelection();
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
                        console.log("[" + i + ":SELECT]single click " + row);
                        col = -1;
                        row = -1;
                        var sel = sessionRec.graphData[i].chart_id.getSelection();
                        if (sel.length > 0) {
                            //var data = graphData[i].chart_id.getDataTable();
                            if (sel[0].row != null) {
                                var row = sel[0].row;
                                //Select
                                var search_key = "";
                                var temp_colum_idx = 0;
                                col = 0;
                                if (sel[0].column != null) {
                                    col = sel[0].column;
                                }
                                var res = BuildKey(report, graphData[i].data, 1, row, col);


                                if (sessionRec.graphData[i].selected_value == res.search_key) {
                                    /*
                                     console.log("[" + i + ":SELECT] chart:clear select " + i + " row " + sel[0].row + " " + res.search_key);
                                     graphData[i].selected_value = null;
                                     p_obj=document.getElementById(graphData[i].idx+"_param2");
                                     if (p_obj!=null){
                                     p_obj.style.display = "none";
                                     p_obj.innerHTML="";
                                     }*/
                                } else {
                                    console.log("[" + i + ":SELECT] chart:select " + i + " row " + sel[0].row + " " + graphData[i].selected_value + " " + res.search_key + " idx:" + graphData[i].idx);
                                    sessionRec.graphData[i].selected_value = res.search_key;
                                    var p_obj = document.getElementById(graphData[i].idx + "_param2");
                                    if (p_obj != null) {
                                        p_obj.style.display = "block";
                                        p_obj.innerHTML = "<b>filter:</b><br>" + res.search_key.replace("{B4t45}", "-");
                                    }
                                }


                                execSelect(sessionRec);
                            }
                            ;
                            if (sel[0].column != null) {
                                var col = sel[0].column;
                                console.log("[" + i + ":SELECT] chart:select " + i + " column " + sel[0].column + " " + graphData[i].data.getColumnLabel(col));


                            }
                            console.log("[" + i + ":SELECT] chart:" + i);
                        } else {
                            /*
                             console.log("[" + i + ":SELECT] chart:clear select");
                             graphData[i].selected_value = null;
                             graphData[i].selected_row = -1;
                             execSelect();*/

                        }
                    }
                }, 250);
            }

            // try to measure if double-clicked
            if (millis - firstClick < 250) {
                firstClick = 0;
                secondClick = millis;
                console.log("[" + i + ":SELECT]double click " + row);
                if (report.dblclick != null) {
                    
                    if (row >= 0) {
                        //Select
                        var search_key = "";
                        var temp_colum_idx = 0;
                        var res = BuildKey(report, sessionRec.graphData[i].data, 1, row, col, 1);

                        console.log("[" + i + ":SELECT] chart:redirect " + i + " row " + row + " " + res.search_key);

                        var key_str = sessionRec.filter_where;
                        for (let i2 = 0; i2 < res.temp_rec2.length; i2++) {
                            if (key_str == "") {
                                key_str = res.temp_rec2[i2];
                            } else {
                                key_str = key_str + " and " + res.temp_rec2[i2];

                            }

                        }
                        var key_str_df = sessionRec.filter_where_df;
                        for (let i2 = 0; i2 < res.temp_rec2_df.length; i2++) {
                            if (key_str_df == "") {
                                key_str_df = res.temp_rec2_df[i2];
                            } else {
                                key_str_df = key_str_df + " and " + res.temp_rec2_df[i2];

                            }

                        }
                        var redirect_url = sessionRec.redirect_gen_url + "&report_name=" + report.dblclick + "&filter_where=" + key_str + "&filter_where_df=" + key_str_df;
                        console.log("[" + i + ":SELECT] chart:redirect* " + i + " row " + row + " " + redirect_url);
                        window.location.href = redirect_url;



                    }



                    //alert("doubleClick");
                } else {
                    console.log("[" + i + ":SELECT]double click " + row + " disable");

                }

            } else {
                firstClick = millis;
                secondClick = 0;
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

function execSelect(sessionRec) {
    for (let i = 0; i < sessionRec.graphData.length; i++) {
        if (sessionRec.graphData[i].selected_value != null) {
            console.log("[" + i + ":SELECT] select " + sessionRec.graphData[i].selected_value);
        }
    }
    refreshData(sessionRec.save_response,sessionRec);
}

function refreshData(response,sessionRec) {
    if (response.df_flag != 0) {
        console.log("[AJAX]start ",response);
        var data_df = response.data_df;
        var data_lookup = response.data_lookup;
        console.log("[AJAX]data_df:", data_df);
        console.log("[AJAX]data_lookup:", data_lookup);
        var data_column = response.column;
        console.log("[AJAX]column:", data_column);
        console.log("[AJAX]master_detail_index:", response.master_detail_index," ",response.master_detail_index2);
        
        var data = [];
        var rec_data = [];
        for (var k in data_column) {
            var v = data_column[k];
            var idx = v.df_index;

            rec_data.push(v.ALIAS_NAME);



        }
        console.log("[AJAX]rec_data:", rec_data);
        data.push(rec_data);
        var data_lookup_ref=[];
        for (let i = 1; i < data_df.length; i++) {
            rec_data = [];
            var d_df = data_df[i];
            var d_lookup = null;
            var _master_detail_index1 = d_df[response.master_detail_index];
            var _master_detail_index2 = d_df[response.master_detail_index2];
            if (response.df_flag == 2) {
                _d = data_lookup[_master_detail_index1];
                if (_d != null) {
                    d_lookup = _d[_master_detail_index2];
                    /* not test yet */
                    var res=data_lookup_ref[_master_detail_index1];
                    if (res==null){
                       data_lookup_ref[_master_detail_index1]=[]; 
                    };
                    var res2=data_lookup_ref[_master_detail_index1][_master_detail_index2];
                    if (res2==null) {
                       data_lookup_ref[_master_detail_index1][_master_detail_index2]=1; 
                    }
                    /* not test yet */
                }
            } else if (response.df_flag == 1) {
                d_lookup = data_lookup[_master_detail_index1];
                var res=data_lookup_ref[_master_detail_index1];
                if (res==null){ 
                    data_lookup_ref[_master_detail_index1]=1;
                }

            }
            //console.log("[PRE_PROCESS]master_id:",_master_detail_index1,_master_detail_index2);
            //console.log("[PRE_PROCESS]data_lookup:",d_lookup);
            if (d_lookup != null) {
               
                for (var k in data_column) {
                    v = data_column[k];
                    idx = v.df_index;
                    if (v.df_flag == 1) {
                        rec_data.push(d_df[idx]);

                    } else {
                        if (d_lookup != null) {
                            rec_data.push(d_lookup[idx]);

                        }
                    }


                }
                data.push(rec_data);
            }
            //console.log("[PRE_PROCESS]rec:",rec_data);


        }
        if (response.df_flag == 2) {
           /* not test yet */
           //put code here
           
        } else {
            console.log("[AJAX]rec:",data_lookup_ref);
            for (var obj in data_lookup) {
                if (obj!=0) {
                    res=data_lookup_ref[obj];
                    if (res==null){
                        d_lookup=data_lookup[obj];
                        rec_data=[];
                        for (var k in data_column) {
                            v = data_column[k];
                            idx = v.df_index;
                            if (v.df_flag == 1) {
                                rec_data.push(null);

                            } else {
                                if (d_lookup != null) {
                                    rec_data.push(d_lookup[idx]);

                                }
                            }


                        }
                        //console.log("[PRE_PROCESS]empty record: ", obj, rec_data);
                        data.push(rec_data);
                    }
                }
            }
        }
        console.log("[AJAX]data:", data);
        response.data = data;

    }
    ;
    for (let i = 0; i < sessionRec.graphData.length; i++) {
        //console.log("[" + i + ":REFRESH_DATA]");
        console.log("[" + i + ":AJAX] refreshData");
        var current_report=response.report[i];
        var result_temp=false;
        if (current_report.selection_flag==2){
            for (let i2 = 0; i2 < sessionRec.graphData.length; i2++) {
                var compare_report=response.report[i2];
                if (current_report.view_zone==compare_report.selection_zone) {
                    if (sessionRec.graphData[i2].selected_value != null) {
                        result_temp=true;
                        break;
                    }
                }
                
            }
            var methode;
            if (!result_temp) {
                //console.log("[" + i + ":REFRESH_DATA]" + " hidden");
                console.log("[" + i + ":AJAX] refreshData hidden");
                if (response.report[i].disable) {

                } else if (sessionRec.graphData[i].options.report_type == 1) {
                    methode=sessionRec.graphData[i].methode.toLowerCase()+"_hide";
                    sessionRec.graphData[i].chart_id = window[methode](proc_data5, response.report[i], i, graphData);
                } else if (sessionRec.graphData[i].options.report_type == 2) {
                    methode=sessionRec.graphData[i].methode.toLowerCase()+"_hide";
                    sessionRec.graphData[i].chart_id = window[methode](proc_data5, response.report[i], i, graphData);
                } else {
                    
                }
                continue;
            }
            
        }
        var proc_data5 = loadReport(response.data, current_report, i,sessionRec);
        console.log("[" + i + ":REFRESH_DATA]" + " ", proc_data5);
        console.log("[" + i + ":REFRESH_DATA]" + " idx:", sessionRec.graphData[i].idx, " methode:" + sessionRec.graphData[i].methode);
        if (response.report[i].disable) {

        } else if (sessionRec.graphData[i].options.report_type == 1) {
            sessionRec.graphData[i].chart_id = window[sessionRec.graphData[i].methode.toLowerCase()](proc_data5, response.report[i], i, sessionRec.graphData);
        } else if (sessionRec.graphData[i].options.report_type == 2) {
            sessionRec.graphData[i].chart_id = window[sessionRec.graphData[i].methode.toLowerCase()](proc_data5, response.report[i], i, sessionRec.graphData);
        } else {
            let vis_var = sessionRec.graphData[i].visualization.toLowerCase();
            /*
            if (vis_var == "map") {
                if (current_report.key.length==1) {
                   _proc_data5=[];
                   for (let i2=0;i2<proc_data5.length;i2++){
                      _data_detail_temp=proc_data5[i2];
                      _data_detail=[];
                      for (let i3=1;i3<_data_detail_temp.length;i3++){
                          _data_detail.push(_data_detail_temp[i3]);
                      }
                      _proc_data5.push(_data_detail);
                   }
                } else {
                   _proc_data5=proc_data5; 
                }
                console.log("[" + i + ":REFRESH_DATA]create chart ",_proc_data5);
           
            } else {
                _proc_data5=proc_data5;
            }*/
            var data = google.visualization.arrayToDataTable(proc_data5);
            if (sessionRec.graphData[i].chart_id == null) {
                console.log("[" + i + ":REFRESH_DATA]create chart");
                
                if (vis_var == "piechart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.PieChart(document.getElementById(sessionRec.graphData[i].containerId));

                } else if (vis_var == "linechart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.LineChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "barchart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.BarChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "columnchart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.ColumnChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "annotationchart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.AnnotationChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "areachart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.AreaChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "bubblechart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.BubbleChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "calendar") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Calendar(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "candlestickchart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.CandlestickChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "combochart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.ComboChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "gantt") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Gantt(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "gauge") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Gauge(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "geochart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.GeoChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "histogram") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Histogram(document.getElementById(sessionRec.graphData[i].containerId));

                } else if (vis_var == "map") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Map(document.getElementById(sessionRec.graphData[i].containerId));

                } else if (vis_var == "orgchart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.OrgChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "sankey") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Sankey(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "scatterChart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.ScatterChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "steppedareachart") {
                    sessionRec.graphData[i].chart_id = new google.visualization.SteppedAreaChart(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "table") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Table(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "timeline") {
                    sessionRec.graphData[i].chart_id = new google.visualization.Timeline(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "treeMap") {
                    sessionRec.graphData[i].chart_id = new google.visualization.TreeMap(document.getElementById(sessionRec.graphData[i].containerId));
                } else if (vis_var == "wordtree") {
                    sessionRec.graphData[i].chart_id = new google.visualization.WordTree(document.getElementById(sessionRec.graphData[i].containerId));
                } else {
                    sessionRec.graphData[i].chart_id = new google.visualization.PieChart(document.getElementById(sessionRec.graphData[i].containerId));

                }

                load(data, i, response.report[i],sessionRec);
                console.log("[" + i + ":REFRESH_DATA]create chart(done)");

            }
            var view = new google.visualization.DataView(data);
            //view.setColumns(graphData[i].columns);

            sessionRec.graphData[i].chart_id.draw(view, sessionRec.graphData[i].options);
            sessionRec.graphData[i].data = data;
            if (sessionRec.graphData[i].selected_value != null) {
                for (let i2 = 0; i2 < data.getNumberOfRows(); i2++) {
                    if (sessionRec.graphData[i].selected_value == data.getValue(i2, 0)) {
                        sessionRec.graphData[i].chart_id.setSelection([{'row': i2}]);
                        break;
                    }
                }
            }
        }

    }



}

function reload_data(sessionRec){
        clearTimeout(timeout_obj);
        console.log('clearTimeout');
        timeout_obj = setTimeout(function () {
                console.log('draw');
                drawChart(sessionRec);
            }, 1000);
        console.log('drawChart');
    
}