
/*
 *              value: $val,
                count: 0,
                count2: 1, 
                max_val: $val,
                min_val: $val
 */
function function1(name,data) {
    
   return data[1].value*1000

}

function function2(name,data) {
   return data[12];

}

function ExecuteJavaScript(name,data) {
    if (name=="function1") {
       return function1(name,data);
    } else if (name=="function2") {
       return function2(name,data);
    }else  {
       return null; 
    }
}



