<?php

namespace app\helpers;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;

class CustModule extends Widget {

    public $selection_flag;
    public $report;
    public $message;
    public $folder;
    public $containerId;
    public $idx;
    public $visualization;
    public $url = "";
    public $url_b = "";
    public $url2 = "";
    public $andWhere;
    public $andWhere_df;
    public $filter_where;
    public $filter_where_df;
    public $limit;
    public $timeout = 0;
    public $extend_js = "";
    public $page_mode = 0;
    public $options = array();

    public function init() {
        parent::init();
    }

    public function run() {

        $id = $this->getId();
        $this->registerClientScript($id);
        if ($this->visualization == "") {
            return "";
        } else {

            echo $this->render('//report-generator/init_js.php', ["id" => $id, "options" => $this->options, 'rep' => $this->report, "idx" => $this->idx, "url" => $this->url,
                'andWhere' => $this->andWhere,
                'filter_where' => $this->filter_where,
            ]);
            if (isset($this->report["custom_view"])) {
                return $this->render($this->report["custom_view"], ["id" => $id, "options" => $this->options, 'rep' => $this->report, "idx" => $this->idx, "url" => $this->url,
                            'andWhere' => $this->andWhere,
                            'filter_where' => $this->filter_where,
                ]);
            } else {
                return $this->render('//report-generator/' . strtolower($this->visualization) . '.php', ["id" => $id, "options" => $this->options, 'rep' => $this->report, "idx" => $this->idx, "url" => $this->url,
                            'andWhere' => $this->andWhere,
                            'filter_where' => $this->filter_where,
                ]);
            }
        }
    }

    /**
     * Registers required scripts
     */
    public function registerClientScript($id) {

        $jsOptions = Json::encode($this->options);

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

        $view->registerJsFile('@web/js/report_gen_user_cust.js', ['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen_cust.js', ['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen_cust2.js', ['position' => View::POS_HEAD]);
        $view->registerJsFile('@web/js/report_gen.js', ['position' => View::POS_HEAD]);
        if ($this->report["options"]["report_type"] == 2) {
            $view->registerJsFile("https://code.highcharts.com/highcharts.js", ['position' => View::POS_HEAD]);
            $view->registerJsFile("https://code.highcharts.com/modules/data.js", ['position' => View::POS_HEAD]);
            $view->registerJsFile("https://code.highcharts.com/modules/drilldown.js", ['position' => View::POS_HEAD]);
            $view->registerJsFile("https://code.highcharts.com/modules/exporting.js", ['position' => View::POS_HEAD]);
            $view->registerJsFile("https://code.highcharts.com/modules/export-data.js", ['position' => View::POS_HEAD]);
            $view->registerJsFile("https://code.highcharts.com/modules/accessibility.js", ['position' => View::POS_HEAD]);
        }
        $js = $this->report["options"]["js"];
        if ($js != null) {
            foreach ($js as $js_str) {
                $view->registerJsFile($js_str, ['position' => View::POS_HEAD]);
            }
        }
        /*
          if ($this->extend_js!="") {
          $view->registerJsFile($this->extend_js,['position' => View::POS_HEAD]);
          } */
        if ($this->extend_js != "") {
            $script = $script . str_replace("final_process_report", "process_report_" . $this->idx, $this->extend_js);



            //$view->registerJsFile($this->extend_js,['position' => View::POS_HEAD]);
        }
        $view->registerJs($script, View::POS_HEAD, $id);
    }

}
