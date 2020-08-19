<?php
if(!function_exists('AuthItemChild_config')){
function AuthItemChild_config(){ return [
	'name'=>'Auth Item Detail',
	'js'=>'',
	'css'=>'',
	'master_id'=>'parent',
	'filter'=>'',
	'filter_ex'=>'',
	'client_id'=>'',
	'mode1'=>'',
	'dataLabel'=>[
		'parent'=>['js'=>"",'name'=>'','index'=>'1','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>"AuthItem#parent0#name#name#auth-item"],
		'child'=>['js'=>"",'name'=>'','index'=>'1','display'=>'1','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"id",'field_type_ext_data'=>"AuthItem#child0#name#showName#auth-item"],
		'first_user'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_ip'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_update'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_user'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_ip'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_update'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'field_type'=>"",'field_type_ext_data'=>""],
	],
];
};
}; 
?>