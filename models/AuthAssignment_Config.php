<?php
if(!function_exists('AuthAssignment_config')){
function AuthAssignment_config(){ return [
	'name'=>'Auth Assignment',
	'js'=>'',
	'css'=>'',
	'master_id'=>'user_id',
	'filter'=>'',
	'filter_ex'=>'',
	'client_id'=>'',
	'mode1'=>'',
	'dataLabel'=>[
		'user_id'=>['js'=>"",'name'=>'','index'=>'1','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"id",'field_type_ext_data'=>"AuthLogin#user#user_id#tl_name#auth-login"],
		'item_name'=>['js'=>"",'name'=>'item name','index'=>'1','display'=>'1','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"->where(['type' => 2])",'filter_index'=>"->where(['type' => 2])",'field_type'=>"id",'field_type_ext_data'=>"AuthItem#itemName#name#name#auth-item"],
		'first_user'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_ip'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'first_update'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_user'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_ip'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
		'last_update'=>['js'=>"",'name'=>'','index'=>'0','display'=>'0','ActiveForm'=>'','DetailView'=>'','value'=>'','filter'=>"",'filter_index'=>"",'field_type'=>"",'field_type_ext_data'=>""],
	],
];
};
}; 
?>