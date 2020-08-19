<?php

namespace app\models;

use Yii;




class GHistoryLog extends XxGHistoryLog{

static $parameter=['ghl_userid','ghl_username','ghl_log','ghl_ip','ghl_date','ghl_id_model','ghl_model',]; 

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
