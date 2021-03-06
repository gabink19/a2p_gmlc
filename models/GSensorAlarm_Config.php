<?php
if(!function_exists('GSensorAlarm_config')){
function GSensorAlarm_config(){ return [
	'name'=>'',
	'js'=>'',
	'css'=>'',
	'master_id'=>'',
	'client_id'=>'',
	'mode1'=>'',
	'dataLabel'=>[
		'gsa_id'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>""],
		'gsa_name'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'gsa_value'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'g_sensor_db_gsd_id'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>""],
		'f_sensor_detail_fsd_id'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>""],
		'gsa_alarm_mode_ref'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"ref",'field_type_ext_data'=>""],
		'first_user'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_ip'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_update'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_user'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_ip'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_update'=>['js'=>"",'name'=>'','index'=>'0','ActiveForm'=>'','DetailView'=>'','display'=>'0','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'g_customer_gc_id'=>['js'=>"",'name'=>'','index'=>'1','ActiveForm'=>'','DetailView'=>'','display'=>'1','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>""],
	],
];
};
}; 
?>