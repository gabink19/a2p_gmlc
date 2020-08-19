    
<div id="map-canvas" ></div>
<?php

use yii\web\View;
use yii\helpers\Url;

//$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyD7sTqR9nFuvTd_5_LrDNdWeSVnNybHYYA', ['position' => View::POS_HEAD]);
//$this->registerJsFile('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=true&key=AIzaSyD7sTqR9nFuvTd_5_LrDNdWeSVnNybHYYA', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD7sTqR9nFuvTd_5_LrDNdWeSVnNybHYYA', ['position' => View::POS_HEAD]);
$css = <<< CSS
#map-canvas 
{ 
height: 600px; 
width: 100%;
}
CSS;
$this->registerCss($css);
$js = <<<js
var map=null; 
//var directionsRenderer;
//var directionsService;
var first_flag=1;   
var url_ajax='$url';
//var marker=null; 
var map_marker=new Map();
var map_circle=new Map();
var infowindow=null;
var point_marker;
var old_marker_value=null;        
var point_marker_counter=0;
var playMarker_timer; 
var loadMarker_timer;        
        
        
function initialize() {
    
    var myLatLng = new google.maps.LatLng( 50, 50 ),
        myOptions = {
            zoom: 12,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            };
    //directionsRenderer = new google.maps.DirectionsRenderer;
    //directionsService = new google.maps.DirectionsService;    
    map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions );
    //directionsRenderer.setMap(map);
    point_marker=new google.maps.Marker({
                            map: map,
                            //position: marker_value.getPosition(),
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillColor: '#00F',
                                fillOpacity: 0.6,
                                strokeColor: '#00A',
                                strokeOpacity: 0.9,
                                strokeWeight: 1,
                                scale: 7
                            }
                        });    
    loadMarker();
    
}   
function playMarker(){
    clearTimeout(playMarker_timer);
    console.log( "playMarker:"+ point_marker_counter);
    point_marker_counter--;
    counter=0;    
    for (var [index, marker_value] of map_marker) {   
        if (counter==point_marker_counter){
                //point_marker.setPosition(marker_value.getPosition());
                if (old_marker_value!=null) {
                    old_marker_value.setAnimation(null);  
                }
                marker_value.setAnimation(google.maps.Animation.BOUNCE);  
                old_marker_value= marker_value;     
                setTimeout(function() {
                    playMarker();
                }, 500);    
       
            }
        counter++;    
    };
        
};
function loadMarker(){
    clearTimeout(loadMarker_timer);
    $.ajax({
        url: url_ajax,
        
        dataType: "json",
        
        
    })
        
        
    .done(function(response) {
        if (response.code==1) {
            //console.log( response );
            //console.log("update");
            var myLatLng;
            var total_lat=0,total_lng=0,max_lng=-200,min_lng=200,max_lat=-200,min_lat=200;
            var total_count=0;
            var update_count=0;
            var last_myLatLng=null;
            var dir_count=0;
            for(let i = 1; i < response.data.length; i++){
                var value=response.data[i];
                var marker_value=map_marker.get(value[4]);
                if (value[0]>0 || value[1]>0) {
                    total_lat=total_lat+value[0];
                    total_lng=total_lng+value[1];
                    if (value[1]>max_lng) max_lng=value[1];
                    if (value[1]<min_lng) min_lng=value[1];
                    if (value[0]>max_lat) max_lat=value[0];
                    if (value[0]<min_lat) min_lat=value[0];
                    total_count++;
        
                }
                if (marker_value==null){
                    update_count++
                    console.log('add marker '+value[4]+" "+value[0]+" "+value[1]);
                    myLatLng = new google.maps.LatLng( value[0], value[1] );
                    var marker_value = new google.maps.Marker( {position: myLatLng, map: map ,content:value[2],obj_id:value[4] } );
                    marker_value.setMap( map );
                    marker_value.setTitle('marker:'+value[4] );
                    marker_value.setIcon(value[3]);
                    marker_value.addListener('dblclick', function() {
                        var php_code;
                        php_code='$php_code';    
                        php_code=php_code.replace("param1", this.get('obj_id'));
                        window.location.href = php_code;
                    
                    });
        
                    marker_value.addListener('click', function() {
                        //var title = this.getTitle();
                        var title = this.get('content');
                        if(infowindow){
                            infowindow.close();
                        }
                        infowindow = new google.maps.InfoWindow({
                                content: title
                            });
                            infowindow.open(map, this);
                      });
                    map_marker.set(value[4],marker_value);
                    
                    if (i==1){
                        if ($tracking==2) {
                
                            if (old_marker_value!=null) {
                                 old_marker_value.setAnimation(null);  
                             } 
                            marker_value.setAnimation(google.maps.Animation.BOUNCE);  
                            old_marker_value=marker_value;
                            point_marker.setPosition(marker_value.getPosition());
                        }    
                       
                    }
        
                    
                    /*
                    var circle = new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.1,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.1,
                        map: map,
                        center: myLatLng,
                        title:'test',
                        radius: 100
                      });
        
                    google.maps.event.addListener(circle,'mouseover',function(){
                         this.getMap().getDiv().setAttribute('title',this.get('title'));});

                    google.maps.event.addListener(circle,'mouseout',function(){
                         this.getMap().getDiv().removeAttribute('title');});
                    */ 
        

                } else {
                    var lat = marker_value.getPosition().lat();
                    var lng = marker_value.getPosition().lng();
                    var update_flag=false;
                    if (Math.abs(lat-value[0])>0.0000000001 || Math.abs(lng-value[1])>0.0000000001 ){
                        update_count++
                        console.log('update marker '+lat+"->"+value[0]+" "+lng+"->"+value[1]+" "+value[4]);
                        myLatLng = new google.maps.LatLng( value[0], value[1] );
                        marker_value.setPosition( myLatLng);
                        update_flag=true;
                    } else {
                        //console.log('no update marker');
                    };
                    var title=marker_value.get('content');
                    if (title!=value[2]){
                        console.log('update title');
                        update_flag=true;
                        marker_value.set('content',value[2]);
                    };
                    var icon=marker_value.getIcon();
                    if (icon!=value[3]){
                        console.log('update icon');
                        update_flag=true;
                        marker_value.setIcon(value[3]);
                    };
                    if (update_flag){
                    } else {
                        //console.log('no update marker');
                    };
                    
                }
                /*
                if (dir_count<10) {
                    if (last_myLatLng!=null && myLatLng!=null) { 
                        directionsService.route({
                            origin: last_myLatLng,  
                            destination: myLatLng,
                            travelMode: google.maps.TravelMode['WALKING']
                          }, function(response, status) {
                            if (status == 'OK') {
                              directionsRenderer.setDirections(response);
                            } else {
                              window.alert('Directions request failed due to ' + status);
                            }
                          })
                        dir_count++;
                    }
                    last_myLatLng=myLatLng;
                }*/
                

             };
        
             for(let i = 1; i < response.data2.length; i++){
                var value=response.data2[i];
                var circle_value=map_circle.get(value[4]);
                
                if (value[0]>0 || value[1]>0) {
                    total_lat=total_lat+value[0];
                    total_lng=total_lng+value[1];
                    if (value[1]>max_lng) max_lng=value[1];
                    if (value[1]<min_lng) min_lng=value[1];
                    if (value[0]>max_lat) max_lat=value[0];
                    if (value[0]<min_lat) min_lat=value[0];
                    total_count++;
        
                }
                if (circle_value==null){
                    update_count++
                    console.log('add circle_value '+value[4]+" "+value[0]+" "+value[1]);
                    myLatLng = new google.maps.LatLng( value[0], value[1] );
                    var circle_value = new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.1,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.1,
                        map: map,
                        center: myLatLng,
                        title:value[2],
                        radius: value[5]
                      });
        
                    google.maps.event.addListener(circle_value,'mouseover',function(){
                         this.getMap().getDiv().setAttribute('title',this.get('title'));});

                    google.maps.event.addListener(circle_value,'mouseout',function(){
                         this.getMap().getDiv().removeAttribute('title');});
                    map_circle.set(value[4],circle_value);
        

                } else {
                    var lat = circle_value.getCenter().lat();
                    var lng = circle_value.getCenter().lng();
                    var update_flag=false;
                    if (Math.abs(lat-value[0])>0.0000000001 || Math.abs(lng-value[1])>0.0000000001 ){
                        update_count++
                        console.log('update circle '+lat+"->"+value[0]+" "+lng+"->"+value[1]+" "+value[4]);
                        myLatLng = new google.maps.LatLng( value[0], value[1] );
                        circle_value.setCenter( myLatLng);
                        update_flag=true;
                    } else {
                        //console.log('no update marker');
                    };
                    var title=circle_value.get('title');
                    if (title!=value[2]){
                        console.log('update title');
                        update_flag=true;
                        circle_value.set('title',value[2]);
                    };
                    if (update_flag){
                    } else {
                        //console.log('no update marker');
                    };
                    
                }


             };
            if (first_flag) {
            //if (update_count>0){
                //total_lat=total_lat/total_count;
                //total_lng=total_lng/total_count;
                url_ajax=url_ajax+'&update_only=1';
        
                first_flag=0;
                total_lat=(max_lat+min_lat)/2;
                total_lng=(max_lng+min_lng)/2;
        
                myLatLng = new google.maps.LatLng( total_lat, total_lng );

                map.panTo(myLatLng );
        
                var GLOBE_WIDTH = 256; // a constant in Google's map projection
                var angle = max_lng - min_lng;
                if (angle < 0) {
                    angle += 360;
                };
                var angle2 = max_lat - min_lat;
                if (angle2 < 0) {
                    angle2 += 360;
                };
                var pixelWidth=350;
                var zoom = Math.round(Math.log(pixelWidth * 360 / angle / GLOBE_WIDTH) / Math.LN2);
                var zoom2 = Math.round(Math.log(pixelWidth * 360 / angle2 / GLOBE_WIDTH) / Math.LN2);
                
                console.log("zoom:"+zoom);
                console.log("zoom2:"+zoom2);
                map.setZoom(Math.min(zoom,zoom2));
                point_marker_counter=map_marker.size;
                if ($tracking==2) {
                    playMarker_timer=setTimeout(function() {
                            playMarker();
                        }, 500);    
                }
        
            }
            
                
                
            if ($timeout>0){    
                loadMarker_timer=setTimeout(function() {
                    loadMarker();
                 }, $timeout);    
            };
            

        }

    })
    .fail(function() {
        alert("fail");

    });
}
initialize();

        
js;
$this->registerJs($js);
?>       
<?
if ($pjax_enable) {
    Pjax::end();
}
?>


