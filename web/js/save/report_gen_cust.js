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
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "YEAR(" + column_name + ")=" + dt.getFullYear();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getFullYear();
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
        //key_val_str=key_val;
    } else if (data_type == "mm") {
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "MONTH(" + column_name + ")=" + dt.getMonth() + 1;
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getMonth() + 1;
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
        //key_val_str=key_val;
    } else if (data_type == "dd") {
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "DAY(" + column_name + ")=" + dt.getDate();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getDate();
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
    } else if (data_type == "hh") {
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "HOUR(" + column_name + ")=" + dt.getHours();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getHours();
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
    
    } else if (data_type == "nn") {
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "MINUTE(" + column_name + ")=" + dt.getMinutes();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getMinutes();
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
    } else if (data_type == "ss") {
        if (data_flag == 0) {
            let dt = new Date(res.key_val);
            if (phpflag == 1) {
                res.key_val = "SECOND(" + column_name + ")=" + dt.getSeconds();
                res.key_val_str = res.key_val;
            } else {
                res.key_val = dt.getSeconds();
                res.key_val_str = res.key_val.toString();
            }
        } else {

        }
    } else if (data_type == "time") {
        let dt = new Date(res.key_val);
        if (phpflag == 1) {
            res.key_val = "CONVERT(" + column_name + ",TIME)='" + dt.getHours() + ":" + (dt.getMinutes() + 1) + ":" + dt.getSeconds() + "'";
            res.key_val_str = res.key_val;

        } else {
            res.key_val = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
            res.key_val_str = JSON.stringify(res.key_val);
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
        }

    } else if (data_type == "float") {
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

function BuildKey(rep, temp_data, data_flag = 0, row = 0, col = 1, phpflag = 0) {

    temp_colum_idx = 0;
    var res = {
        search_key: "",
        temp_rec2: []
    }

    for (let i2 = 0; i2 < rep.key.length; i2++) {
        let idx2 = rep.key[i2].field_no;
        if (data_flag == 1) {
            key_val = temp_data.getValue(row, i2);
        } else {
            key_val = temp_data[idx2];
        }
        data_type = rep.key[i2].data_type;
        //save record
        if (i2 > 0 && data_flag == 1 && rep.data_3d) {
            if (phpflag == 1) {
                column_name = temp_data.getColumnLabel(col);
                res2 = {
                    key_val: rep.key[i2].COLUMN_NAME + "='" + column_name + "'"

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
            res2 = BuildKeyChild(data_flag, data_type, key_val, phpflag, rep.key[i2].COLUMN_NAME);
        }
        /*
         key_val_str = key_val;
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
         }*/
        if (temp_colum_idx == 0) {
            res.search_key = res2.key_val_str;
        } else {
            res.search_key = res.search_key + "{B4t45}" + res2.key_val_str;
        }
        temp_colum_idx++;
        res.temp_rec2.push(res2.key_val);

    }
    return res;
}

