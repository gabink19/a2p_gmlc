

function checkFilter(idx,report_filter,temp_data){
    //console.log("[" + idx + ":filter* checking ")
    var iqnore = false;
    if (report_filter != null) {
        //console.log("[" + idx + ":report_filter]");
        for (let i3 = 0; i3 < report_filter.length; i3++) {
            let idx2 = report_filter[i3].field_seq;
            key_val = temp_data[idx2];
            data_type = report_filter[i3].data_type;
            //save record
            res2 = BuildKeyChild(0, data_type, key_val);
                if (report_filter[i3].operation_type == 1) {
                res_bool = false;
                for (let i4 = 0; i4 < report_filter[i3].value.length; i4++) {
                    res_bool = res_bool | res2.key_val_str == report_filter[i3].value[i4];
                }
                ;
                if (res_bool) {
                    //console.log("[" + idx + ":filter* match " + res2.key_val_str + " - " + report_filter[i3].value)

                } else {
                    //("[" + idx + ":filter* not match " + res2.key_val_str + " - " + report_filter[i3].value);
                    iqnore = true;
                    break
                }
            } else if (report_filter[i3].operation_type == 0) {
                res_bool = true;
                for (let i4 = 0; i4 < report_filter[i3].value.length; i4++) {
                    res_bool = res_bool & res2.key_val_str != report_filter[i3].value[i4];
                }
                if (res_bool) {
                    //console.log("[" + idx + ":filter* match " + res2.key_val_str + " - " + report_filter[i3].value)

                } else {
                    //("[" + idx + ":filter* not match " + res2.key_val_str + " - " + report_filter[i3].value);
                    iqnore = true;
                    break;
                }
            }


        }
    }
    return iqnore;
}

function BuildEditParameter(report, i2, var_value2, rec_detail,full_row=null,idx=0) {
    detail_type = report.field[i2].data_type;
    detail_type2 = report.field[i2].data_type2;
    colum_idx=report.key.length;
    if (detail_type == "float"|| detail_type == "double"|| detail_type == "extended") {
        if (detail_type2 != "first") {
            ignore=false;
            if (full_row!=null) {
                iqnore=checkFilter(idx,report.field[i2].filter,full_row);
            }
            rec_detail.count2 = rec_detail.count2 + 1;
            if (iqnore) {
                
            } else {
                var var_val=0;
                data_type_ext2=report.field[i2].data_type_ext2;
                if (full_row!=null && data_type_ext2!=null) {
                    func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                    //console.log("[" + idx + "edit1:func_name: " + func_name," data:",full_row);
                    var_val=parseFloat(window[func_name](full_row));
                    //("[" + idx + ":func_name: " + var_val);
                //} else {
                //if (full_row!=null && detail_type=="extended"){
                //   var_val=ExecuteJavaScript(report.field[i2].data_type3,full_row);
                } else {
                    var_val = parseFloat(var_value2);
                    
                }
                //rec_detail.value = rec_detail.value + $val;
                if (detail_type2 == "last") {
                    rec_detail.value = var_val;
                } else {
                    rec_detail.value = rec_detail.value + var_val;
                }

                rec_detail.count = rec_detail.count + 1;
                if (rec_detail.max_val < var_val) {
                    rec_detail.max_val = var_val;
                }
                if (rec_detail.min_val > var_val) {
                    rec_detail.min_val = var_val;
                }
            }
        }
    } else if (detail_type == "int") {
        if (detail_type2 != "first") {
            ignore=false;
            if (full_row!=null) {
                iqnore=checkFilter(idx,report.field[i2].filter,full_row);
            }
            rec_detail.count2 = rec_detail.count2 + 1;
            if (iqnore) {
                
            } else {
                data_type_ext2=report.field[i2].data_type_ext2;
                if (full_row!=null && data_type_ext2!=null) {
                    func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                    //console.log("[" + idx + " edit2:func_name: " + func_name," data:",full_row);
                    $val=parseInt(window[func_name](full_row));
                    //console.log("[" + idx + ":func_name: " + $val);
                } else {
                    $val = parseInt(var_value2);
                }
                if (detail_type2 == "last") {
                    rec_detail.value = $val;
                } else {
                    rec_detail.value = rec_detail.value + $val;
                    }
                rec_detail.count = rec_detail.count + 1;
                if (rec_detail.max_val < $val) {
                    rec_detail.max_val = $val;
                }
                if (rec_detail.min_val > $val) {
                    rec_detail.min_val = $val;
                }
            }
        }
    } else if (detail_type == "varchar" || detail_type == "string"){
         iqnore=false;
         if (full_row!=null) {
                iqnore=checkFilter(idx,report.field[i2].filter,full_row);
         }
         if (iqnore) {
             
         } else {
            data_type_ext2=report.field[i2].data_type_ext2;
            if (full_row!=null && data_type_ext2!=null) {
                func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                //console.log("[" + idx + " edit3:func_name: " + func_name," data:",full_row);
                $val=window[func_name](full_row);
                //console.log("[" + idx + ":func_name: " + $val);
            } else {
                $val=var_value2;
            }
            if (detail_type2 == "last") {
                rec_detail.value = $val;
            } else if (detail_type2 == "first") {

            } else {
               if (rec_detail.value==null){
                   rec_detail.value = $val;
               } else {
                   if (!rec_detail.value.includes(var_value2)){
                       rec_detail.value = rec_detail.value+","+$val;
                   }
               }
            }
        }
    } else {
        rec_detail.value = var_value2;
    }
}
function BuildNewParameter(report, i2, val_data,full_row=null,idx=0) {
    colum_idx=report.key.length;
    let detail_type = report.field[i2].data_type;
    let detail_type2 = report.field[i2].data_type2;
    if (detail_type == "float" ||detail_type == "double" ||detail_type == "extended") {
        ignore=false;
        if (full_row!=null) {
            iqnore=checkFilter(idx,report.field[i2].filter,full_row);
        }
        
        if (iqnore) {
            $val = 0.0;
            var rec_detail = {
                value: $val,
                count: 0,
                count2: 1,
                max_val: $val,
                min_val: $val
            }
        } else {
            /*if (full_row!=null && detail_type=="extended"){
                   $val=ExecuteJavaScript(report.field[i2].data_type3,full_row);
                } else {
                    $val = parseFloat(val_data);
                }*/
            data_type_ext2=report.field[i2].data_type_ext2;
            if (full_row!=null && data_type_ext2!=null) {
                func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                //console.log("[" + idx + ":new:func_name: " + func_name," data:",full_row);
                $val=parseFloat(window[func_name](full_row));
                //console.log("[" + idx + ":func_name: " + $val);
           } else {
                $val = parseFloat(val_data);
            }
            var rec_detail = {
                value: $val,
                count: 1,
                count2: 1,
                max_val: $val,
                min_val: $val
            }
        }
    
    } else if (detail_type == "int") {
        ignore=false;
        if (full_row!=null) {
            iqnore=checkFilter(idx,report.field[i2].filter,full_row);
        }
        if (iqnore) {
            $val = 0;
            var rec_detail = {
                value: $val,
                count: 0,
                count2: 1, 
                max_val: $val,
                min_val: $val
            }
        } else {
            data_type_ext2=report.field[i2].data_type_ext2;
            if (full_row!=null && data_type_ext2!=null) {
                func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                console.log("[" + idx + ":new2:func_name: " + func_name," data:",full_row);
                $val=parseInt(window[func_name](full_row));
                console.log("[" + idx + ":func_name: " + $val);
           } else {
                $val = parseInt(val_data);
            }
            
            var rec_detail = {
                value: $val,
                count: 1,
                count2: 1,
                max_val: $val,

                min_val: $val
            }
        }
    } else {
        iqnore=false;
         if (full_row!=null) {
                iqnore=checkFilter(idx,report.field[i2].filter,full_row);
         }
         if (iqnore) {
             
         } else {
            data_type_ext2=report.field[i2].data_type_ext2;
            if (full_row!=null && data_type_ext2!=null) {
                func_name="report_calc2_"+idx.toString()+"_"+(i2+ colum_idx).toString();
                console.log("[" + idx + ":new3:func_name: " + func_name," data:",full_row);
                $val=window[func_name](full_row);
                console.log("[" + idx + ":func_name: " + $val);
           } else {
                $val = val_data;
            } 
            
            var rec_detail = {
                value: $val
            }
        }
    }
    return rec_detail;
}


function CalculateParameter(report, colum_idx, v,report_idx) {
    var result_data_detail = [];
    for (let i2 = 0; i2 < colum_idx; i2++) {
        data_type_ext=report.key[i2].data_type_ext;
       
        if (data_type_ext==null) {
             res_v=v[i2];
        } else {
            func_name="report_calc_"+report_idx.toString()+"_"+i2.toString();
            console.log("[" + report_idx + ":func_name: " + func_name+" v:",v," real:"+v[i2]);
            res_v=window[func_name](v,v[i2]);
            console.log("[" + report_idx + ":func_name: " + func_name+" res:"+res_v+" data_type_ext:"+data_type_ext);
        };
        result_data_detail.push(res_v);
        

    }

    for (let i2 = 0; i2 < report.field.length; i2++) {

        var rec_detail = v[i2 + colum_idx];
        //console.log("[" + idx + ":load_report] val: " + rec_detail.value);
        detail_type = report.field[i2].data_type;
        detail_type2 = report.field[i2].data_type2;
        if ((detail_type == "int") ||
                (detail_type == "float") ||
                (detail_type == "double")
                ) {
            if (rec_detail.count<=0) {
                result_data_detail.push("");
            } else {
                data_type_ext=report.field[i2].data_type_ext;
       
                if (data_type_ext!=null) {
                    
                    func_name="report_calc_"+report_idx.toString()+"_"+(i2+ colum_idx).toString();
                    
                    console.log("[" + report_idx + ":func_name: " + func_name+" v:",v," real:",v[i2+ colum_idx]);
                    res_v=window[func_name](v,v[i2+ colum_idx]);
                    result_data_detail.push(res_v);
                    console.log("[" + report_idx + ":func_name: " + func_name+" res:"+res_v+" data_type_ext:"+data_type_ext);
                //} else if (detail_type2 == "extended"){
                //    result_data_detail.push(ExecuteJavaScript(report.field[i2].data_type4,v));
                } else if (detail_type2 == "persen") {
                    var persen=(rec_detail.count*100 / rec_detail.count2);
                    result_data_detail.push(persen.toFixed(2));
                    //result_data_detail.push(rec_detail.count);
                } else if (detail_type2 == "avg") {
                        num=rec_detail.value / rec_detail.count;
                        num=Math.round(num * 100) / 100;
                        result_data_detail.push(num);

                } else if (detail_type2 == "max") {
                    result_data_detail.push(rec_detail.max_val);
                } else if (detail_type2 == "count") {
                    result_data_detail.push(rec_detail.count);
                } else if (detail_type2 == "min") {
                    result_data_detail.push(rec_detail.min_val);
                } else {
                    result_data_detail.push(rec_detail.value);
                }
            }
        } else {
            if (rec_detail != null) {
                data_type_ext=report.field[i2].data_type_ext;
       
                if (data_type_ext!=null) {
                    
                    func_name="report_calc_"+report_idx.toString()+"_"+(i2+ colum_idx).toString();
                    console.log("[" + report_idx + ":func_name: " + func_name);
                    result_data_detail.push(window[func_name](v,v[i2+ colum_idx]));
                //} else if (detail_type2 == "extended"){
                //    result_data_detail.push(ExecuteJavaScript(report.field[i2].data_type4,v));
                } else {
                    result_data_detail.push(rec_detail.value);
                }
            } else {
                result_data_detail.push("");
            }
        }
    }
    return result_data_detail;
}


