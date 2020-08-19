/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function BuildKeyChild(data_flag, data_type, value_var, phpflag = 0, column_name = "") {
    var res = {
        key_val: value_var,
        key_val_str: ""
    }

    res.key_val_str = res.key_val;
    if (data_type == "date") {
        let dt = new Date(res.key_val);
        if (phpflag == 1) {
            res.key_val = "date(" + column_name + ")='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate());
            res.key_val_str = res.key_val.toString();
        }
        //key_val_str=key_val;
    } else if (data_type == "yy") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "YEAR(" + column_name + ")=" + dt.getFullYear();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getFullYear();
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "YEAR(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            }
        }
        //key_val_str=key_val;
    } else if (data_type == "mm") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "MONTH(" + column_name + ")=" + dt.getMonth() + 1;
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getMonth() + 1;
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "MONTH(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            }
        }
        //key_val_str=key_val;
    } else if (data_type == "dd") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "DAY(" + column_name + ")=" + dt.getDate();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getDate();
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "DAY(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            }
        }
    } else if (data_type == "hh") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "HOUR(" + column_name + ")=" + dt.getHours();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getHours();
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "HOUR(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            }
        }
    
    } else if (data_type == "nn") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "MINUTE(" + column_name + ")=" + dt.getMinutes();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getMinutes();
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "MINUTE(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            }
        }
    } else if (data_type == "ss") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "SECOND(" + column_name + ")=" + dt.getSeconds();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getSeconds();
                res.key_val_str = res.key_val.toString();
            }
        } else {
            if (phpflag == 1) {
                res.key_val = "SECOND(" + column_name + ")=" + res.key_val;
                res.key_val_str = res.key_val;
            };
        }
    } else if (data_type == "time") {
        if (data_flag == 0||data_flag == 2) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "CONVERT(" + column_name + ",TIME)='" + dt.getHours() + ":" + (dt.getMinutes() + 1) + ":" + dt.getSeconds() + "'";
                res.key_val_str = res.key_val;

            } else {
                res.key_val = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
                res.key_val_str = JSON.stringify(res.key_val);
            }
        } else {
            if (phpflag == 1) {
                //var str=res.key_val;
                //var myarr = str.split(",");
                var myarr=res.key_val;
                res.key_val = "CONVERT(" + column_name + ",TIME)='" + myarr[0] + ":" + myarr[1] + ":" + myarr[2] + "'";
                res.key_val_str = res.key_val;

            } else {
                res.key_val="["+res.key_val+"]";
                res.key_val_str =res.key_val;
            }
        }
        //key_val_str=key_val;
    } else if (data_type == "datetime") {
        let dt = new Date(res.key_val);
        
        if (phpflag == 1) {
            res.key_val = column_name + "='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds() + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = dt;
            res.key_val_str = res.key_val.toString();
            //res.key_val_str = res.key_val.toJSON();
        }
    } else if (data_type == "5n") {
        
        let dt = new Date(res.key_val);
        let min_var=5;
        
        let min=Math.trunc(dt.getMinutes()/min_var)*min_var;
        if (phpflag == 1) {
            res.key_val = column_name + ">='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + min + ":" + 0 + "' and "+
                    column_name + "<='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + (min+min_var-1) + ":" + 59 + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(),dt.getHours(),min,0);
            res.key_val_str = res.key_val.toString();
        }
    } else if (data_type == "15n") {
        let dt = new Date(res.key_val);
        let min_var=15;
        let min=Math.trunc(dt.getMinutes()/min_var)*min_var
        if (phpflag == 1) {
            res.key_val = column_name + ">='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + min + ":" + 0 + "' and "+
                    column_name + "<='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + (min+min_var-1) + ":" + 59 + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(),dt.getHours(),min,0);
            res.key_val_str = res.key_val.toString();
        }
    } else if (data_type == "30n") {
        let dt = new Date(res.key_val);
        let min_var=30;
        let min=Math.trunc(dt.getMinutes()/min_var)*min_var;
        if (phpflag == 1) {
            res.key_val = column_name + ">='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + min + ":" + 0 + "' and "+
                    column_name + "<='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + (min+min_var-1) + ":" + 59 + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(),dt.getHours(),min,0);
            res.key_val_str = res.key_val.toString();
        }
    } else if (data_type == "1h") {
        let dt = new Date(res.key_val);
        let min_var=60;
        let min=Math.trunc(dt.getMinutes()/min_var)*min_var;
        if (phpflag == 1) {
            res.key_val = column_name + ">='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + min + ":" + 0 + "' and "+
                    column_name + "<='" + dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + (min+min_var-1) + ":" + 59 + "'";
            res.key_val_str = res.key_val;
        } else {
            res.key_val = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(),dt.getHours(),min,0);
            res.key_val_str = res.key_val.toString();
        }  
        
    } else if (data_type == "float" || data_type == "double") {
        if (phpflag == 1) {
            res.key_val = column_name + "=" + parseFloat(res.key_val);
            res.key_val_str = res.key_val;
        } else {
            res.key_val = parseFloat(res.key_val);
        }
    } else if (data_type == "int") {
        if (phpflag == 1) {
            res.key_val = column_name + "=" + res.key_val + "";
            res.key_val_str = res.key_val;
        }
    } else {
        if (phpflag == 1) {
            res.key_val = column_name + "='" + res.key_val + "'";
            res.key_val_str = res.key_val;
        }
    }

    return res;
}

function BuildKey(rep, temp_data, data_flag = 0, row = 0, col = 1, phpflag = 0,COLUMN_NAME="COLUMN_NAME") {

    temp_colum_idx = 0;
    
    var res = {
        search_key: "",
        temp_rec2: [],
        
        temp_rec2_df: [],
        
    }
    var key_length=rep.key.length;
    
    for (let i2 = 0; i2 < key_length; i2++) {
        
        if (data_flag == 1) {
            key_val = temp_data.getValue(row, i2);
        } else if (data_flag == 2) {
            key_val = temp_data[i2];
        }  else {
            let idx2 = rep.key[i2].field_seq;
            key_val = temp_data[idx2];
        }
        data_type = rep.key[i2].data_type;
        //save record
        if (i2 > 0 && data_flag == 1 && rep.data_3d) {
            if (phpflag == 1) {
                column_name = temp_data.getColumnLabel(col);
                res2 = {
                    key_val: rep.key[i2][COLUMN_NAME] + "='" + column_name + "'"

                }
                res2.key_val_str = res2.key_val;

            } else {
                column_name = temp_data.getColumnLabel(col);
                res2 = {
                    key_val: column_name,
                    key_val_str: column_name
                }
            }

        } else {
            res2 = BuildKeyChild(data_flag, data_type, key_val, phpflag, rep.key[i2][COLUMN_NAME]);
        }
        if (temp_colum_idx == 0) {
            res.search_key = res2.key_val_str;
        } else {
            res.search_key = res.search_key + "{B4t45}" + res2.key_val_str;
        }
        if (phpflag == 1) {
            if (rep.key[i2].df_flag==1) {
                res.temp_rec2_df.push(res2.key_val);
            } else {
                res.temp_rec2.push(res2.key_val);
            }
        } else {
            
            res.temp_rec2.push(res2.key_val);
           
        }
         temp_colum_idx++;

    }
    return res;
}
/*
function doubleClick(report,graph_idx,value_chart) {
    if (report.dblclick!=null && report.dblclick!="null") {
        fdoubleClick(report,graph_idx,value_chart,redirect_gen_url + "&report_name=" +report.dblclick)
    }
}*/


function fdoubleClick(sessionRec,report,graph_idx,value_chart,dblclick,COLUMN_NAME="COLUMN_NAME",cascade_filter=false) {
        console.log("[" + graph_idx + ":DOUBLE_CLICK]");
        
            var res = BuildKey(report, value_chart, 2, 0, 1, 1,COLUMN_NAME);
            console.log("[" + graph_idx+ ":SELECT] chart:redirect " + graph_idx + res.search_key);
            var key_str;
            //var key_str = filter_where;
            if (cascade_filter) {
                key_str = sessionRec.filter_where;
            } else {
                key_str = "";
            
            }
            for (let i2 = 0; i2 < res.temp_rec2.length; i2++) {
                if (key_str == "") {
                    key_str = res.temp_rec2[i2];
                } else {
                    key_str = key_str + " and " + res.temp_rec2[i2];

                }

            }
            var key_str_df;
            if (cascade_filter) {
                key_str_df = sessionRec,sessionRec.filter_where_df;
            } else {
                key_str_df = "";
            }
            for (let i2 = 0; i2 < res.temp_rec2_df.length; i2++) {
                if (key_str_df == "") {
                    key_str_df = res.temp_rec2_df[i2];
                } else {
                    key_str_df = key_str_df + " and " + res.temp_rec2_df[i2];

                }

            }
            var redirect_url = dblclick + "&filter_where=" + key_str + "&filter_where_df=" + key_str_df;
            console.log("[" + graph_idx + ":SELECT] chart:redirect* " + redirect_url);
            window.location.href = redirect_url;
        
    };
    function singleClick(sessionRec,report,graph_idx,value_chart) {
        var res = BuildKey(report, value_chart, 2);
        console.log("[" + graph_idx + ":SELECT] chart:select " + sessionRec.graphData[graph_idx].selected_value + " " + res.search_key + " idx:" + sessionRec.graphData[graph_idx].idx+" ");
        if (res.search_key != sessionRec.graphData[graph_idx].selected_value) {
            sessionRec.graphData[graph_idx].selected_value = res.search_key;
            var p_obj = document.getElementById("w"+(graph_idx+1)+"_param2");
            if (p_obj != null) {
                p_obj.style.display = "block";
                p_obj.innerHTML = "<b>filter:</b><br>" + res.search_key.replace("{B4t45}", "-");
            }
            setTimeout(function () {
                execSelect(sessionRec);
            }, 1000);
        } else {
            
            //doubleClick(report,graph_idx,value_chart);
        }
    }

