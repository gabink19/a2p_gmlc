<?php
use yii\helpers\Url;
// use backend\modules\user\models\User;
/* @var $this yii\web\View */

$this->title = 'A2PGMLC';
// echo $this->render("index",['model'=>new User]);
// echo phpinfo();
?>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="site-index">
    <div class="jumbotron">
        <h2>Dashboard A2PGMLC</h2>
        <div id="myAreaChart" style=""></div>
    </div>
    <div class="jumbotron">
        <div id="myAreaChart2" style=""></div>
    </div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		var datajson = [];
		var datajson2 = [];
		momt();
		tps();
	});
	function momt() {
      datajson = <?= $momt ?>;
    	Highcharts.chart('myAreaChart', {
          chart: {
              type: 'line',
              events: {
                  load: function() {
                      //set up the updating of the chart each second
                      var series = this.series[0];
                      var series1 = this.series[1];
                      var chart = this;
                      var kategories = this.xAxis[0].categories;
                      setInterval(function() {
                          $.ajax({
                            url: "<?= Url::to(['mo-mt']) ?>", 
                            success: function(result){
                              datajson = eval('(' + result + ')');
                              series.setData(datajson.MO);
                              series1.setData(datajson.MT);
                              chart.xAxis[0].setCategories(datajson.tanggal,true);
                             }
                          });
                      }, 10000);
                  }
              }
          },
          title: {
            text: 'SMS MO/MT Last 24 Hours',
          },
		    exporting: {
		        enabled: false
		    },
          xAxis: {
              categories: datajson.tanggal,
              crosshair: true,
          },
          yAxis: {
              min: 0,
              title: false,
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [{
              name: 'Total Transaction MO',
              data: datajson.MO,

          },{
              name: 'Total Transaction MT',
              data: datajson.MT,

          }]
      	});
	}
	function tps() {
      datajson2 = <?= $tps ?>;
    	Highcharts.chart('myAreaChart2', {
          chart: {
              type: 'line',
              events: {
                  load: function() {
                      //set up the updating of the chart each second
                      var series = this.series[0];
                      var series1 = this.series[1];
                      var series2 = this.series[2];
                      var series3 = this.series[3];
                      var chart = this;
                      var kategories = this.xAxis[0].categories;
                      setInterval(function() {
                          $.ajax({
                            url: "<?= Url::to(['tps']) ?>", 
                            success: function(result){
                              datajson2 = eval('(' + result + ')');
                              series.setData(datajson2.MO);
                              series1.setData(datajson2.API);
                              series2.setData(datajson2.MT);
                              series3.setData(datajson2.DR);
                              chart.xAxis[0].setCategories(datajson2.tanggal,true);
                             }
                          });
                      }, 10000);
                  }
              }
          },
          title: {
            text: 'TPS MO/API/MT/DR Last 24 Hours',
          },
		    exporting: {
		        enabled: false
		    },
          xAxis: {
              categories: datajson2.tanggal,
              crosshair: true,
          },
          yAxis: {
              min: 0,
              title: false,
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [{
              name: 'Total TPS MO',
              data: datajson2.MO,

          },{
              name: 'Total TPS API',
              data: datajson2.API,

          },{
              name: 'Total TPS MT',
              data: datajson2.MT,

          },{
              name: 'Total TPS DR',
              data: datajson2.DR,

          }]
      	});
	}
	
</script>