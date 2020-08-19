<?php

namespace app\helpers;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;


/**
 * An widget to wrap google chart for Yii Framework 2
 * by Scott Huang
 *
 * @see https://github.com/ScottHuangZL/yii2-google-chart
 * @author Scott Huang <zhiliang.huang@gmail.com>
 * @since 0.2
 * @Xiamen China
 */
class GoogleChart extends Widget
{
    public $message;
    /**
     * @var string $containerId the container Id to render the visualization to
     */
    public $containerId;

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
    public $timeout=0;
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
        }
        $this->registerClientScript($id);
        //return Html::encode($this->message);
    }

    /**
     * Registers required scripts
     */
    public function registerClientScript($id)
    {

        $jsData = Json::encode($this->data);
        $jsOptions = Json::encode($this->options);

        $script = '
			google.setOnLoadCallback(drawChart' . $id . ');
			var ' . $id . '=null;
                        var old_data=null;
                        var last_data=null;
                        var columns = [];
                        var series = {};
                        var options = ' . $jsOptions . ';
                        var google_timeout;
                                                
                        function load' . $id . '(data) {
                            for (var i = 0; i < data.getNumberOfColumns(); i++) {
                                columns.push(i);
                                if (i > 0) {
                                    series[i - 1] = {};
                                }
                            }
                            google.visualization.events.addListener(' . $id . ', "select", function () {
                                console.log( "GoogleChart.addListener" );

                                var sel = ' . $id . '.getSelection();
                                if (sel.length > 0) {
                                    if (sel[0].row === null) {
                                        var col = sel[0].column;
                                        if (columns[col] == col) {
                                            columns[col] = {
                                                label: data.getColumnLabel(col),
                                                type: data.getColumnType(col),
                                                calc: function () {
                                                    return null;
                                                }
                                            };
                                            series[col - 1].color = "#CCCCCC";
                                        }
                                        else {
                                            columns[col] = col;
                                            series[col - 1].color = null;
                                        }
                                        var view = new google.visualization.DataView(data);
                                        view.setColumns(columns);
                                        
                                
                                        ' . $id . '.draw(view, options);
                                    }
                                }
                            });
                            
                            window.onresize = resize' . $id . ';
                        };
                        
                        function resize' . $id . '(){
                            console.log( "GoogleChart.resize" );
                            old_data=null;
                            clearTimeout(google_timeout);
                            drawChart' . $id . '();
                        }


                        function drawChart' . $id . '() {
				if ("'.$this->url.'"!=""){
                                    $.ajax({
                                        url: "'.$this->url.'",
                                        dataType: "json",

                                    })
                                    .done(function(response) {
                                        if (response.code==1) {
                                            //console.log( "GoogleChart.Ajax" );
                                            //console.log( response );
                                            var old_data2=JSON.stringify(response.data);
                                            if (old_data2!=old_data){
                                                var data = google.visualization.arrayToDataTable(response.data);
                                                console.log("update GoogleChart");
                                                old_data=old_data2;
                                                var options = ' . $jsOptions . ';
                                                if (' . $id . '==null){ 
                                                    console.log("load");
                                                    ' . $id . ' = new google.visualization.' . $this->visualization . '(document.getElementById("' . $this->containerId . '"));
                                                    load' . $id . '(data);    
                                                };
                                                var view = new google.visualization.DataView(data);
                                                view.setColumns(columns);
                                                ' . $id . '.draw(view, options);
                                            };
                                            if ('.$this->timeout.'>0){    
                                                google_timeout=setTimeout(function() {
                                                    drawChart' . $id . '();
                                                 }, '.$this->timeout.');    
                                            };

                                        }

                                    })
                                    .fail(function() {
                                        alert("fail");

                                    });
                                } else {
                                    var data = google.visualization.arrayToDataTable(' . $jsData . ');
                                    ' . $this->scriptAfterArrayToDataTable . '
                                    var options = ' . $jsOptions . ';
                                  ' . $id . ' = new google.visualization.' . $this->visualization . '(document.getElementById("' . $this->containerId . '"));
                                    ' . $id . '.draw(data, options);
                                    load' . $id . '(data);      
                                }


                                    
				
			}';

        $view = $this->getView();
        $view->registerJsFile('https://www.google.com/jsapi',['position' => View::POS_HEAD]);
        $view->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDjOyTOgmPcN0f25W2PFCKAOD1EOx-GwxM',['position' => View::POS_HEAD]);
        $view->registerJs('google.load("visualization", "' . $this->loadVersion . '", {packages:["' . $this->packages . '"]});', View::POS_HEAD, __CLASS__ . '#' . $id);
        $view->registerJs($script, View::POS_HEAD, $id);
    }

}
