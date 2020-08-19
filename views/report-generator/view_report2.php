<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;


$this->title = str_replace('.json', '', $folder) ;
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<menu id="menu_popup" class="menu">

</menu>

<style>
    .menu {
  position: absolute;
  width: 200px;
  padding: 2px;
  margin: 0;
  border: 1px solid #bbb;
  background: #eee;
  background: -webkit-linear-gradient(to bottom, #fff 0%, #e5e5e5 100px, #e5e5e5 100%);
  background: linear-gradient(to bottom, #fff 0%, #e5e5e5 100px, #e5e5e5 100%);
  z-index: 100;
  border-radius: 3px;
  box-shadow: 1px 1px 4px rgba(0,0,0,.2);
  opacity: 0;
  -webkit-transform: translate(0, 15px) scale(.95);
  transform: translate(0, 15px) scale(.95);
  transition: transform 0.1s ease-out, opacity 0.1s ease-out;
  pointer-events: none;
}

.menu-item {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  white-space: nowrap;
}

.menu-btn {
  background: none;
  line-height: normal;
  overflow: visible;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  display: block;
  width: 100%;
  color: #444;
  font-family: 'Roboto', sans-serif;
  font-size: 13px;
  text-align: left;
  cursor: pointer;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 8px;
  border-radius: 3px;
}
 .menu-btn::-moz-focus-inner, .menu-btn::-moz-focus-inner {
 border: 0;
 padding: 0;
}

.menu-text { margin-left: 25px; }

.menu-btn .fa {
  position: absolute;
  left: 8px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}

.menu-item:hover > .menu-btn {
  color: #fff;
  outline: none;
  background-color: #2E3940;
  background: -webkit-linear-gradient(to bottom, #5D6D79, #2E3940);
  background: linear-gradient(to bottom, #5D6D79, #2E3940);
  border: 1px solid #2E3940;
}

.menu-item.disabled {
  opacity: .5;
  pointer-events: none;
}

.menu-item.disabled .menu-btn { cursor: default; }

.menu-separator {
  display: block;
  margin: 7px 5px;
  height: 1px;
  border-bottom: 1px solid #fff;
  background-color: #aaa;
}

.menu-item.submenu::after {
  content: "";
  position: absolute;
  right: 6px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  border: 5px solid transparent;
  border-left-color: #808080;
}

.menu-item.submenu:hover::after { border-left-color: #fff; }

.menu .menu {
  top: 4px;
  left: 99%;
}

.show-menu, .menu-item:hover > .menu {
  opacity: 1;
  -webkit-transform: translate(0, 0) scale(1);
  transform: translate(0, 0) scale(1);
  pointer-events: auto;
}

.menu-item:hover > .menu {
  -webkit-transition-delay: 100ms;
  transition-delay: 300ms;
}
    </style>
    
    <script>
    var menu;
    var last_report;
    var last_graph_idx;
    var last_value_chart;
    var session_no=0;
    
    function showMenu(obj_id,x, y,menu_str,report,graph_idx,value_chart){
        if (report["action"]!=null && report["action"].length>0 || 
                (report["dblclick"]!=null && report["dblclick"]!="null")) {
            last_report=report;
            last_graph_idx=graph_idx;
            last_value_chart=value_chart;
            menu=document.getElementById(obj_id);
            menu.innerHTML=menu_str;
            menu.style.left = x + 'px';
            menu.style.top = y + 'px';
            menu.classList.add('show-menu');
            document.addEventListener('click', onClick, true);
        } else if (report["selection_flag"]>0) {
            singleClick(sessionMap[session_no],report, graph_idx, value_chart);
        }
    }

    function hideMenu(){
        menu.classList.remove('show-menu');
    }

    
    function onClick(e){
        console.log("click ",e.pageX, e.pageY);
        hideMenu();
        document.removeEventListener('click', onClick);
    }

    function menuExec(cmd){
       //if (cmd==1) {
           singleClick(sessionMap[session_no],last_report, last_graph_idx, last_value_chart);
       /*} else if (cmd==2) {
           doubleClick(last_report, last_graph_idx, last_value_chart);
       }*/
        
        
    }
    function menuExec2(id){
        console.log("menuExec2 ",id);
        sessionRec=sessionMap[session_no];
        action=last_report["action"][id];
        if (action.type==0) {
            //redirect
            redirect_url = action.url+encodeURI(JSON.stringify(last_value_chart));
            console.log("[" + last_graph_idx + ":action] chart:redirect " + redirect_url);
            window.location.href = redirect_url;
        } else if (action.type==1) {
            //ajax
            redirect_url = action.url;
            data={result:last_value_chart};
            console.log("[" + last_graph_idx + ":action] chart:Ajax. " + redirect_url,data);
            $.ajax({
                url: redirect_url,
                type: 'post',
                dataType: 'json',
                data: data,
            
                })
                .done(function(response) {
                    if (response.data.success == true) {
                        console.log( response );
                        //alert('deleted');

                    }

                })
                .fail(function() {
                    alert("fail");

                });
        } else if (action.type==2){
            redirect_url = sessionRec.redirect_gen_url + "&report_name=" +action.url;
            console.log("[" + last_graph_idx + ":action] chart:Report " + redirect_url);
            if (action.COLUMN_NAME!=null) {
               fdoubleClick(sessionRec,last_report, last_graph_idx, last_value_chart,redirect_url,action.COLUMN_NAME,action.cascade_filter);
               
            } else {
               fdoubleClick(sessionRec,last_report, last_graph_idx, last_value_chart,redirect_url,"COLUMN_NAME",action.cascade_filter);  
            }
        } else if (action.type==3){
            redirect_url = action.url;
            console.log("[" + last_graph_idx + ":action] chart:Report " + redirect_url);
            if (action.COLUMN_NAME!=null) {
                fdoubleClick(sessionRec,last_report, last_graph_idx, last_value_chart,redirect_url,action.COLUMN_NAME,action.cascade_filter);
            } else {
                fdoubleClick(sessionRec,last_report, last_graph_idx, last_value_chart,redirect_url,"COLUMN_NAME",action.cascade_filter);
            }
        } else if (action.type==4){
            func_name="action_call_"+last_graph_idx.toString()+"_"+(id).toString();
            console.log("[" + last_graph_idx + ":func_name: " + func_name);
            //result_data_detail.push(window[func_name](action,last_report, last_graph_idx, last_value_chart));
            window[func_name](action,last_report, last_graph_idx, last_value_chart);
            
        }
    }
    
    </script>
<div class="report-generator-index" style="margin-top: -40px;">
    <h1><?= Html::encode($this->title); ?></h1>

<?
if ($dashboard_name=="") $dashboard_name="_dashboard_chart2a";
    
//if ($filter_where==""){
    
if ($mode==2){  
} else {
    // echo "<div class='col-sm-12'>";
}


echo $this->render("_active_form", [
                        'model' => $model,
                        'column' => $column,
                        'use_column'=>$use_column,
                        'mode'=> $mode,
                        'builder'=>$builder,
                        'folder' => $folder, 
                        'report' => $report,
                        'filter_advance'=>$filter_advance,
                        'report_name' => $report_name,
                        'ajax_mode'=>$ajax_mode,
                        'can_build'=>$can_build,
                        'can_update'=>$can_update,
                        'dashboard_name'=>$dashboard_name,
                        'db_id'=>$db_id,
                        'filter_where'=>$filter_where,
                        "filter_where_df"=>$filter_where_df,
                        'report_db_id'=>$report_db_id
                    ]);
if ($mode==2){  
} else {
    echo '</div>';
}
     
     
//}

if (!$new_flag){
    //$url_b='https://icloud.icode.id/index.php?r=report-generator/get-data-report3'. '&folder='.$folder. '&report_name=' . $report_name;
    if ($realtime_url!="") {
        $url_b=$realtime_url. '&folder='.$folder. '&report_name=' . $report_name;
    } else {
        $url_b="";
    }
    
    echo $this->render($dashboard_name, [
        'url' => Url::to(['//report-generator/get-data-report3', 'folder' => $folder, 'report_name' => $report_name,'debug_flag'=>$debug_flag]),
        'url_b' => $url_b,
        'url2' => Url::to(['//report-generator/get-data-report4', 'folder' => $folder,'limit'=>$limit,'debug_flag'=>$debug_flag]),
        'timeout' => $timeout,
        'report' => $report,
        'folder' =>$folder,
        'andWhere'=>$andWhere,
        'andWhere_df'=>$andWhere_df,
        'filter_where'=>$filter_where,
        'filter_where_df'=>$filter_where_df,
        'limit'=>$limit,
        'builder'=>$builder,'report_name' => $report_name,
        'dashboard_option'=>$dashboard_option,
        'dashboard_backgrond'=>$dashboard_backgrond,
        "page_mode"=>$page_mode,
        "mode"=>$mode,
        'report_db_id'=>$report_db_id
        
            
    ]);
} else {
    echo "please choose a filter!";
};



 $this->registerCss('.paddingb {padding-bottom: 10px;padding-top: 10px;padding-right: 10px;padding-left: 10px;}');
 $this->registerCss('.paddingb2 {padding-right: 5px;padding-left: 5px;}');
        
        
?>

  
        

<?    Modal::begin([
        'options' => [ 
               'id' => 'ReportGeneratormyModal', 
               'tabindex' => false  
           ], 
        'header' => 'Modal',
        'id' => 'ReportGeneratormyModal',
        'size' => 'modal-md',
    ]);
    echo "<div  id='ReportGeneratormodalContent'></div>";
    Modal::end();

    
    
    
$js=<<<js
    
        
    $('.ReportGeneratormodalButton').on('click', function () {
        console.log( 'ReportGeneratormodalButton.click' );
        $('#ReportGeneratormyModal').modal('show')
                //.draggable()
                .find('#ReportGeneratormodalContent')
                .load($(this).attr('value'));
    });
    $('.ReportGeneratormodalButton2').on('click', function () {
        console.log( 'ReportGeneratormodalButton2.click' );
        window.location.replace($(this).attr('value'));
        
    });    
        
        
        
        
    $('.ReportGeneratorajaxButton').on('click', function () {
        console.log( 'ajaxButton.click' );
        event.preventDefault(); // stopping submitting
        event.stopImmediatePropagation();
        var data = $(this).serializeArray();
        var url = $(this).attr('value');
        console.log( url );
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            
        })
        .done(function(response) {
            if (response.data.success == true) {
                console.log( response );
                //alert('deleted');
                
            }

        })
        .fail(function() {
            alert("fail");

        });
        return false;
        
        
    }); 
    $("#ReportGeneratormyModal").on('hide.bs.modal', function(){
        console.log( 'ReportGeneratormodalButton.close' );
        try {        
            console.log('model.close' );
            $('#ReportGeneratormodalContent').empty();
            
        } catch(err) {
            console.log( 'exception : '+err );
            
        }
    });
 
js;

if ($builder==1) {
    
    $js="$.noConflict();".$js;
}
$this->registerJs($js);
if ($builder==1) {
    
    //$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js',['position' => View::POS_HEAD]);
    $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js',['position' => View::POS_HEAD]);
    $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js',['position' => View::POS_HEAD]);
    //$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',['position' => View::POS_HEAD]);
    //$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',['position' => View::POS_HEAD]);

} 

  
 //Pjax::end(); 
?>  

</div>





