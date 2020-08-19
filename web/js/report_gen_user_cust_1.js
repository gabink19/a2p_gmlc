
function final_process_report(idx,report,rec_pertama,result_data) {
   console.log("[" + idx + ":load_report] extended java for table init:rec_pertama: ", rec_pertama);
    console.log("[" + idx + ":load_report] extended java for table init:rec_data: ", result_data);
    
   result_data2 = [];
    rec_pertama2 = [];


    for (let i2 = 0; i2 < report.key.length; i2++) {

        
            rec_pertama2.push(rec_pertama[i2]);
        
    }
    for (let i2 = 0; i2 < report.field.length; i2++) {

        
            rec_pertama2.push(rec_pertama[i2 + report.key.length]);
        
    }



    for (let i3 = 0; i3 < result_data.length; i3++) {
        var_value = result_data[i3];
        result_detail2 = [];

        for (let i2 = 0; i2 < report.key.length; i2++) {
            
                result_detail2.push(var_value[i2]);
            
        }
        for (let i2 = 0; i2 < report.field.length; i2++) {
           /* if (i2==0){
                result_detail2.push("xxxx");
            } else {
                result_detail2.push(var_value[i2 + report.key.length]);
            }*/
            result_detail2.push(var_value[i2 + report.key.length]);
        }


        result_data2.push(result_detail2);
    }
    console.log("[" + idx + ":load_report] extended java for table result:rec_pertama: ", rec_pertama2);
    console.log("[" + idx + ":load_report] extended java for table result:rec_data: ", result_data2);
    result_data = result_data2;
    rec_pertama = rec_pertama2;
   return {
      rec_pertama:rec_pertama, 
      result_data:result_data 
     
   }
       
    

}




