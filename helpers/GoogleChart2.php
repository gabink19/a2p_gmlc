<?php

namespace app\helpers;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;
?>


<style>
    .box_select {
        position: absolute;
        border-style: solid;
        border-radius: 5px;
        width: 140px;
        height: auto;
        border-width: thin;
        background-color: rgba(0,255,0,0.9);
        border-color: green;
    }
    .value_select_style {
        color:black;
        font-size: 10px;
        position: absolute;
        left: 5px;
        top: 0px;
    }
</style>

<?


/**
 * An widget to wrap google chart for Yii Framework 2
 * by Scott Huang
 *
 * @see https://github.com/ScottHuangZL/yii2-google-chart
 * @author Scott Huang <zhiliang.huang@gmail.com>
 * @since 0.2
 * @Xiamen China
 */
class GoogleChart2 extends Widget
{
    public $selection_flag;
    public $report;
    public $message;
    public $folder;
    /**
     * @var string $containerId the container Id to render the visualization to
     */
    public $containerId;
    public $idx=0;

    /**
     * @var string $visualization the type of visualization -ie PieChart
     * @see https://google-developers.appspot.com/chart/interactive/docs/gallery
     */
    public $visualization;

    /**
     * @var string $packages the type of packages, default is corechart
     * @see https://google-developers.appspot.com/chart/interactive/docs/gallery
     */
    public $packages = 'corechart';  // such as 'orgchart' and so on.

    public $loadVersion = "1"; //such as 1 or 1.1  Calendar chart use 1.1.  Add at Sep 16

    /**
     * @var array $data the data to configure visualization
     * @see https://google-developers.appspot.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
     */
    public $data = array();
    //public $url = "https://icloud.icode.id/index.php?r=g-sensor-db/get-data-map&master_id=1";
    //public $timeout=5000;
    public $url="";
    public $url_b="";
    public $url2="";
    public $andWhere;
    public $andWhere_df;
    public $filter_where;
    public $filter_where_df;
    public $limit;
    public $timeout=0;
    public $extend_js="";
    public $page_mode=0;
    /**
     * @var array $options additional configuration options
     * @see https://google-developers.appspot.com/chart/interactive/docs/customizing_charts
     */
    public $options = array();
    
    /**
     * @var string $scriptAfterArrayToDataTable additional javascript to execute after arrayToDataTable is called
     */
    public $scriptAfterArrayToDataTable = '';

    /**
     * @var array $htmlOption the HTML tag attributes configuration
     */
    public $htmlOptions = array();

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {

        $id = $this->getId();
        if (isset($this->options['id']) and !empty($this->options['id'])) $id = $this->options['id'];
        // if no container is set, it will create one
        if ($this->containerId == null) {
            $this->htmlOptions['id'] = 'div-chart' . $id;
            $this->containerId = $this->htmlOptions['id'];
            
            echo '<div ' . Html::renderTagAttributes($this->htmlOptions) . '></div>';
            echo '<p id="'.$this->idx.'_param2" style="display:none;position: absolute;left:10px;top:40px" class="value_select_style box_select"></p>';
        }
        $this->registerClientScript($id);
        
        echo $this->render('//report-generator/init_js.php',["id"=>$id,"options"=>$this->options,'rep'=>$this->report,"idx"=>$this->idx,"url"=>$this->url,
                    'andWhere'=>$this->andWhere,
                    'filter_where'=>$this->filter_where,
                    ]);
        //return Html::encode($this->message);
    }

    /**
     * Registers required scripts
     */
    public function registerClientScript($id)
    {

        $jsData = Json::encode($this->data);
        $jsOptions = Json::encode($this->options);
/*
        $script = '         var graphRec={};
                            folder="'.$this->folder.'";
                            timeout='.$this->timeout.';
                            page_mode='.$this->page_mode.';
                            graphRec.report_type=0;    
                            graphRec.containerId="' . $this->containerId . '";
                            graphRec.visualization="' . $this->visualization . '";
                            graphRec.options = ' . $jsOptions . ';
                            graphRec.columns = [];
                            graphRec.series={};
                            graphRec.selected_value = null;
                            graphRec.selection_flag=' . $this->selection_flag . ';
                            graphRec.idx='.$this->idx.';  
                            graphData.push(graphRec);   
                            
                            if (initFlag) {
                                andWhere="'.$this->andWhere.'";
                                andWhere_df="'.$this->andWhere_df.'";
                                filter_where="'.$this->filter_where.'";
                                filter_where_df="'.$this->filter_where_df.'";
                                limit="'.$this->limit.'";
                                report_gen_url="'.$this->url.'";
                                report_gen_url2="'.$this->url_b.'";
                                redirect_gen_url="'.$this->url2.'";
                                console.log("url:"+report_gen_url);
                                console.log("url2:"+redirect_gen_url);
                                document.addEventListener("DOMContentLoaded", function(event) { 
                                    drawChart();
                                  });
                                initFlag=false;
                            };
                            if (initGoogleFlag) {
                                //google.setOnLoadCallback(drawChart);
                                initGoogleFlag=false;
                            };
                            ';*/
        
        
        $script = '         
                            sessionRec=sessionMap[0];
                            if (sessionRec==null) {
                                sessionRec={};
                                sessionRec.sessionId=0;
                                sessionRec.graphData=[];
                                sessionRec.initFlag = true;
                                sessionRec.initGoogleFlag = true;
                                sessionRec.visualization = "Table";
                                sessionRec.containerId = "";

                                sessionRec.timeout = 10000;
                                sessionRec.redirect_gen_url = "";
                                sessionRec.last_index = -1;
                                sessionRec.var_andWhere = "";
                                sessionRec.var_andWhere_df = "";
                                sessionRec.sql_df_where = "";
                                sessionMap[0]=sessionRec;
                            }
                            var graphRec={};
                            sessionRec.folder="' . $this->folder . '";
                            sessionRec.timeout=' . $this->timeout . ';
                            sessionRec.page_mode=' . $this->page_mode . ';
                            graphRec.report_type=1;    
                            graphRec.visualization="' . $this->visualization . '";
                            graphRec.methode="' . $this->visualization . $id . '";    
                            graphRec.options = ' . $jsOptions . ';
                            graphRec.idx=' . $this->idx . ';
                            graphRec.selected_value = null;
                            graphRec.selection_flag=' . $this->selection_flag . ';
                            sessionRec.graphData.push(graphRec);    
                            if (sessionRec.initFlag) {
                                sessionRec.andWhere="' . $this->andWhere . '";
                                sessionRec.andWhere_df="' . $this->andWhere_df . '";
                                sessionRec.filter_where="' . $this->filter_where . '";
                                sessionRec.filter_where_df="' . $this->filter_where_df . '";
                                sessionRec.limit="' . $this->limit . '";
                                sessionRec.report_gen_url="' . $this->url . '";
                                sessionRec.report_gen_url2="' . $this->url_b . '";
                                sessionRec.redirect_gen_url="' . $this->url2 . '";
                                console.log("url:"+sessionRec.report_gen_url);
                                console.log("url2:"+sessionRec.redirect_gen_url);
                             
                                document.addEventListener("DOMContentLoaded", function(event) { 
                                    
                                        drawChart(sessionRec);
                                    
                                  });
                                    
                               
                                sessionRec.initFlag=false;
                            };
                            ';
        
        

        $view = $this->getView();
        $view->registerJsFile('https://www.google.com/jsapi',['position' => View::POS_HEAD]);
        $view->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyAhNAJi4QQGTBor6-uDEmhseLJe7b67o9Y',['position' => View::POS_HEAD]);
        $view->registerJs('google.load("visualization", "' . $this->loadVersion . '", {packages:["' . $this->packages . '"]});', View::POS_HEAD, __CLASS__ . '#' . $id);
        
        $view->registerJsFile('@web/js/report_gen_user_cust.js',['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen_cust.js',['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen_cust2.js',['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen.js',['position' => View::POS_HEAD]);
        if ($this->extend_js!="") {
            $script=$script. str_replace("final_process_report", "process_report_".$this->idx, $this->extend_js);
            
        }
        $view->registerJs($script, View::POS_HEAD, $id);
    }

}
