<?php

namespace app\models;

use Yii;




class Aph extends XxAph{

static $parameter=['ta_name','ta_desc','ta_api_username','ta_api_password','first_user','first_ip','first_update','last_user','last_ip','last_update',]; 

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
