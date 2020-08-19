<?php
if(!function_exists('ErrCodeSms_config')){
function ErrCodeSms_config(){ return [
	'name'=>'',
	'js'=>'',
	'css'=>'',
	'master_id'=>'',
	'master_id_ref'=>'',
	'filter'=>'',
	'filter_ex'=>'',
	'client_id'=>'',
	'option_flag'=>'',
	'parameter'=>'',
	'mode1'=>'',
	'ActionForm_count'=>'1',
	'DetailView_count'=>'1',
	'Index_count'=>'1',
	'API_flag'=>'',
	'dataLabel'=>[

		'tecs_id'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'ID',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'tecs_err_code'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'Error Code',
			'index'=>'1',
			'display'=>'1',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'tecs_sms_template'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'SMS Template',
			'index'=>'1',
			'display'=>'1',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'first_user'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'first_ip'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'first_update'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'last_user'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'last_ip'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'last_update'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'0',
			'display'=>'0',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

		'tecs_aph_id'=>[
			'disable'=>'',
			'js'=>"",
			'name'=>'',
			'index'=>'1',
			'display'=>'1',
			'API_Display_Index'=>'',
			'API_Display_View'=>'',
			'API_notes'=>'',
			'DetailView'=>'',
			'DetailView_1'=>'',
			'DetailView_2'=>'',
			'ActiveForm'=>'',
			'ActiveForm_1'=>'',
			'ActiveForm_2'=>'',
			'ActiveForm_Option'=>"",
			'ActiveForm_Option_1'=>"",
			'ActiveForm_Option_2'=>"",
			'DetailView_display'=>'',
			'ActiveForm_display'=>'',
			'Index_display'=>'',
			'value'=>'',
			'filter'=>"",
			'filter_index'=>"",
			'field_type'=>"",
			'field_type_ext_data'=>""
		],

	],
	'index'=>[
		'script_1'=>"",
		'script_2'=>"",
		'grid_view_option'=>"",
		'button'=>"",
		'button2'=>"",
		'button3'=>"",
		'export'=>[
			'html'=>'',
			'excel'=>'',
			'excel_x'=>'',
			'pdf'=>'',
			'text'=>'',
			'csv'=>'',
		],
		'import'=>[
			'field_import'=>[],
			'extensions'=>'',
			'explode'=>'',
			'bulk'=>'',
		]
	],
	'view'=>[
		'script_1'=>"",
		'script_2'=>"",
		'button'=>"",
	],
	'_active_form'=>[
		'script_1'=>"",
		'script_2'=>"",
	],
	'index_2'=>[
		'script_1'=>"",
		'script_2'=>"",
		'grid_view_option'=>"",
		'button'=>"",
		'button2'=>"",
		'button3'=>"",
		'export'=>[
			'html'=>'',
			'excel'=>'',
			'excel_x'=>'',
			'pdf'=>'',
			'text'=>'',
			'csv'=>'',
		],
		'import'=>[
			'field_import'=>[],
			'extensions'=>'',
			'explode'=>'',
			'bulk'=>'',
		]
	],
	'view_2'=>[
		'script_1'=>"",
		'script_2'=>"",
		'button'=>"",
	],
	'_active_form_2'=>[
		'script_1'=>"",
		'script_2'=>"",
	],
	'index_3'=>[
		'script_1'=>"",
		'script_2'=>"",
		'grid_view_option'=>"",
		'button'=>"",
		'button2'=>"",
		'button3'=>"",
		'export'=>[
			'html'=>'',
			'excel'=>'',
			'excel_x'=>'',
			'pdf'=>'',
			'text'=>'',
			'csv'=>'',
		],
		'import'=>[
			'field_import'=>[],
			'extensions'=>'',
			'explode'=>'',
			'bulk'=>'',
		]
	],
	'view_3'=>[
		'script_1'=>"",
		'script_2'=>"",
		'button'=>"",
	],
	'_active_form_3'=>[
		'script_1'=>"",
		'script_2'=>"",
	],
];
};
}; 
?>