<?php

return [
    'direction'=>[0=>'MO',1=>'MT'],
    'status'=>[0=>'Failed',1=>'Success'],
    "report_schema"=>'A2pGmlc',
    'secret_key'=>'test1234',
    
    'alarm_controller'=>'//g-sensor-alarm/_show_all',
    'bootstrap' => [
        'app\models\GServices' => [
            'model' => 'g_services'
        ],
        'app\models\FDrugGenericClassType' => [
            'name' => 'Generic Class Type',
        ],
        'app\models\TRekamMedis' => [
            'name' => 'Rekam Medis',
            'gii' => ['controller2.php' => "0", 'model2.php' => "0", 'views/index_listview.php' => "1"
            ],
        ],
        'app\models\TRekamMedisSoap' => [
            'name' => 'Rekam Medis (SOAP)',
            'ActiveForm' => ['|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|'],
            'DetailView' => ['|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|'],
        ],
        'app\models\TRekamMedisVital' => [
            'name' => 'Rekam Medis (Vital)',
            'ActiveForm' => ['|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6|', '|6', '6|',],
            'DetailView' => ['|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6', '6|', '|6|', '|6', '6|'],
        ],
        'app\models\GUser' => [
            'model' => 'g_user',
            'name' => "User",
            'dataLabel' => ['index' => ['index' => false],
                'gu_midle_name' => ['name' => 'midle', 'index' => true],
                'gu_first_name' => ['name' => 'first'],
                'gu_title_ref' => ['name' => 'title'],
                'f_general_kelurahan_fgk_id1' => ['name' => 'ktp kelurahan'],
                'f_general_kelurahan_fgk_id' => ['name' => 'kelurahan'],
            ],
            'ActiveForm' => ['|3', '3', '3', '3|', '|3', '3|', '|6', '3|', '|3', '3|', '', '', '|6', '6|', '|6', '6|', '|6', '6|'],
            'DetailView' => ['*SECTION 1: general|3', '3', '3', '3|', '|6', '6|', '|6', '3|', '|6', '6|', '', '', '*Section 2: address|6', '6|', '|6', '6|', '|6', '6|'],
        ]
    ],
    'adminEmail' => 'admin@example.com',
    'type' => [0 => "Integer", 1 => "Selection", 2 => "on/off",3 => "persen",4 => "Integer(1/10)",5 => "Integer(1/100)",6 => "Integer(1/1000)"],
    // 'direction' => [0 => "output", 1 => "input"],
    'customized_type_6' => [10 => "on", 11 => "off", 9 => "fliker"],
    'customized_type_31' => [0 => "<span><img src='http://maps.google.com/mapfiles/ms/micons/sailing.png' width='23px' />low</span>", 1 => "medium",2=>'high'],
    'configure_type_2' => [0 => "off", 1 => '<span><img src="https://icloud.icode.id/images/dr3.png" width="23px" /></span>'],
    
    'mapIcon' => [  'ship' => '<span><img src="https://icloud.icode.id/images/ship.png" width="23px" />ship</span>',
                    'car' => '<span><img src="https://icloud.icode.id/images/car.png" width="23px" />car</span>',
                    'gateway' => '<span><img src="https://icloud.icode.id/images/STB.png" width="23px" />gateway</span>',
                    'motor' => '<span><img src="http://maps.google.com/mapfiles/ms/icons/motorcycling.png" width="23px" />motor</span>',
                    'truck' => '<span><img src="http://maps.google.com/mapfiles/ms/icons/truck.png" width="23px" />truck</span>', 
                    'Lock' => '<span><img src="https://icloud.icode.id/images/blue8.png" width="23px" />Lock</span>'
                ],
    
    'userStatus' => [0=>'active',1 => "pending", 2 => "waiting aproval", 3 => "waiting OTA",4 => "force change password"],
    'sensorUserStatus' => [0=>'suksess',1 => "pending", 2 => "fail", 3 => "retry"],
    
    'auditTrialStatus' => [0=>'suksess',1 => "pending", 2 => "fail", 3 => "retry"],
    
    'alarmType' => [0=>'nope',1 => "equal(=)", 2 => ">", 3 => "<",4 => "in range"],
    'authItemType' => [ 1 => "auth_item", 2 => "group_profile",3 => "menu",],
    'alarmMode' => [0 => "alaram", 1 => "ack", 2 => "suspend(10Menit)", 3 => "suspend(1Jam)",4 => "suspend(1Hari)",5 => "suspend(3Hari)",6=> "suspend(1Week)",7 => "suspend(1Month)",8 => "suspend(1Year)"],
    'model' => [0=>'g-sensor-db2'],
    'modelDetail' => [0=>'g-sensor-db2'],
    
    
    'icons' => [
        'ship' => [
            '0' => 'https://icloud.icode.id/images/ship.png',
            '1' => 'https://icloud.icode.id/images/ship.png',
            '2' => 'https://icloud.icode.id/images/ship.png',
            '3' => 'https://icloud.icode.id/images/ship.png',
            '4' => 'https://icloud.icode.id/images/ship.png',
            // '1' => 'http://maps.google.com/mapfiles/ms/micons/sailing.png',
            // '2' => 'http://maps.google.com/mapfiles/ms/micons/sailing.png',
            // '3' => 'http://maps.google.com/mapfiles/ms/micons/sailing.png',
            // '4' => 'http://maps.google.com/mapfiles/ms/micons/sailing.png'
        ],
        'gateway' => [
            '0' => 'https://icloud.icode.id/images/STB.png',
            '1' => 'https://icloud.icode.id/images/STB.png',
            '2' => 'https://icloud.icode.id/images/STB.png',
            '3' => 'https://icloud.icode.id/images/STB.png',
            '4' => 'https://icloud.icode.id/images/STB.png',
            
        ],
        'car' => [
            '0' => 'https://icloud.icode.id/images/car.png',
            '1' => 'https://icloud.icode.id/images/car.png',
            '2' => 'https://icloud.icode.id/images/car.png',
            '3' => 'https://icloud.icode.id/images/car.png',
            '4' => 'https://icloud.icode.id/images/car.png',
            
        ],
        
        'motor' => [
            '0' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            '1' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            '2' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            '3' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            '4' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            
        ],
        'truck' => [
            '0' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
            '1' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
            '2' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
            '3' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
            '4' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
            
        ],
        'Lock' => [
            '0' => 'https://icloud.icode.id/images/blue8.png',
            '1' => 'https://icloud.icode.id/images/grey8.png',
            '2' => 'https://icloud.icode.id/images/green8.png',
            '3' => 'https://icloud.icode.id/images/yellow8.png',
            '4' => 'https://icloud.icode.id/images/red8.png',
            
        ],	   
        
        
    ],
    'plugin_datatype' => [
        'contoh_f_general_kelurahan_fgk_id1' => ['name' => 'kelurahan'],
    ],
    'report_restriction' => [
        'g_sensor_db' => [
            '0' => [
                'table' => [],
                'field_name' => ''
            ],
            '1' => [
                'table' => ["g_device"],
                'field_name' => 'g_customer_gc_id=@@session@@'
            ],
            '2' => [
                'table' => ["g_device"],
                'field_name' => 'g_group_gg_id1=@@session@@'
            ],
        ]
    ],
    'visual_sub_sensor' => ['cmdisplay' => 'cmdisplay', 'cmimage' => 'cmimage', 'cmgauge' => 'cmgauge'],
    'general_param' => ["name", "_data_3d", "_selection_zone",
    ],
    'persamaan' => [0 => 'equal', 1 => 'not equal', 2 => 'range', 3 => 'not in range', 4 => '>', 5 => '>=', 6 => '<', 7 => '<=', 8 => 'like', 9 => 'not like',],
    'data_type' => [
        "varchar" => "Varchar",
        "int" => "Int",
        "double" => "Double",
        "extended" => "Extended",
        "date" => "Date",
        "yy" => "Year",
        "mm" => "Month",
        "dd" => "Day",
        "hh" => "Hour",
        "nn" => "Minute",
        "ss" => "Second",
        "time" => "Time",
        "datetime" => "Datetime",
        "5n" => "5 minute",
        "15n" => "15 minute",
        "30n" => "30 minute"
    ],
    'data_type2' => [
        "extended" => "Extended", 
        "persen" => "Percentage", 
        "avg" => "Average", 
        "max" => "Maximum Value", 
        "min" => "Minimum Value", 
        "count" => "count", 
        "count2" => "count2", 
        "total" => "Total",
        "last"=>"last"
    ],
    'visual_param' => [
        'mapbox' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "width" => "100%",
                "height" => "100%",
                'mapIcon' => [
                    'ship' => 'https://icloud.icode.id/images/ship.png',
                    'car' => 'https://icloud.icode.id/images/car.png',
                    'gateway' => 'https://icloud.icode.id/images/STB.png',
                    'motor' => 'http://maps.google.com/mapfiles/ms/icons/motorcycling.png',
                    'truck' => 'http://maps.google.com/mapfiles/ms/icons/truck.png',
                    'Lock' => 'https://icloud.icode.id/images/blue8.png'
                ],
            ],
        ],
        'piechart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "60%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "100%"
            ],
        ],
        'linechart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'barchart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'columnchart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'areachart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'bubblechart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'candlestickchart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'combochart' => [
            'package' => "corechart",
            'options' => [
                "bars" => "horizontal",
                "seriesType" => "bars",
                "isStacked" => true,
                "title" => "Real-time chat 2",
                'chartArea' => [
                    'width' => "80%",
                    'height' => "60%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'gauge' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'geochart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'histogram' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'scatterChart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'steppedareachart' => [
            'package' => "corechart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'annotationchart' => [
            'package' => "annotationchart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'calendar' => [
            'package' => "calendar",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'gantt' => [
            'package' => "gantt",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'map' => [
            'package' => "map",
            'options' => [
                "mapType" => "normal",
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "100%"
            ],
        ],
        'orgchart' => [
            'package' => "orgchart",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'sankey' => [
            'package' => "sankey",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'table' => [
            'package' => "table",
            'options' => [
                'width' => "100%",
                'height' => "400",
                "page" => "enable",
                "showRowNumber" => true,
            ],
        ],
        'timeline' => [
            'package' => "timeline",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'treeMap' => [
            'package' => "treemap",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'wordtree' => [
            'package' => "wordtree",
            'options' => [
                'chartArea' => [
                    'width' => "80%",
                    'height' => "80%"
                ],
                'legend' => [
                    'position' => "bottom"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'custmodule' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "title" => [
                    "text" => "report by value"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'custmodule2' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "title" => [
                    "text" => "report by value"
                ],
                'width' => "100%",
                'height' => "400"
            ],
        ],
        'cmtable' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "dom" => "Blfrtip",
                "buttons" => [
                    [
                        "extend"=> "copy",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "csv",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "excel",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "pdf",
                        "title"=>"@@title@@"
                    ],
                    [
                        
                        "extend"=> "print",
                        "title"=>"@@title@@"
                    ]
                ],
                "showRowNumber" => true
            ]
        ],
        'cmtable2' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "dom" => "Blfrtip",
                "buttons" => [
                    [
                        "extend"=> "copy",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "csv",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "excel",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "pdf",
                        "title"=>"@@title@@"
                    ],
                    [
                        "extend"=> "print",
                        "title"=>"@@title@@"
                    ]
                ],
                
            ]
        ],
        'cmdisplay' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "title" => [
                    "text" => "report by value"
                ],
                'width' => "100%",
                'height' => "100%"
            ],
        ],
        'cmimage' => [
            'package' => "custom",
            'options' => [
                "report_type" => 1,
                "title" => [
                    "text" => "report by value"
                ],
                'width' => "100%",
                'height' => "100%",
                "data" => [
                    "on" => "/images/icon_on.png",
                    "off" => "/images/icon_off.png",
                    "else" => "/images/logo_error.png"
                ]
            ],
        ],
        'cmgauge' => [
            'package' => "custom",
            'options' => [
                "angle" => 0.12,
                "lineWidth" => 0.44,
                "radiusScale" => 1,
                "pointer" => [
                    "length" => 0.6,
                    "strokeWidth" => 0.035,
                    "color" => "#000000"
                ],
                "limitMax" => false,
                "limitMin" => false,
                "colorStart" => "#6FADCF",
                "colorStop" => "#8FC0DA",
                "strokeColor" => "#E0E0E0",
                "generateGradient" => true,
                "highDpiSupport" => true,
                "report_type" => 1,
                "title" => [
                    "text" => "report by value"
                ],
                "width" => "100%",
                "height" => "100%"
            ],
        ],
        'treemap2'=>[
            "options" => [
                    "report_type" => 2,
                    "report_type22" => 2,
                    "chart" => [
                        "type" => "treemap",
                        "type2"=>1
                    ],
                    "plotOptions" => [
                        "series" => [
                            "allowPointSelect" => true,
                            "dataLabels" => [
                                "enabled" => true,
                                "format" => "{point.name}: {point.y}"
                            ]
                        ]
                    ],
                    "series"=>[
                        [
                          "layoutAlgorithm"=> "squarified",
                          "type"=> "treemap"
                        ]
                      ],
                    "tooltip" => [
                        "headerFormat" => "<span style=\"font-size:11px\">{series.name}</span><br>",
                        "pointFormat" => "<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y}</b><br/>"
                    ],
                    "js"=>[
                        "https://code.highcharts.com/modules/heatmap.js",
                        "https://code.highcharts.com/modules/treemap.js"
                    ]
                ]
            ],
        
        'piechart2' => [
            "options" => [
                "report_type" => 2,
                "chart" => [
                    "type" => "pie",
                    "type2" => 1
                ],
                "title" => [
                    "text" => "report by value"
                ],
                "subtitle" => [
                    "text" => "Click the slices to detail"
                ],
                "accessibility" => [
                    "announceNewData" => [
                        "enabled" => true
                    ],
                    "point" => [
                        "valueSuffix" => "%"
                    ]
                ],
                "plotOptions" => [
                    "series" => [
                        "allowPointSelect" => true,
                        "dataLabels" => [
                            "enabled" => true,
                            "format" => "{point.name}: {point.y}"
                        ]
                    ]
                ],
                "tooltip" => [
                    "headerFormat" => "<span style=\"font-size:11px\">{series.name}</span><br>",
                    "pointFormat" => "<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y}</b><br/>"
                ]
            ]
        ],
        'piechart3' => [
            "options" => [
                "report_type" => 2,
                "chart" => [
                    "type" => "pie",
                ],
                "title" => [
                    "text" => "report by value"
                ],
                "subtitle" => [
                    "text" => "Click the slices to detail"
                ],
                "accessibility" => [
                    "announceNewData" => [
                        "enabled" => true
                    ],
                    "point" => [
                        "valueSuffix" => "%"
                    ]
                ],
                "plotOptions" => [
                    "series" => [
                        "allowPointSelect" => true,
                        "dataLabels" => [
                            "enabled" => true,
                            "format" => "{point.name}: {point.y}"
                        ]
                    ]
                ],
                "tooltip" => [
                    "headerFormat" => "<span style=\"font-size:11px\">{series.name}</span><br>",
                    "pointFormat" => "<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y}</b><br/>"
                ]
            ]
        ],
        "column2" => [
            "options" => [
                "report_type" => 2,
                "chart" => [
                    "type" => "column"
                ],
                "title" => [
                    "text" => "report by value"
                ],
                "subtitle" => [
                    "text" => ""
                ],
                "yAxis" => [
                    "title" => [
                        "text" => ""
                    ]
                ],
                "tooltip" => [
                    "headerFormat" => "<span style=\"font-size:10px\">{point.key}</span><table>",
                    "pointFormat" => "<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td><td style=\"padding:0\"><b>{point.y:.1f} </b></td></tr>",
                    "footerFormat" => "</table>",
                    "shared" => true,
                    "useHTML" => true
                ],
                "plotOptions" => [
                    "column" => [
                        "pointPadding" => 0.2,
                        "borderWidth" => 0
                    ]
                ]
            ],
        ],
        "line2" => [
            "options" => [
                "report_type" => 2,
                "chart" => [
                    "type" => "spline",
                    "zoomType" => "x"
                ],
                "title" => [
                    "text" => "report by value"
                ],
                "subtitle" => [
                    "text" => ""
                ],
                "yAxis" => [
                    "title" => [
                        "text" => ""
                    ]
                ],
                "legend" => [
                    "layout" => "vertical",
                    "align" => "right",
                    "verticalAlign" => "middle"
                ],
                "plotOptions" => [
                    "line" => [
                        "dataLabels" => [
                            "enabled" => false
                        ],
                        "_marker" => [
                            "lineColor" => "#333",
                            "enabled" => true
                        ],
                        "enableMouseTracking" => true
                    ]
                ],
                "responsive" => [
                    "rules" => [[
                    "condition" => [
                        "maxWidth" => 500
                    ],
                    "chartOptions" => [
                        "legend" => [
                            "layout" => "horizontal",
                            "align" => "center",
                            "verticalAlign" => "bottom"
                        ]
                    ]
                        ]]
                ]
            ],
        ]
        ],
    "fss_templates" => [
        [
            'text' => 'Warning',
            'title' => 'Insert a new Warning',
            'className' => 'jsoneditor-type-object',
            'field' => 'Warning',
            'value' => [
                'type' => '',
                'value1' => '',
                'value2' => ''
            ]
        ],
        [
            'text' => 'Alarm',
            'title' => 'Insert a new Warning',
            'className' => 'jsoneditor-type-object',
            'field' => 'Alarm',
            'value' => [
                'type' => '',
                'value1' => '',
                'value2' => ''
            ]
        ],
        [
            'text' => 'Critical',
            'title' => 'Insert a new Warning',
            'className' => 'jsoneditor-type-object',
            'field' => 'Critical',
            'value' => [
                'type' => '',
                'value1' => '',
                'value2' => ''
            ]
        ]
    ],
    "fss_schema" => [
        "type" => "object",
        "properties" => [
            "Critical"=>[
                "type" => "object",
                "properties" => [
                    "type" => [
                        "enum" => ["=", "<", ">", "in range"]
                    ]
                    //,
                    //"value1" => [
                    //    "type" => "string"
                    //],
                    //"value2" => [
                    //    "type" => "string"
                    //]
                ]
            ],
            "Warning" => [
                "type" => "object",
                "properties" => [
                    "type" => [
                        "enum" => ["=", "<", ">", "in range"]
                    ]
                    //,
                    //"value1" => [
                    //    "type" => "string"
                    //],
                    //"value2" => [
                    //    "type" => "string"
                    //]
                ]
            ],
            "Alarm" => [
                "type" => "object",
                "properties" => [
                    "type" => [
                        "enum" => ["=", "<", ">", "in range"]
                    ]
                    //,
                    //"value1" => [
                    //    "type" => "string"
                    //],
                    //"value2" => [
                    //    "type" => "string"
                    //]
                ]
            ]
            
        ]
    ]
];
?>

