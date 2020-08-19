<?

use yii\helpers\Json;
use yii\web\View;
use yii\helpers\Url;
?>

<div style="position: relative;">
    <div id="map<?= $id ?>" style="height: 600px; width: 100%;"></div>
</div>
<p id="<?= $id ?>_param2" style="display:none;position: absolute;left:10px;top:40px" class="value_select_style box_select"></p>
<!-- <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css' rel='stylesheet' /> -->
<!-- <script src='https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js'></script> -->
<link href='https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css' rel='stylesheet' />
<script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
<?


$color_name = Url::to('/images/logo.gif', true);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
$css = <<< CSS
/* #map
{ 
height: 600px; 
width: 100%;
} */
.mapboxgl-popup {
max-width: 400px;
font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}
#menu {
position: absolute top;
background: #fff;
padding: 10px;
font-family: 'Open Sans', sans-serif;
}
.marker {
display: block;
cursor: pointer;
}
/* .touchevents #mapw4 {
    position: relative;
    z-index: -1;
} */
.text-block {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background-color: rgba(0,0,0,0.5);
  color: white;
  padding-left: 20px;
  padding-right: 20px;
  height: 600px; 
width: 100%;
}
CSS;
$this->registerCss($css);
?>
<script>
    var count;

    function mapbox<?= $id ?>(data, report, graph_idx, graphData) {
        var data_map = data;
        // var data_report;
        var icon;
        var x;

        var graph_id = graph_idx;
        var graph = graphData;
        var dclick, click;
        var prov;

        // var id_loc = 1;
        var data_report = report;


        option = <?= Json::encode($options) ?>;
        console.log('[' + graph_idx + ']', data);
        console.log('[' + graph_idx + ']', graphData);
        console.log("[" + graph_idx + ":mapbox]", option.icons);
        console.log("[" + graph_idx + ":mapbox-report]", report);
        console.log(window.location.href);


        // console.log("[" + graph_idx + ":geo-location]", Object.assign({}, data_idn));
        // console.log("[" + graph_idx + ":geo-location2]", geo_location);
        // dclick = report.dblclick;
        // click = report.selection_flag;
        // icon = option.icons;
        // data_map = data;
        // graph_id = graph_idx;
        // graph = graphData;
        // key_length = report.key.length;
        // icon = option.icons;
        initialize<?= $id ?>(data_map, data_report, graph_id, graph);

        document.getElementById("map<?= $id ?>").addEventListener('touchstart', function(e) {
            if (e.touches.length > 1) {
                map<?= $id ?>.dragPan.enable();
            } else if (e.touches.length === 1) {
                map<?= $id ?>.dragPan.disable();
            }
        });
        map<?= $id ?>.dragPan.enable();
    }

    document.getElementById("map<?= $id ?>").addEventListener("mouseover", mouseOver<?= $id ?>);

    function mouseOver<?= $id ?>() {
        document.getElementById("map<?= $id ?>").addEventListener("wheel", wheel<?= $id ?>);
    }

    function wheel<?= $id ?>(e) {

        if (e.ctrlKey) {
            $("#text").hide();
        } else {
            $("#text").show();
            setTimeout(function() {
                $("#text").hide();
            }, 500);
        }
    }
    // $("#text").hide();
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWxmaWFuMTMyIiwiYSI6ImNrNTg3YThhZTA0djQza250dnBjZGkweHkifQ.F93748F2Qgf_8zRQpNYQ3w';

    var map<?= $id ?> = null;
    var length_old;
    var run_animate = 1;
    var first_flag = 1;
    var flag_circle = 1;
    var flag_marker = 1;
    var url_ajax = '$url';
    // var tracking = '$tracking';
    var tracking = 1;
    var image = 'https://icloud.icode.id/images/marker.png';;
    var lng = [];
    var lat = [];
    var lng2 = [];
    var lat2 = [];
    var popup = [];
    var id_marker = [];
    var id_circle = [];
    var lng_circle = [];
    var lat_circle = [];
    var obj_id = [];
    var url_type = [];
    var controlPoints = [];
    var marker1 = [];
    var markerHeight = 50,
        markerRadius = 10,
        linearOffset = 25;
    var popupOffsets = {
        'top': [0, 0],
        'top-left': [0, 0],
        'top-right': [0, 0],
        'bottom': [0, -markerHeight],
        'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
        'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
        'left': [markerRadius, (markerHeight - markerRadius) * -1],
        'right': [-markerRadius, (markerHeight - markerRadius) * -1]
    };

    function initialize<?= $id ?>(data_map, data_report, graph_id, graph) {
        var click = data_report.selection_flag;
        var id_loc = 1;
        var data_idn = [];
        var data_map2 = data_map;
        var data_report2 = data_report;
        var graph_id2 = graph_id;
        var graph2 = graph;
        var flag_geolocation = '<? $options["geo_location"] ?>';
        var data_loc = [];
        var flag_push;
        geo_location = <?
                        if ($options["geo_location"] == 1) {
                            $report_file2 = dirname(__DIR__) . "/../config/mapbox_geo.json";
                            $params2 = file_get_contents($report_file2);
                            $json2 = json_decode($params2, true);
                            echo Json::encode($json2);
                        } else {
                            echo "[]";
                        }
                        ?>;
        if (flag_geolocation == 1) {
            for (let i = 1; i < data_map2.length; i++) {
                var val_loc = data_map2[i];
                if (Number.isInteger(parseInt(val_loc[0]))) {
                    break;
                }
                console.log('panjang ' + data_loc.length);
                if (data_loc.length < 1) {
                    data_loc.push(val_loc[0]);
                } else {
                    for (let j = 0; j < data_loc.length; j++) {
                        if (data_loc[j] == val_loc[0]) {
                            break;
                        } else {
                            flag_push = 1;
                        }
                    }
                    if (flag_push == 1) {
                        data_loc.push(val_loc[0]);
                        flag_push = 0;
                    }
                }
            }
            console.log("[" + graph_id + ":geo-location2]", geo_location);
        }

        for (prov in geo_location) {
            for (let j = 0; j < data_loc.length; j++) {
                if (prov.toLowerCase() == data_loc[j].toLowerCase()) {
                    var data_idn2 = {
                        "type": "Feature",
                        "geometry": {
                            "type": geo_location[prov].type,
                            "coordinates": geo_location[prov].coordinates
                        },
                        "properties": {
                            "STATE_ID": id_loc,
                            // "kode": 31,
                            // "name": "DKI JAKARTA",
                            "STATE_NAME": prov,
                            // "SUMBER": "Peta Dasar BAKOSURTANAL Skala 1 : 250.000"
                        },
                        "id": id_loc
                    }
                    data_idn.push(data_idn2);
                    id_loc++;
                }
            }
        }
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWxmaWFuMTMyIiwiYSI6ImNrNTg3YThhZTA0djQza250dnBjZGkweHkifQ.F93748F2Qgf_8zRQpNYQ3w';
        var myLatLng = [113.9213, 0.7893];
        var myOptions = {
            zoom: 4,
            center: myLatLng,
            container: 'map<?= $id ?>',
            style: 'mapbox://styles/mapbox/streets-v11',
            attributionControl: false,
            dragging: false,
            tap: false,
            scrollZoom: {
                ctrl: true
            }
        };
        map<?= $id ?> = new mapboxgl.Map(myOptions).addControl(new mapboxgl.AttributionControl({
            compact: true
        }));
        map<?= $id ?>.addControl(new mapboxgl.FullscreenControl());
        map<?= $id ?>.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            })
        );
        map<?= $id ?>.addControl(new mapboxgl.NavigationControl());
        map<?= $id ?>.on("wheel", event => {
            if (event.originalEvent.ctrlKey) {

                return;
            }

            if (event.originalEvent.metaKey) {
                return;
            }

            if (event.originalEvent.altKey) {
                return;
            }

            event.preventDefault();
        });

        map<?= $id ?>.dragRotate.disable();
        //goejson
        if (flag_geolocation == 1) {
            var hoveredStateId<?= $id ?> = null;
            map<?= $id ?>.on('load', function() {
                map<?= $id ?>.addSource('states<?= $id ?>', {
                    'type': 'geojson',
                    'data': //'https://icloud.icode.id/geojson/indonesia.geojson'
                    {
                        "type": "FeatureCollection",
                        "features": data_idn
                    }

                });

                // The feature-state dependent fill-opacity expression will render the hover effect
                // when a feature's hover state is set to true.
                map<?= $id ?>.addLayer({
                    'id': 'state-fills<?= $id ?>',
                    'type': 'fill',
                    'source': 'states<?= $id ?>',
                    'layout': {},
                    'paint': {
                        'fill-color': '#627BC1',
                        'fill-opacity': [
                            'case',
                            ['boolean', ['feature-state', 'hover'], false],
                            0.5,
                            0.3
                        ]
                    }
                });

                map<?= $id ?>.addLayer({
                    'id': 'state-borders<?= $id ?>',
                    'type': 'line',
                    'source': 'states<?= $id ?>',
                    'layout': {},
                    'paint': {
                        'line-color': '#627BC1',
                        'line-width': 2
                    }
                });

                // When the user moves their mouse over the state-fill layer, we'll update the
                // feature state for the feature under the mouse.
                map<?= $id ?>.on('mousemove', 'state-fills<?= $id ?>', function(e) {
                    // console.log(e.features[0].properties);
                    if (e.features.length > 0) {
                        if (hoveredStateId<?= $id ?>) {
                            map<?= $id ?>.setFeatureState({
                                source: 'states<?= $id ?>',
                                id: hoveredStateId<?= $id ?>
                            }, {
                                hover: false
                            });
                        }
                        hoveredStateId<?= $id ?> = e.features[0].id;
                        map<?= $id ?>.setFeatureState({
                            source: 'states<?= $id ?>',
                            id: hoveredStateId<?= $id ?>
                        }, {
                            hover: true
                        });
                    }
                });

                // When the mouse leaves the state-fill layer, update the feature state of the
                // previously hovered feature.
                map<?= $id ?>.on('mouseleave', 'state-fills<?= $id ?>', function() {
                    if (hoveredStateId<?= $id ?>) {
                        map<?= $id ?>.setFeatureState({
                            source: 'states<?= $id ?>',
                            id: hoveredStateId<?= $id ?>
                        }, {
                            hover: false
                        });
                    }
                    hoveredStateId<?= $id ?> = null;
                });

                if (click == 1) {
                    map<?= $id ?>.on('click', 'state-fills<?= $id ?>', function(e) {
                        console.log(e.lngLat);
                        new mapboxgl.Popup()
                            .setLngLat(e.lngLat)
                            .setHTML(e.features[0].properties.STATE_NAME)
                            .addTo(map<?= $id ?>);
                        // console.log(e);
                        // data_label = "<b>filter:</b><br> ID = " + e.features[0].properties.STATE_NAME;
                        // document.getElementById("<?= $id ?>_param2").style.display = "block";
                        // document.getElementById("<?= $id ?>_param2").innerHTML = data_label;
                        // graph3[graph_id3].selected_value = e.features[0].properties.STATE_NAME;
                        // console.log("[" + graph_id3 + ":Mapbox] selected:", e.features[0].properties.STATE_NAME);
                        // setTimeout(function() {
                        //     execSelect();
                        // }, 1000);
                        //singleClick(data_report2, graph_id2, e.features[0].properties.STATE_NAME);
                        e.preventDefault();

                        showMenu("menu_popup", e.pageX, e.pageY, menu_str<?= $id ?>, data_report2, graph_id2, [e.features[0].properties.STATE_NAME]);
                    });

                    // Change the cursor to a pointer when the mouse is over the states layer.
                    map<?= $id ?>.on('mouseenter', 'state-fills<?= $id ?>', function() {
                        map<?= $id ?>.getCanvas().style.cursor = 'pointer';
                    });

                    // Change it back to a pointer when it leaves.
                    map<?= $id ?>.on('mouseleave', 'state-fills<?= $id ?>', function() {
                        map<?= $id ?>.getCanvas().style.cursor = '';
                    });
                }

            });
            //end goejson
            console.log(data_map);
            console.log('data_map');
        } else {
            loadMarker<?= $id ?>(data_map2, data_report2, graph_id2, graph2);
        }

    }
    var map_marker = new Map();
    var map_circle = new Map();
    var infowindow = null;

    function loadMarker<?= $id ?>(data_map2, data_report2, graph_id2, graph2) {

        console.log("[" + graph_id2 + ":geo-location2]", data_map2);
        // if (response.code == 1) {
        var flag_circle = '<?= $options['map_mode'] ?>'

        var data_color = <?
                            //if ($options["geo_location"] == 1) {
                            $report_file2 = dirname(__DIR__) . "/../config/color.json";
                            $params2 = file_get_contents($report_file2);
                            $json2 = json_decode($params2, true);
                            echo Json::encode($json2);
                            //} else {
                            //echo "[]";
                            //}
                            ?>;
        var key_color, value_color, get_color;
        console.log("[color-mode" + flag_circle + "]", data_color);
        var dot = [];
        var flag_dot = 0;
        var data_map3 = data_map2;
        var data_report3 = data_report2;
        var dclick = data_report2.dblclick;
        var click = data_report2.selection_flag;
        var graph_id3 = graph_id2;
        var graph3 = graph2;
        var myLatLng;
        var option = <?= Json::encode($options) ?>;
        var icon = option.icons;
        var total_lat = 0,
            total_lng = 0,
            max_lng = -200,
            min_lng = 200,
            max_lat = -200,
            min_lat = 200;
        var total_count = 0;
        var update_count = 0;
        if (data_map3.length > 1) {
            if (data_report3.key.length == 2) {
                var jml_data = data_report3.field.length;
                var no_marker, no_radius, no_color;
                for (let l = jml_data - 1; l >= 0; l--) {
                    if (data_report3.field[l].hasOwnProperty('name')) {
                        if (data_report3.field[l].name == 'color') {
                            no_color = l + 2;
                        }
                        if (data_report3.field[l].name == 'radius') {
                            no_radius = l + 2;
                        }
                        if (data_report3.field[l].name == 'marker') {
                            no_marker = l + 2;
                        }
                    }
                }
                if (tracking == 1) {
                    for (let i = 1; i < data_map3.length; i++) {
                        var value = data_map3[i];
                        // var marker = map_marker.get(value[4]);
                        if (isNaN(value[0]) || isNaN(value[1])) {
                            continue;
                        }
                        if (value.length < 2) {
                            continue;
                        }
                        if (value[0] != null || value[1] != null || !isNaN(value[0]) || !isNaN(value[1])) {
                            total_lat = total_lat + value[0];
                            total_lng = total_lng + value[1];
                            if (value[1] > max_lng) max_lng = value[1];
                            if (value[1] < min_lng) min_lng = value[1];
                            if (value[0] > max_lat) max_lat = value[0];
                            if (value[0] < min_lat) min_lat = value[0];
                            total_count++;


                            if (flag_marker == 1) {
                                if (flag_circle == 0 && no_color != null) {

                                    if (value[no_color] == null || value[no_color] == '' || isNaN(value[no_color])) {
                                        value_color = [255, 0, 0];
                                    } else {
                                        value_color = value[no_color];
                                    }
                                }
                                if (value[no_marker] != undefined) {
                                    for (x in icon) {
                                        if (value[no_marker].toLowerCase() == x) {
                                            image = icon[x];
                                            break;
                                        } else {
                                            image = 'https://icloud.icode.id/images/marker.png';
                                        }
                                    }
                                } else {
                                    image = 'https://icloud.icode.id/images/marker.png';
                                }
                                update_count++
                                console.log('add marker ' + i + " " + value[0] + " " + value[1]);
                                var el = document.createElement('div');
                                el.className = 'marker';
                                el.style.backgroundImage = 'url(' + image + ') ';
                                el.style.width = 64 + 'px';
                                el.style.height = 64 + 'px';
                                el.style.backgroundSize = 'auto';
                                el.style.backgroundRepeat = 'no-repeat';
                                el.style.backgroundPosition = 'center';
                                el.id = i;
                                // obj_id[i] = value[4];
                                lng[i] = value[1];
                                lat[i] = value[0];
                                url_type[i] = value[5];
                                popup[i] = new mapboxgl.Popup(el).setHTML(value[2]).setMaxWidth("300px");
                                var marker = new mapboxgl.Marker(el).setLngLat([value[1], value[0]]).setPopup(popup[i]).addTo(map<?= $id ?>);
                                if (dclick != null) {
                                    marker.getElement('div').addEventListener('dblclick', function(e) {
                                        var php_code;
                                        console.log(value[4]);
                                    });
                                }
                                if (click == 1) {
                                    marker.getElement('div').onclick = function(e) {
                                        value_chart = [lng[e.toElement.id], lat[e.toElement.id]];
                                        e.preventDefault();
                                        showMenu("menu_popup", e.pageX, e.pageY, menu_str<?= $id ?>, data_report3, graph_id3, value_chart);
                                    }
                                }
                                if (flag_circle == 0) {
                                    var center = turf.point([value[1], value[0]]);
                                    var radius = value[no_radius];
                                    var options = {
                                        steps: 64,
                                        units: 'meters',
                                        properties: {
                                            title: 'boo'
                                        }
                                    };
                                    var circle = new turf.circle(center, radius, options);
                                    map<?= $id ?>.addLayer({
                                        "id": "circle-fill" + i,
                                        "type": "fill",
                                        "source": {
                                            "type": "geojson",
                                            "data": circle

                                        },
                                        "paint": {
                                            "fill-color": 'rgba(' + value_color[0] + ',' + value_color[1] + ',' + value_color[2] + ',0.05)',
                                            "fill-opacity": 0.5
                                        }
                                    });
                                    console.log('add circle ' + i + " " + value[0] + " " + value[1]);

                                }
                            }

                        };
                    };
                }
            } else
            if (data_report3.key.length == 1) {
                if (tracking == 1) {
                    var jml_data = data_report3.field.length;
                    var no_marker, no_radius, no_color;
                    for (let l = jml_data - 1; l > 0; l--) {
                        if (data_report3.field[l].hasOwnProperty('name')) {
                            if (data_report3.field[l].name == 'color') {
                                no_color = l + 1;
                            }
                            if (data_report3.field[l].name == 'radius') {
                                no_radius = l + 1;
                            }
                            if (data_report3.field[l].name == 'marker') {
                                no_marker = l + 1;
                            }
                        }
                    }
                    for (let i = 1; i < data_map3.length; i++) {
                        var value = data_map3[i];
                        // var marker = map_marker.get(value[4]);
                        if (isNaN(value[1]) || isNaN(value[2])) {
                            continue;
                        }
                        if (value.length < 2) {
                            continue;
                        }
                        if (value[1] != null || value[2] != null || !isNaN(value[1]) || !isNaN(value[2])) {
                            total_lat = total_lat + value[1];
                            total_lng = total_lng + value[2];
                            if (value[2] > max_lng) max_lng = value[2];
                            if (value[2] < min_lng) min_lng = value[2];
                            if (value[1] > max_lat) max_lat = value[1];
                            if (value[1] < min_lat) min_lat = value[1];
                            total_count++;


                            if (flag_marker == 1) {
                                if (flag_circle == 0 && no_color != null) {

                                    if (value[no_color] == null || value[no_color] == '' || isNaN(value[no_color])) {
                                        value_color = [255, 0, 0];
                                    } else {
                                        value_color = value[no_color];
                                    }
                                }
                                if (value[no_marker] != undefined) {
                                    for (x in icon) {
                                        if (value[no_marker].toLowerCase() == x) {
                                            image = icon[x];
                                            break;
                                        } else {
                                            image = 'https://icloud.icode.id/images/marker.png';
                                        }
                                    }
                                } else {
                                    image = 'https://icloud.icode.id/images/marker.png';
                                }
                                update_count++
                                console.log('add marker ' + value[0] + " " + value[1] + " " + value[2]);
                                var el = document.createElement('div');
                                el.className = 'marker';
                                el.style.backgroundImage = 'url(' + image + ') ';
                                el.style.width = 64 + 'px';
                                el.style.height = 64 + 'px';
                                el.style.backgroundSize = 'auto';
                                el.style.backgroundRepeat = 'no-repeat';
                                el.style.backgroundPosition = 'center';
                                el.id = value[0];
                                obj_id[value[0]] = value[0];
                                lng[value[0]] = value[2];
                                lat[value[0]] = value[1];
                                //url_type[value[0]] = value[5];
                                popup[value[0]] = new mapboxgl.Popup(el).setHTML(value[3]).setMaxWidth("300px");
                                var marker = new mapboxgl.Marker(el).setLngLat([value[2], value[1]]).setPopup(popup[value[0]]).addTo(map<?= $id ?>);
                                if (dclick != null) {
                                    marker.getElement('div').addEventListener('dblclick', function(e) {
                                        var php_code;
                                        console.log('dblclik');
                                    });
                                }
                                if (click == 1) {
                                    marker.getElement('div').onclick = function(e) {
                                        console.log('hai');
                                        console.log(e);
                                        e.preventDefault();
                                        showMenu("menu_popup", e.pageX, e.pageY, menu_str<?= $id ?>, data_report3, graph_id3, [obj_id[e.toElement.id]]);
                                    }

                                }
                                if (flag_circle == 0) {
                                    var center = turf.point([value[2], value[1]]);
                                    var radius = value[no_radius];
                                    var options = {
                                        steps: 64,
                                        units: 'meters',
                                        properties: {
                                            title: 'boo'
                                        }
                                    };
                                    var circle = new turf.circle(center, radius, options);
                                    map<?= $id ?>.addLayer({
                                        "id": "circle-fill" + i,
                                        "type": "fill",
                                        "source": {
                                            "type": "geojson",
                                            "data": circle

                                        },
                                        "paint": {
                                            "fill-color": 'rgba(' + value_color[0] + ',' + value_color[1] + ',' + value_color[2] + ',0.7)',
                                            "fill-opacity": 0.5
                                        }
                                    });
                                    console.log('add circle ' + i + " " + value[1] + " " + value[2]);

                                }
                            }
                        };
                    };
                }
                if (flag_circle == 1) {
                    var pulsingDot = [];
                    var context;
                    map<?= $id ?>.on('load', function() {
                        var jml_data = data_report3.field.length;
                        var no_marker, no_radius, no_color;
                        for (let l = jml_data - 1; l >= 0; l--) {
                            if (data_report3.field[l].hasOwnProperty('name')) {
                                if (data_report3.field[l].name == 'color') {
                                    no_color = l + 1;
                                }
                                if (data_report3.field[l].name == 'radius') {
                                    no_radius = l + 1;
                                }
                                if (data_report3.field[l].name == 'marker') {
                                    no_marker = l + 1;
                                }
                            }
                        }
                        var flag_canvas=1;
                        var isi_canvas;
                        for (let i = 1; i < data_map3.length; i++) {
                            var value = data_map3[i];
                            // var marker = map_marker.get(value[4]);
                            if (isNaN(value[1]) || isNaN(value[2])) {
                                continue;
                            }
                            if (value.length < 2) {
                                continue;
                            }
                            if (flag_circle == 1 && no_color != null) {
                                for (key_color in data_color) {
                                    if (key_color == value[no_color]) {
                                        value_color = data_color[key_color];
                                        get_color = 1;
                                        break;
                                    }
                                }
                                if (get_color != 1) {
                                    value_color = [200, 200, 200];
                                    get_color = null;
                                }
                            }
                            if (value[no_marker] != undefined) {
                                for (x in icon) {
                                    if (value[no_marker].toLowerCase() == x) {
                                        image = icon[x];
                                        break;
                                    } else {
                                        image = 'https://icloud.icode.id/images/marker.png';
                                    }
                                }
                            } else {
                                image = 'https://icloud.icode.id/images/marker.png';
                            }
                            var size = 300;
                            pulsingDot[i] = {
                                width: size,
                                height: size,
                                data: new Uint8Array(size * size * 4),
                                onAdd: function() {
                                    if (flag_canvas==1){
                                    var canvas = document.createElement('canvas');
                                    canvas.id='myCanvas';
                                    canvas.width = this.width;
                                    canvas.height = this.height;
                                    this.context = canvas.getContext('2d');
                                    isi_canvas = canvas;
                                    } else {
                                    //var cd = document.getElementById("myCanvas");
                                    console.log(isi_canvas);
                                    this.context = isi_canvas.getContext('2d');
                                    console.log(this.context);
                                    }
                                    //canvas.id = i;
                                    //canvas.width = this.width;
                                    //canvas.height = this.height;
                                    //this.context = canvas.getContext('2d');
                                    //console.log('[2]', canvas.id);
                                    //console.log('[2]', canvas);
                                    //console.log('[2]', this.context);
                                    //};
                                    flag_canvas=0;
                                },
                                render: function() {
                                    var duration = 1000;
                                    var t = (performance.now() % duration) / duration;
                                    
                                    var radius = (size / 2) * 0.3;
                                    var outerRadius = (size / 2) * 0.7 * t + radius;
                                    var context = this.context;
                                    //console.log('[2]', canvas.id);
                                    //console.log('[2]', canvas);
                                    //console.log('[2]', context);
                                    // draw outer circle
                                    context.clearRect(0, 0, this.width, this.height);
                                    context.beginPath();
                                    context.arc(
                                        this.width / 2,
                                        this.height / 2,
                                        outerRadius,
                                        0,
                                        Math.PI * 2
                                    );
                                    context.fillStyle = 'rgba(' + value_color[0] + ',' + value_color[1] + ',' + value_color[2] + ',' + (1 - t) + ')';
                                    context.fill();

                                //   context.beginPath();
                                //   context.arc(
                                //        this.width / 2,
                                //        this.height / 2,
                                //        radius,
                                //        0,
                                //        Math.PI * 2
                                //    );
                                    //context.fillStyle = 'rgba(0,0,0,0)';
                                    //context.strokeStyle = 'rgba(0,0,0,0)';
                                    // context.lineWidth = 2 + 4 * (1 - t);
                                    //context.fill();
                                    //context.stroke();

                                    this.data = context.getImageData(
                                        0,
                                        0,
                                        this.width,
                                        this.height
                                    ).data;

                                    map<?= $id ?>.triggerRepaint();
//console.log('[2]', context);
                                    return true;
                                }
                            };


                            console.log('rgba(' + value_color[0] + ',' + value_color[1] + ',' + value_color[2] + ',');
                            map<?= $id ?>.addImage('pulsing-dot' + i, pulsingDot[i], {
                                pixelRatio: 2,
                            });

                            //map<?= $id ?>.addSource('points' + i, {
                            //    'type': 'geojson',
                            //    'data': {
                            //        'type': 'FeatureCollection',
                            //        'features': [{
                            //            'type': 'Feature',
                            //            'geometry': {
                            //                'type': 'Point',
                            //                'coordinates': [value[2], value[1]]
                            //            }
                            //        }]
                            //    }
                            //});
                            
                            map<?= $id ?>.addLayer({
                                'id': 'points' + i,
                                'type': 'symbol',
                                'source': {
                                    'type': 'geojson',
                                    'data': {
                                        'type': 'FeatureCollection',
                                        'features': [{
                                            'type': 'Feature',
                                            'geometry': {
                                                'type': 'Point',
                                                'coordinates': [value[2], value[1]]
                                            },
                                            'properties': {'image-name': 'pulsing-dot' + i}
                                        }]
                                    }
                                },
                                'layout': {
                                    //'icon-image': 'pulsing-dot' + i,
                                    'icon-text-fit': 'both',
                                    'icon-image': ['get', 'image-name'],
                                    'icon-allow-overlap': true,
                                    'text-allow-overlap': true
                                }
                            });
                        }
                    });
                }
            };


            // if (first_flag == 1) {
            // flag_marker= 0;
            first_flag = 0;
            var setlat = (max_lat + min_lat) / 2;
            var setlng = (max_lng + min_lng) / 2;
            var center = [setlng, setlat];
            map<?= $id ?>.setCenter(center);
            var GLOBE_WIDTH = 256; // a constant in Google's map projection
            var angle = max_lng - min_lng;
            if (angle < 0) {
                angle += 360;
            };
            var angle2 = max_lat - min_lat;
            if (angle2 < 0) {
                angle2 += 360;
            };
            var pixelWidth = 350;
            var zoom = Math.round(Math.log(pixelWidth * 360 / angle / GLOBE_WIDTH) / Math.LN2) - 1;
            var zoom2 = Math.round(Math.log(pixelWidth * 360 / angle2 / GLOBE_WIDTH) / Math.LN2) - 1;

            console.log("zoom:" + zoom);
            console.log("zoom2:" + zoom2);
            map<?= $id ?>.setZoom(Math.min(zoom, zoom2));
            // }

            document.getElementById("<?= $id ?>_param2").addEventListener("click", function() {
                sessionRec=sessionMap[0];
                console.log("[<?= $id ?>:SELECT] select* click");
                document.getElementById("<?= $id ?>_param2").style.display = "none";
                graph3[<?= $idx ?>].selected_value = null;
                setTimeout(function() {
                    execSelect(sessionRec);

                }, 1000);


            });

        }
    }
</script>