<?php

namespace app\models;

use Yii;




class ErrCodeSms extends XxErrCodeSms{

static $parameter=['tecs_err_code','tecs_sms_template','first_user','first_ip','first_update','last_user','last_ip','last_update','tecs_aph_id',]; 

    public static function findOne($condition)
    {
        return parent::findOne($condition);
    }  
    
    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation,$attributeNames);
    
    }
    
    public function delete(){
        return parent::delete();
    
    }

}
