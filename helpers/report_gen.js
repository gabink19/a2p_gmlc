/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function loadReport() {
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
    response_data.push(temp_data);

    //convert data to map
    var map_data = new Map();
    for (let i = 0; i < response_data.length; i++) {
        var temp_data = response_data[i];
        var temp_rec = map_data.get(temp_data[0]);
        if (temp_rec == undefined) {
            console.log("not found map");
            temp_rec = [];
            temp_rec.push(temp_data[0]);
            var rec_detail = {
                value:temp_data[1],
                count:1,
                max_val:temp_data[1],
                min_val:temp_data[1]
            }
            
            temp_rec.push(rec_detail);
            map_data.set(temp_data[0], temp_rec);
        } else {
            
            console.log("found map");
        }

    }

    var result_data = []
    for (let [k, v] of map_data) {
        console.log("Value: " + v);
        detail_type=0;
        if (detail_type==0) {
            result_data.push(v.value);
        } else if (detail_type==1) {
            result_data.push(v.value/v.count);
        } else if (detail_type==2) {
            result_data.push(v.max_val);
        } else if (detail_type==3) {
            result_data.push(v.min_val);
        };
        
    }
}

