<?

use yii\helpers\Json;
?>


<script>
    
    <?
    $menu_str="";
    if ($rep["selection_flag"]==1) {
        $menu_str=$menu_str. '<li class="menu-item">';
        $menu_str=$menu_str. '<button type="button" class="menu-btn" onclick="menuExec(1)"> <i class="fa fa-folder-open"></i> <span class="menu-text">filter</span> </button>';
        $menu_str=$menu_str. '</li>';
    };
    /*
    if (isset($rep["dblclick"]) && $rep["dblclick"]!="null") {
        $menu_str=$menu_str. '<li class="menu-item">';
        $menu_str=$menu_str. '<button type="button" class="menu-btn" onclick="menuExec(2)"> <i class="fa fa-folder-open"></i> <span class="menu-text">detail</span> </button>';
        $menu_str=$menu_str. '</li>';
    };*/
    if (isset($rep["action"])) {
        foreach ($rep["action"] as $key=>$val){
            $menu_str=$menu_str. '<li class="menu-item">';
            $menu_str=$menu_str. '<button type="button" class="menu-btn" onclick="menuExec2('.$key.')"> '.$val["icon"].' <span class="menu-text">'.$val["menu"].'</span> </button>';
            $menu_str=$menu_str. '</li>';
            
            if ($rep["action"][$key]['type']==4){
                ?>
                    function action_call_<?= $idx."_".$key ?>(action,report, graph_idx, value_chart){
                        <? echo $rep["action"][$key]['url'] ?>
                    }
                <?
            }
        }; 
    }
    echo "var menu_str".$id."='".$menu_str."';";  
    
    ?>
    <?
    
    
        
        $key=$rep["key"];
        if ($key!=null){
            for ($i2=0;$i2<count($key);$i2++){
                $data_type_ext=$key[$i2]["data_type_ext"];
                if ($data_type_ext!==null){
                    if ($data_type_ext==""){
                        $data_type_ext='""';
                    }


        ?>

                    function report_calc_<?= $idx."_".$i2 ?>(data,value){

                         <?
                         if (strpos($data_type_ext,"return")===false) {
                            //echo "return ".$data_type_ext;
                            echo "return ".$data_type_ext;
                         } else {
                            echo $data_type_ext;
                         };
                         ?>;
                    }

        <?
                }
                $data_type_ext=$key[$i2]["data_type_ext2"];
                if ($data_type_ext2!==null){
                    if ($data_type_ext2==""){
                        $data_type_ext2='""';
                    }


        ?>

                    function report_calc2_<?= $idx."_".$i2 ?>(data){

                         <?
                         if (strpos($data_type_ext2,"return")===false) {
                            //echo "return ".$data_type_ext;
                            echo "return ".$data_type_ext2;
                         } else {
                            echo $data_type_ext2;
                         };
                         ?>;
                    }

        <?
                }
            }
        }
        $field=$rep["field"];
        if ($field!=null){
            for ($i2=0;$i2<count($field);$i2++){
                $data_type_ext=$field[$i2]["data_type_ext"];
                if ($data_type_ext!==null){
                    if ($data_type_ext==""){
                        $data_type_ext='""';
                    }


        ?>

                    function report_calc_<?= $idx."_".($i2+count($key)) ?>(data,value){

                         <?
                         if (strpos($data_type_ext,"return")===false) {
                            echo "return ".$data_type_ext;

                         } else {
                            echo $data_type_ext;
                         };
                         ?>;
                    }

        <?
                }
                $data_type_ext2=$field[$i2]["data_type_ext2"];
                if ($data_type_ext2!==null){
                    if ($data_type_ext2==""){
                        $data_type_ext2='""';
                    }


        ?>

                    function report_calc2_<?= $idx."_".($i2+count($key)) ?>(data){

                         <?
                         if (strpos($data_type_ext2,"return")===false) {
                            echo "return ".$data_type_ext2;

                         } else {
                            echo $data_type_ext2;
                         };
                         ?>;
                    }

        <?
                }
            }
        }
    
    ?>
    
</script>



