

function BuildEditParameter(report, i2, var_value2, rec_detail) {
    detail_type = report.field[i2].data_type;
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
    } else if (detail_type == "int") {
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
    } else {
         rec_detail.value = var_value2;
    }
}
function BuildNewParameter(report, i2, val_data) {
    let detail_type = report.field[i2].data_type;
    let detail_type2 = report.field[i2].data_type2;
    if (detail_type == "float") {
        $val = parseFloat(val_data);
        var rec_detail = {
            value: $val,
            count: 1,
            max_val: $val,
            min_val: $val
        }
    
    } else if (detail_type == "int") {
    
        $val = parseInt(val_data);
        var rec_detail = {
            value: $val,
            count: 1,
            max_val: $val,

            min_val: $val
        }
    } else {
        $val = val_data;
        var rec_detail = {
            value: $val
        }
    }
    return rec_detail;
}


function CalculateParameter(report, colum_idx, v) {
    var result_data_detail = [];
    for (let i2 = 0; i2 < colum_idx; i2++) {
        result_data_detail.push(v[i2]);
        //console.log("[" + idx + ":load_report] key: " + v[i2]);

    }

    for (let i2 = 0; i2 < report.field.length; i2++) {

        var rec_detail = v[i2 + colum_idx];
        //console.log("[" + idx + ":load_report] val: " + rec_detail.value);
        detail_type = report.field[i2].data_type;
        detail_type2 = report.field[i2].data_type2;
        if ((detail_type == "int") ||
                (detail_type == "float")
                ) {
            if (detail_type2 == "avg") {
                result_data_detail.push(rec_detail.value / rec_detail.count);
            } else if (detail_type2 == "max") {
                result_data_detail.push(rec_detail.max_val);
            } else if (detail_type2 == "min") {
                result_data_detail.push(rec_detail.min_val);
            } else {
                result_data_detail.push(rec_detail.value);
            }
        } else {
            result_data_detail.push(rec_detail.value);
        }
    }
    return result_data_detail;
}


